<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - {{ $payment->pr->pr_number ?? 'PR' }}</title>
    <style>
        @page {
            size: A5 landscape;
            margin: 10mm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #28a745;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .header-logo {
            width: 120px;
            height: auto;
            margin-right: 15px;
        }

        .header-info {
            flex-grow: 1;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 2px 0;
            color: #28a745;
        }

        .company-address {
            margin: 0;
            font-size: 10px;
            color: #555;
        }

        .receipt-title {
            text-align: right;
            padding-right: 10px;
        }

        .receipt-title h1 {
            color: #28a745;
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .receipt-number {
            font-size: 12px;
            font-weight: bold;
            color: #333;
            margin-top: 2px;
        }

        /* MAIN TWO COLUMNS */
        .content-wrap {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .col-left, .col-right {
            width: 48%;
        }

        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 10px;
        }

        .info-title {
            font-size: 10px;
            font-weight: bold;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 2px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 2px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .info-table th {
            text-align: left;
            padding: 3px 0;
            font-weight: normal;
            color: #555;
            width: 40%;
        }

        .info-table td {
            padding: 3px 0;
            font-weight: bold;
        }

        /* DETAILS (DESCRIPTION) */
        .desc-box {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .desc-header {
            background-color: #f1f3f5;
            padding: 5px 8px;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }

        .desc-body {
            padding: 10px;
            min-height: 40px;
            font-size: 12px;
        }

        /* AMOUNT & SIGNATURE */
        .bottom-wrap {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .amount-section {
            width: 50%;
        }

        .amount-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .amount-table th {
            text-align: right;
            padding: 4px 8px;
            font-weight: normal;
            color: #555;
            background-color: #f8f9fa;
            border-bottom: 1px solid #fff;
        }

        .amount-table td {
            text-align: right;
            padding: 4px 8px;
            font-weight: bold;
            background-color: #f8f9fa;
            border-bottom: 1px solid #fff;
            width: 40%;
        }

        .amount-table tr.total-row th,
        .amount-table tr.total-row td {
            background-color: #28a745;
            color: white;
            font-size: 13px;
            border-bottom: none;
        }

        /* SIGNATURES */
        .signatures {
            width: 45%;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .sign-box {
            text-align: center;
            width: 120px;
            font-size: 10px;
        }

        .sign-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
            border-bottom: 1px solid #ddd;
            padding-bottom: 2px;
        }

        .qr-placeholder {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-style: italic;
            border: 1px dashed #ddd;
            margin-bottom: 5px;
        }

        .qr-img {
            max-width: 70px;
            max-height: 70px;
            margin-bottom: 5px;
        }

        .sign-name {
            font-weight: bold;
            text-transform: uppercase;
        }

        .sign-date {
            color: #777;
            font-size: 9px;
        }

        /* Print Specific */
        @media print {
            body {
                background: none;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            .container { margin: 0; width: 100%; max-width: none; }
            .info-box, .amount-table th, .amount-table td { background-color: #f8f9fa !important; }
            .desc-header { background-color: #f1f3f5 !important; }
            .amount-table tr.total-row th, .amount-table tr.total-row td { background-color: #28a745 !important; color: white !important; }
        }

        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        
        /* Flex fallback for dompdf (if used) */
        .flex-row { width: 100%; clear: both; overflow: hidden; }
        .flex-col-left { float: left; width: 48%; }
        .flex-col-right { float: right; width: 48%; }
        .flex-clear { clear: both; }
    </style>
</head>
<body>

@php
    $sr = $payment->pr;
    $symbol = $sr->currency->symbol ?? 'Rp';
@endphp

<div class="container">
    <div class="header flex-row">
        <div style="float: left; width: 60%">
            @php
                $logoPath = public_path('storage/logo/logo.png');
                if(!file_exists($logoPath)) {
                    // Fallback try legacy app logo
                    $logoPath = public_path('app-assets/images/logo/logo.png');
                    if(!file_exists($logoPath)) {
                        $logoPath = null;
                    }
                }
            @endphp
            @if($logoPath)
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}" class="header-logo" alt="Logo" style="float: left; margin-bottom: 10px;">
            @endif
            <div class="header-info" style="float: left; padding-top: 5px;">
                <h2 class="company-name">{{ $sr->company->company ?? 'SISTEM ERP' }}</h2>
                <p class="company-address">{{ $sr->company->address ?? '' }}</p>
                <p class="company-address">Phone: {{ $sr->company->phone ?? '-' }} | Email: {{ $sr->company->email ?? '-' }}</p>
            </div>
            <div class="flex-clear"></div>
        </div>
        <div class="receipt-title" style="float: right; width: 40%; text-align: right;">
            <h1>PAYMENT RECEIPT</h1>
            <div class="receipt-number">
                PR: {{ $sr->pr_number }}<br>
                Date: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') }}
            </div>
        </div>
        <div class="flex-clear"></div>
    </div>

    <div class="content-wrap flex-row">
        <div class="col-left flex-col-left">
            <div class="info-box">
                <div class="info-title">Payment To</div>
                <table class="info-table">
                    <tr>
                        <th>Vendor</th>
                        <td>: {{ $sr->vendor->vendor ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>: {{ $payment->nama_bank ?: ($sr->norek_vendor->nama_bank ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Account Name</th>
                        <td>: {{ $payment->nama_penerima ?: ($sr->norek_vendor->nama_penerima ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Account No</th>
                        <td>: {{ $payment->norek ?: ($sr->norek_vendor->norek ?? '-') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-right flex-col-right">
            <div class="info-box">
                <div class="info-title">Payment Details</div>
                <table class="info-table">
                    <tr>
                        <th>Subject</th>
                        <td>: {{ $sr->subject }}</td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>: {{ $payment->payment_type == 1 ? 'Parsial' : 'Full' }}</td>
                    </tr>
                    <tr>
                        <th>Method</th>
                        <td>: {{ $payment->payment_method == 1 ? 'Transfer' : ($payment->payment_method == 2 ? 'Cash' : '-') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: {{ $payment->status == 2 ? 'PAID' : 'PENDING' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="flex-clear"></div>
    </div>

    <div class="desc-box">
        <div class="desc-header">DESCRIPTION / NOTES</div>
        <div class="desc-body">
            {{ $payment->payment_description ?: ($sr->subject . ' - Payment #' . $payment->id_payment) }}
            @if($payment->reason)
                <br><br>
                <strong>Notes/Reason:</strong> {{ $payment->reason }}
            @endif
        </div>
    </div>

    <div class="bottom-wrap flex-row" style="margin-top: 10px;">
        <div class="amount-section flex-col-left" style="width: 50%;">
            <table class="amount-table">
                <tr>
                    <th>Payment Amount</th>
                    <td>{{ $symbol }} {{ number_format($payment->ammount, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Additional Fee / Tax</th>
                    <td>{{ $symbol }} {{ number_format($payment->additional ?? 0, 2, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <th>GRAND TOTAL</th>
                    <td>{{ $symbol }} {{ number_format($payment->grand_total, 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="signatures flex-col-right" style="width: 48%; text-align: right;">
            @if($sr->payment_type_pr == 1)
                <!-- MANAGER SIGN -->
                <div class="sign-box" style="display: inline-block; vertical-align: top; margin-right: 15px;">
                    <div class="sign-title">Manager</div>
                    @if(str_contains($payment->filename ?? '', 'approved_manager') || str_contains($payment->filename ?? '', 'approved_director'))
                        <img src="data:image/svg+xml;base64,{{ base64_encode(generateQrSvg('Approved by Manager: ' . $sr->pr_number . ' - ' . \Carbon\Carbon::parse($payment->updated_at)->format('Y-m-d H:i'), 80, 0)) }}" class="qr-img" alt="QR Sign">
                        <div class="sign-name">APPROVED</div>
                        <div class="sign-date">{{ \Carbon\Carbon::parse($payment->updated_at)->format('d M Y H:i') }}</div>
                    @else
                        <div class="qr-placeholder">Pending</div>
                        <div class="sign-name">-</div>
                    @endif
                </div>
            @endif

            <!-- DIRECTOR SIGN -->
            <div class="sign-box" style="display: inline-block; vertical-align: top;">
                <div class="sign-title">Director</div>
                @if(str_contains($payment->filename ?? '', 'approved_director'))
                    <img src="data:image/svg+xml;base64,{{ base64_encode(generateQrSvg('Approved by Director: ' . $sr->pr_number . ' - ' . \Carbon\Carbon::parse($payment->updated_at)->format('Y-m-d H:i'), 80, 0)) }}" class="qr-img" alt="QR Sign">
                    <div class="sign-name">APPROVED</div>
                    <div class="sign-date">{{ \Carbon\Carbon::parse($payment->updated_at)->format('d M Y H:i') }}</div>
                @elseif($payment->filename === 'approved_by_system')
                    <img src="data:image/svg+xml;base64,{{ base64_encode(generateQrSvg('Auto Approved (Full Payment): ' . $sr->pr_number, 80, 0)) }}" class="qr-img" alt="QR">
                    <div class="sign-name">AUTO APPROVED</div>
                    <div class="sign-date">{{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y H:i') }}</div>
                @else
                    <div class="qr-placeholder">Pending</div>
                    <div class="sign-name">-</div>
                @endif
            </div>
            <div class="flex-clear"></div>
        </div>
        <div class="flex-clear"></div>
    </div>
    
    <div style="margin-top: 30px; font-size: 9px; color: #888; text-align: center; border-top: 1px solid #eee; padding-top: 5px;">
        Generated by Sistem ERP PPD on {{ date('d M Y H:i:s') }}. This is an electronically generated receipt and is valid without a physical signature if QR codes are present.
    </div>
</div>

<script>
    // Trigger print dialog on load if intended for printing directly
    // This script will only run in the browser if printed via HTML route, not in PDF generation 
    window.onload = function() {
        if(window.location.href.indexOf('download') === -1) {
            // Optional: window.print();
        }
    };
</script>
</body>
</html>
