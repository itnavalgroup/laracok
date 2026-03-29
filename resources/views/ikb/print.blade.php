<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print IKB - {{ $ikb->ikb_number ?? 'DRAFT' }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
            background: #fff;
        }

        /* ===== PAGE LAYOUT ===== */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .no-print {
            margin-bottom: 15px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                padding: 0;
            }

            .page-break {
                page-break-after: always;
            }
        }

        /* ===== HEADER ===== */
        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .doc-title h2 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .doc-title p {
            font-size: 10px;
            color: #555;
        }

        .doc-meta {
            text-align: right;
        }

        .doc-meta .ikb-number {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
            margin-top: 4px;
        }

        .bg-draft {
            background-color: #6c757d;
        }

        .bg-pending {
            background-color: #fd7e14;
        }

        .bg-approved {
            background-color: #198754;
        }

        .bg-rejected {
            background-color: #dc3545;
        }

        .qr-section {
            text-align: center;
        }

        .qr-section img {
            width: 80px;
            height: 80px;
        }

        /* ===== INFO GRID ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .info-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .info-table .label {
            font-weight: bold;
            color: #555;
            width: 140px;
            white-space: nowrap;
        }

        .info-table .colon {
            width: 12px;
        }

        .info-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* ===== ITEM TABLE ===== */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            background: #2d3748;
            color: #fff;
            padding: 6px 10px;
            margin: 12px 0 6px;
            border-radius: 4px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .item-table th {
            background: #f1f3f4;
            border: 1px solid #ddd;
            padding: 5px 8px;
            text-align: center;
            font-size: 10px;
        }

        .item-table td {
            border: 1px solid #ddd;
            padding: 4px 8px;
            font-size: 10px;
            vertical-align: top;
        }

        .item-table td.num {
            text-align: right;
        }

        .item-table td.center {
            text-align: center;
        }

        /* ===== SIGN FLOW ===== */
        .sign-section {
            margin-top: 16px;
            border-top: 1px solid #ccc;
            padding-top: 12px;
        }

        .sign-grid {
            display: grid;
            gap: 10px;
        }

        .sign-grid-5 {
            grid-template-columns: repeat(5, 1fr);
        }

        .sign-grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        .sign-box {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 8px;
            text-align: center;
            background: #fafafa;
        }

        .sign-box .sign-role {
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 4px;
            border-bottom: 1px solid #eee;
            padding-bottom: 4px;
            height: 26px;
        }

        .sign-box .sign-area {
            min-height: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .sign-box .sign-name {
            font-size: 9px;
            font-weight: bold;
            margin-top: 4px;
            color: #333;
        }

        .sign-box .sign-date {
            font-size: 8px;
            color: #777;
            margin-top: 2px;
        }

        .sign-box img.sign-img {
            width: 45px;
            height: 45px;
        }

        /* ===== FOOTER ===== */
        .print-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 9px;
            color: #999;
        }

        .btn-print {
            display: inline-block;
            padding: 8px 20px;
            background: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            margin-right: 8px;
        }

        .btn-back {
            display: inline-block;
            padding: 8px 20px;
            background: #6c757d;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="no-print" style="padding: 10px 0;">
            <button class="btn-print" onclick="window.print()">🖨️ Print / Download</button>
            <a href="{{ route('ikb.show', hashid_encode($ikb->id_ikb, 'ikb')) }}" class="btn-back">← Kembali</a>
        </div>

        <!-- ===== HEADER ===== -->
        <div class="doc-header">
            <div class="doc-title">
                <h2>Izin Keluar Barang (IKB)</h2>
                <p>{{ $ikb->company->company ?? '-' }} &bull; {{ $ikb->departement->departement ?? '-' }}</p>
            </div>
            <div class="doc-meta">
                <div class="ikb-number">{{ $ikb->ikb_number ?? 'DRAFT' }}</div>
                <span class="status-badge 
                @if($ikb->status == 0) bg-draft 
                @elseif($ikb->status == 10) bg-approved 
                @elseif($ikb->status == 12) bg-rejected 
                @else bg-pending @endif">
                    STATUS: {{ $ikb->status }}
                </span>
                <div style="margin-top: 4px; font-size: 10px; color:#555;">
                    {{ $ikb->created_at?->format('d M Y') }}
                </div>
            </div>
            <div class="qr-section no-print">
                @php
                $qrData = 'IKB|' . $ikb->id_ikb . '|' . $ikb->ikb_number . '|' . $ikb->status;
                $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=' . urlencode($qrData);
                @endphp
                <img src="{{ $qrUrl }}" alt="QR Code" title="{{ $ikb->ikb_number ?? '' }}">
            </div>
        </div>

        <!-- ===== IKB INFO ===== -->
        <div class="section-title">Informasi Dokumen</div>
        <table class="info-table">
            <tr>
                <td class="label">Tipe Transaksi</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->transactionType->transaction_type_name ?? ($ikb->transactionType->transaction_type ?? '-') }}</td>
                <td class="label">Vendor</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->vendor->vendor ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Creator / Pembuat</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->user->name ?? '-' }}</td>
                <td class="label">Sales / Requestor</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->salesUser->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Gudang / Warehouse</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->warehouse->warehouse_name ?? '-' }}</td>
                <td class="label">Tujuan / Destinasi</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->destination ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Booking</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->booking_date ? $ikb->booking_date->format('d M Y') : '-' }}</td>
                <td class="label">Tanggal Stuffing</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->stuffing_date ? $ikb->stuffing_date->format('d M Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Delivery</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->delivery_date ? $ikb->delivery_date->format('d M Y') : '-' }}</td>
                <td class="label">PO Number</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->po_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">SO Number</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->so_number ?? '-' }}</td>
                <td class="label">DO Number</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->do_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">RI Number</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->ri_number ?? '-' }}</td>
                <td class="label">SK Number</td>
                <td class="colon">:</td>
                <td class="value">{{ $ikb->sk_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Batch Number</td>
                <td class="colon">:</td>
                <td class="value" colspan="3">{{ $ikb->batch_number ?? '-' }}</td>
            </tr>
        </table>

        <!-- ===== ITEM TABLE ===== -->
        <div class="section-title">Detail Item IKB</div>
        <table class="item-table">
            <thead>
                <tr>
                    <th style="width:5%">No</th>
                    <th style="width:15%">Category</th>
                    <th style="width:15%">Kode Item</th>
                    <th style="width:20%">Nama Item</th>
                    <th style="width:10%">Qty</th>
                    <th style="width:10%">UOM</th>
                    <th style="width:10%">Packaging</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ikb->details as $i => $d)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $d->itemCategory->item_category ?? '-' }}</td>
                    <td>{{ $d->item->item_code ?? '-' }}</td>
                    <td>{{ $d->item->item_name ?? '-' }}</td>
                    <td class="center" style="font-weight: bold;">{{ number_format($d->qty, 2, ',', '.') }}</td>
                    <td class="center">{{ $d->uom->uom ?? '-' }}</td>
                    <td class="center">{{ $d->packaging->packaging ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="center" style="padding: 10px;">Belum ada item detail</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ===== SIGN FLOW ===== -->
        <div class="section-title mt-4">Persetujuan & Validasi (Izin Keluar Barang)</div>

        @php
        $signMap = [];
        foreach($ikb->signTransactions as $st) {
        $signMap[$st->status] = $st;
        }
        @endphp

        <div class="sign-section">
            <div class="sign-grid sign-grid-5">
                @php
                $step1_5 = [
                1 => 'SPV / MGR',
                2 => 'Dir Logistik',
                3 => 'PPIC',
                4 => 'Inventory Control',
                5 => 'Logistic Coord',
                ];
                @endphp
                @foreach($step1_5 as $step => $role)
                @php $st = $signMap[$step] ?? null; @endphp
                <div class="sign-box">
                    <div class="sign-role">{{ $role }}</div>
                    <div class="sign-area">
                        @if($st)
                        @if($st->qr)
                        <img src="{{ $st->qr }}" class="sign-img mb-1" alt="QR">
                        @else
                        <div style="font-size: 12px; color: #198754; font-weight: bold;">✓ Signed</div>
                        @endif
                        <div class="sign-name">{{ $st->user?->name ?? 'Unknown' }}</div>
                        <div class="sign-date">{{ $st->created_at->format('d/m/y H:i') }}</div>
                        @else
                        <div style="color:#ccc; font-size:9px;">-</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="sign-section" style="border-top: none; padding-top: 5px; margin-top: 5px;">
            <div class="sign-grid sign-grid-4">
                @php
                $step6_9 = [
                6 => 'Warehouse Staff',
                7 => 'Warehouse SPV',
                8 => 'Security Officer',
                9 => 'Log. Coord Final',
                ];
                @endphp
                @foreach($step6_9 as $step => $role)
                @php $st = $signMap[$step] ?? null; @endphp
                <div class="sign-box">
                    <div class="sign-role">{{ $role }}</div>
                    <div class="sign-area">
                        @if($st)
                        @if($st->qr)
                        <img src="{{ $st->qr }}" class="sign-img mb-1" alt="QR">
                        @else
                        <div style="font-size: 12px; color: #198754; font-weight: bold;">✓ Signed</div>
                        @endif
                        <div class="sign-name">{{ $st->user?->name ?? 'Unknown' }}</div>
                        <div class="sign-date">{{ $st->created_at->format('d/m/y H:i') }}</div>
                        @else
                        <div style="color:#ccc; font-size:9px;">-</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ===== FOOTER ===== -->
        <div class="print-footer">
            Dokumen dicetak dari Sistem PPD &bull; {{ now()->format('d F Y H:i:s') }}
        </div>
    </div>
</body>

</html>