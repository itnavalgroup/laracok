<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Production Print - {{ $production->production_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase;}
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 4px; vertical-align: top; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items-table th, .items-table td { border: 1px solid #000; padding: 6px; }
        .items-table th { background-color: #f0f0f0; }
        .signature-section { width: 100%; margin-top: 40px; display: table; }
        .signature-box { display: inline-block; width: 30%; text-align: center; margin-right: 2%; vertical-align: top;}
        .signature-box img { max-width: 80px; max-height: 80px; margin-top: 5px; margin-bottom: 5px; }
        .qr-placeholder { height: 80px; width: 80px; margin: 5px auto; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; color: #999;font-size: 10px;}
        .sign-title { font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 5px;}
        .sign-name { text-decoration: underline; font-weight: bold; margin-top: 10px;}
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">Print Document</button>
    </div>

    <div class="header">
        <h2>PRODUCTION REPORT</h2>
        <div>Number: {{ $production->production_number }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Date</strong></td>
            <td width="35%">: {{ \Carbon\Carbon::parse($production->production_date)->format('d F Y') }}</td>
            <td width="15%"><strong>Company</strong></td>
            <td width="35%">: {{ $production->company->company_name ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Warehouse</strong></td>
            <td>: {{ $production->warehouse->warehouse_name ?? '-' }}</td>
            <td><strong>Department</strong></td>
            <td>: {{ $production->departement->departement ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td colspan="3">: {{ $production->description }}</td>
        </tr>
    </table>

    <h4>Raw Materials (Inputs)</h4>
    <table class="items-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Code</th>
                <th width="55%">Item Name</th>
                <th width="20%">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($production->materials as $index => $mat)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $mat->item->item_code ?? '' }}</td>
                <td>{{ $mat->item->item ?? '-' }}</td>
                <td style="text-align: right;">{{ floatval($mat->qty) }} {{ $mat->uom->uom ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Production Results (Outputs)</h4>
    <table class="items-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Code</th>
                <th width="55%">Item Name</th>
                <th width="20%">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($production->results as $index => $res)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $res->item->item_code ?? '' }}</td>
                <td>{{ $res->item->item ?? '-' }}</td>
                <td style="text-align: right;">{{ floatval($res->qty) }} {{ $res->uom->uom ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <!-- Box 0 - Requested By -->
        <div class="signature-box">
            <div class="sign-title">Requested By</div>
            @if($production->status >= 1)
                @php
                    $qr = new \Endroid\QrCode\QrCode($production->user->name . ' - ' . $production->created_at->format('Y-m-d H:i'));
                    $writer = new \Endroid\QrCode\Writer\PngWriter();
                    $qrImg = $writer->write($qr)->getDataUri();
                @endphp
                <img src="{{ $qrImg }}" alt="QR Requested">
                <div class="sign-name">{{ $production->user->name }}</div>
                <div>{{ $production->created_at->format('d/m/Y H:i') }}</div>
            @else
                <div class="qr-placeholder">Q R</div>
                <div class="sign-name">( .................... )</div>
            @endif
        </div>

        <!-- Box 1 - Processed -->
        <div class="signature-box">
            <div class="sign-title">Processed</div>
            @if($production->status >= 2 && $production->processedBy)
                @php
                    $qr = new \Endroid\QrCode\QrCode($production->processedBy->name . ' - Processed');
                    $writer = new \Endroid\QrCode\Writer\PngWriter();
                    $qrImg = $writer->write($qr)->getDataUri();
                @endphp
                <img src="{{ $qrImg }}" alt="QR Processed">
                <div class="sign-name">{{ $production->processedBy->name }}</div>
            @else
                <div class="qr-placeholder">Q R</div>
                <div class="sign-name">( .................... )</div>
            @endif
        </div>

        <!-- Box 2 - Verified By -->
        <div class="signature-box">
            <div class="sign-title">Verified By</div>
            @if($production->status == 3 && $production->finishedBy)
                @php
                    $qr = new \Endroid\QrCode\QrCode($production->finishedBy->name . ' - Verified');
                    $writer = new \Endroid\QrCode\Writer\PngWriter();
                    $qrImg = $writer->write($qr)->getDataUri();
                @endphp
                <img src="{{ $qrImg }}" alt="QR Verified">
                <div class="sign-name">{{ $production->finishedBy->name }}</div>
            @else
                <div class="qr-placeholder">Q R</div>
                <div class="sign-name">( .................... )</div>
            @endif
        </div>
    </div>

</body>
</html>
