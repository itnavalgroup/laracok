<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Invoice <?php echo e($invoice->invoice_number); ?></title>
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="/assets/css/style-preset.css">

    <!-- [Favicon] -->
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">

    <!-- [Plugin CSS] -->
    <link rel="stylesheet" href="/assets/css/plugins/style.css">
    <link rel="stylesheet" href="/assets/css/plugins/dataTables.bootstrap5.min.css">

    <!-- [Fonts & Icons] -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <link rel="stylesheet" href="/assets/fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="/assets/fonts/feather.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="/assets/fonts/material.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        #pdfContent {
            font-size: 20px;
            line-height: 1.5;
            padding: 20px;
            background: #fff;
            color: #000;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
                padding: 0;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            #pdfContent {
                padding: 0 !important;
                font-size: 14px;
            }

            /* Menyesuaikan table font lebih kecil saat diprint agar muat 1 halaman */
            table td,
            table th {
                padding: 4px 6px !important;
            }
        }

        @page {
            size: a4;
            margin: 10mm;
        }
    </style>
</head>
<!-- [Head] end -->

<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <?php
    $symbol = $pr->currency->symbol ?? 'Rp';
    $discount = floatval($pr->additional_discount ?? 0);
    $grandTotal = $detail->sum('ammount') - $discount;

    $norekVendor = $pr->norek_vendor;
    $bankName = $invoice->nama_bank ?: ($norekVendor?->nama_bank ?? '-');
    $bankAccount = $invoice->norek ?: ($norekVendor?->norek ?? '-');
    $bankHolder = $invoice->nama_penerima ?: ($norekVendor?->nama_penerima ?? '-');

    // Handle JSON array in account number if it somehow appears here too
    if (is_string($bankAccount) && str_starts_with(trim($bankAccount), '{')) {
    $parsed = json_decode($bankAccount, true);
    if (is_array($parsed)) {
    $bankAccount = $parsed['norek'] ?? ($norekVendor?->norek ?? '-');
    if ($bankName === '-' || empty($bankName)) $bankName = $parsed['nama_bank'] ?? '-';
    if ($bankHolder === '-' || empty($bankHolder)) $bankHolder = $parsed['nama_penerima'] ?? '-';
    }
    }
    ?>

    <div class="my-3 mx-3 no-print">
        <button id="downloadPdf" class="btn btn-primary">Download PDF</button>
        <button onclick="window.print()" class="btn btn-success"><i class="fas fa-print me-2"></i> Print Invoice</button>
        <button onclick="window.close()" class="btn btn-secondary ms-2"><i class="fas fa-times me-2"></i> Tutup</button>
    </div>
    <div id="progressStatus" style="display:none; padding:10px; background:#eee; margin-top:10px;" class="no-print">
        Preparing PDF...
    </div>

    <div id="pdfContent">
        <div class="containner">
            <div class="card shadow-none border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <div class="text-center">
                            <div style="font-weight: 600; color: #2c3e1f;font-size: 24px;">INVOICE</div>
                        </div>
                    </div>
                    <hr>

                    <!-- Data utama -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">TO</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8" style="text-align: justify;"><?php echo e($pr->company->company ?? '-'); ?></div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">TRUCK</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8" style="text-align: justify;"><?php echo e($invoice->truck ?? '-'); ?></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">INVOICE DATE</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8"><?php echo e($invoice->invoice_date ? $invoice->invoice_date->format('d/m/Y') : '-'); ?></div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">INVOICE NUMBER</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8" style="text-align: justify;"><?php echo e($invoice->invoice_number); ?></div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">DELIVERY DATE</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8"><?php echo e($invoice->delivery_date ? $invoice->delivery_date->format('d/m/Y') : '-'); ?></div>
                            </div>
                        </div>

                        <!-- table -->
                        <div class="table-responsive dt-responsive">
                            <table id="c-tool-ele" class="table table-striped table-bordered nowrap">
                                <thead class="text-center" style="background-color: green; color:white;">
                                    <tr>
                                        <th>No</th>
                                        <th>DESCRIPTION</th>
                                        <th>QTY</th>
                                        <th>UOM</th>
                                        <th>UNIT PRICE</th>
                                        <th>DISCOUNT</th>
                                        <th>VAT</th>
                                        <th>PPH</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($key + 1); ?></td>
                                        <td class="text-wrap" style="max-width: 360px;"><?php echo e($value->detail); ?></td>
                                        <td class="text-center"><?php echo e(number_format($value->qty, 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo e($value->uom->uom ?? '-'); ?></td>
                                        <td class="text-center"><?php echo e($symbol); ?> <?php echo e(number_format($value->price, 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo e($symbol); ?> <?php echo e(number_format($value->discount, 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo e($symbol); ?> <?php echo e(number_format($value->tax1, 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo e($symbol); ?> <?php echo e(number_format($value->tax2, 2, ',', '.')); ?></td>
                                        <td class="fw-bold"><?php echo e($symbol); ?> <?php echo e(number_format($value->ammount, 2, ',', '.')); ?></td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($detail) == 0): ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada item</td>
                                    </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" style="text-align: right; background-color: darkseagreen;">ADDITIONAL DISCOUNT</th>
                                        <th colspan="1"><?php echo e($symbol); ?> <?php echo e(number_format($discount, 0, ',', '.')); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" style="text-align: right; background-color: darkseagreen;">TOTAL PAYMENT</th>
                                        <th colspan="1"><?php echo e($symbol); ?> <?php echo e(number_format($grandTotal, 0, ',', '.')); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- end table -->
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">BANK NAME</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8"><?php echo e($bankName); ?></div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">ACCOUNT NAME</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8"><?php echo e($bankHolder); ?></div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-3 fw-bold">ACCOUNT NUMBER</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8"><?php echo e($bankAccount); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-end">
                            <div class="text-start" style="margin-right: 120px;">
                                <!-- Vendor -->
                                <div class="fw-bold">VERIFIED BY :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <!-- Garis pertama -->
                                <div style="border-bottom: 1px solid #000; width: auto; margin: 4px 0;"></div>

                                <div class="fw-bold">NAME :</div>

                            </div>
                            <div class="text-start" style="margin-right: 120px;">
                                <!-- Vendor -->
                                <div class="fw-bold"><?php echo e($pr->vendor->vendor ?? 'VENDOR'); ?></div>
                                <!-- Garis pertama -->
                                <div style="border-bottom: 1px solid #000; width: auto; margin: 4px 0;"></div>
                                <div class="fw-bold">NAME :</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================== [ JAVASCRIPT ] ================== -->

    <!-- jQuery harus paling awal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Core Plugins -->
    <script src="/assets/js/plugins/popper.min.js"></script>
    <script src="/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/simplebar.min.js"></script>
    <script src="/assets/js/plugins/feather.min.js"></script>
    <script src="/assets/js/fonts/custom-font.js"></script>
    <script src="/assets/js/pcoded.js"></script>

    <!-- DataTables -->
    <script src="/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugins/dataTables.bootstrap5.min.js"></script>

    <script>
        const { jsPDF } = window.jspdf;

        // Handle auto-actions from silent iframe
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const action = urlParams.get('action');

            if (action === 'download') {
                // Trigger download automatically
                document.getElementById('downloadPdf').click();
            } else if (action === 'print') {
                // Trigger canvas-based print (same as download result)
                silentPrint();
            }
        });

        // Main Download Logic
        document.getElementById('downloadPdf').addEventListener('click', () => {
            const content = document.getElementById('pdfContent');
            const progress = document.getElementById('progressStatus');

            // Tampilkan status
            progress.style.display = "block";
            progress.innerText = "Rendering content...";

            const width = content.scrollWidth + 60; // Buffer lebih besar untuk mencegah terpotong
            const height = content.scrollHeight;

            html2canvas(content, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                width: width,
                height: height,
                windowWidth: width
            }).then(canvas => {
                progress.innerText = "Compressing image...";
                const imgData = canvas.toDataURL('image/jpeg', 0.95);

                progress.innerText = "Generating PDF...";
                const pdf = new jsPDF('p', 'pt', 'a4');
                const margin = 30;
                const pageWidth = pdf.internal.pageSize.getWidth() - (margin * 2);
                const pageHeight = pdf.internal.pageSize.getHeight() - (margin * 2);

                const imgWidth = canvas.width;
                const imgHeight = canvas.height;

                const widthRatio = pageWidth / imgWidth;
                const heightRatio = pageHeight / imgHeight;
                const scale = Math.min(widthRatio, heightRatio);

                const finalWidth = imgWidth * scale;
                const finalHeight = imgHeight * scale;

                const x = (pdf.internal.pageSize.getWidth() - finalWidth) / 2;
                const y = margin;

                pdf.addImage(imgData, 'JPEG', x, y, finalWidth, finalHeight);

                progress.innerText = "Saving file...";
                pdf.save('invoice.pdf');

                // Send message back to parent to reset loading button
                window.parent.postMessage({ action: 'done' }, '*');

                // Sembunyikan status setelah selesai
                setTimeout(() => {
                    progress.style.display = "none";
                }, 1000);
            });
        });

        // Canvas-based silent print — identical to PDF output, no popup
        function silentPrint() {
            const content = document.getElementById('pdfContent');
            const progress = document.getElementById('progressStatus');
            progress.style.display = "block";
            progress.innerText = "Preparing print...";

            const width = content.scrollWidth + 60;
            const height = content.scrollHeight;

            html2canvas(content, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                width: width,
                height: height,
                windowWidth: width
            }).then(canvas => {
                progress.innerText = "Opening print dialog...";
                const imgData = canvas.toDataURL('image/png');

                // Create a hidden iframe to print inside without opening a new window
                let printFrame = document.getElementById('__printFrame');
                if (!printFrame) {
                    printFrame = document.createElement('iframe');
                    printFrame.id = '__printFrame';
                    printFrame.style.cssText = 'position:fixed;top:-9999px;left:-9999px;width:1px;height:1px;border:none;';
                    document.body.appendChild(printFrame);
                }

                const doc = printFrame.contentDocument || printFrame.contentWindow.document;
                doc.open();
                doc.write('<html><head><style>');
                doc.write('body{margin:0;padding:0;text-align:center;}');
                doc.write('@media print{body{margin:0;} img{max-width:100%;height:auto;display:block;margin:auto;page-break-inside:avoid;}}');
                doc.write('</style></head><body>');
                doc.write('<img src="' + imgData + '" style="max-width:100%;height:auto;display:block;margin:auto;">');
                doc.write('</body></html>');
                doc.close();

                setTimeout(() => {
                    printFrame.contentWindow.focus();
                    printFrame.contentWindow.print();
                    progress.style.display = "none";
                    window.parent.postMessage({ action: 'done' }, '*');
                }, 300);
            });
        }
    </script>
</body>
<!-- [Body] end -->

</html><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\payment-requests\invoice-print.blade.php ENDPATH**/ ?>