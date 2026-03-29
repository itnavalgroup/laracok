<?php

namespace App\Http\Controllers;

use App\Models\Pr;
use App\Models\User;
use App\Http\Requests\StorePrRequest;
use App\Http\Requests\UpdatePrRequest;
use App\Services\ApprovalService;
use App\Services\NumberingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrController extends Controller
{
    protected $approvalService;
    protected $numberingService;

    public function __construct(ApprovalService $approvalService, NumberingService $numberingService)
    {
        $this->approvalService = $approvalService;
        $this->numberingService = $numberingService;
    }

    public function index()
    {
        $prs = Pr::with(['user', 'company', 'departement', 'vendor'])->orderBy('created_at', 'desc')->paginate(10);
        return view('pr.index', compact('prs'));
    }

    public function create()
    {
        return view('pr.create');
    }

    public function store(StorePrRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            
            // Generate Number
            $sequence = $this->numberingService->getNextSequence(Pr::class, $user->id_departement);
            
            $company = DB::table('tbl_company')->where('id_company', $request->id_company)->value('company');
            $dept = DB::table('tbl_departement')->where('id_departement', $user->id_departement)->value('departement');
            
            $prNumber = $this->numberingService->generatePrNumber($company, $dept, now(), $sequence);

            $pr = Pr::create([
                'id_doc_type' => $request->id_doc_type,
                'id_user' => $user->id_user,
                'id_departement' => $user->id_departement,
                'id_company' => $request->id_company,
                'id_vendor' => $request->id_vendor,
                'subject' => $request->subject,
                'pr_number' => $prNumber,
                'number' => $sequence,
                'status' => 0, // Draft
                // ... map other fields from request
            ]);
        });

        return redirect()->route('pr.index')->with('success', 'PR created successfully.');
    }

    public function show(Pr $pr)
    {
        return view('pr.show', compact('pr'));
    }

    public function edit(Pr $pr)
    {
        $user = Auth::user();
        if (!$this->approvalService->canRevise($user, $pr, 'PR')) {
            return redirect()->route('pr.index')->with('error', 'Cannot edit this PR.');
        }
        
        return view('pr.edit', compact('pr'));
    }

    public function update(UpdatePrRequest $request, Pr $pr)
    {
        $user = Auth::user();
        if (!$this->approvalService->canRevise($user, $pr, 'PR')) {
            abort(403, 'Cannot edit this PR.');
        }

        $pr->update($request->validated());

        return redirect()->route('pr.show', $pr)->with('success', 'PR updated successfully.');
    }

    public function destroy(Pr $pr)
    {
        $user = Auth::user();
        // Assuming delete logic is similar to cancel requested or draft check
        // Using canSubmit check for draft status ownership might be appropriate, or a specific canDelete
        if (!$this->approvalService->canSubmit($user, $pr, 'PR')) {
             abort(403, 'Cannot delete this PR.');
        }

        $pr->delete();
        return redirect()->route('pr.index')->with('success', 'PR deleted.');
    }
}
