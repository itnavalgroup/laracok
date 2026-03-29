<?php
/**
 * Fix all broken seeder files:
 * 1. TblInvoiceSeeder - replace broken \r literal with correct content
 * 2. TblSrSeeder - fix wrong data for ID 59, 63, 64
 * 3. TblDetailSrSeeder - fix NULL values for ID 171-188
 * 4. TblAttachmentSrSeeder - add missing ID 142-151
 */

$seederDir = __DIR__ . '/../seeders';

// ===================================================
// 1. FIX TblInvoiceSeeder - Remove broken content, add correct entries
// ===================================================
echo "=== Fixing TblInvoiceSeeder ===\n";

$invoiceFile = $seederDir . '/TblInvoiceSeeder.php';
$content = file_get_contents($invoiceFile);

// The broken content starts at position 63967 (after ID 68 ], at 63943)
// Cut everything from the broken part to the end of the payload
$cutPoint = strpos($content, "],\r\n                    [\\r\r\n                        'id_invoice' => 69,");
if ($cutPoint === false) {
    echo "  ERROR: Could not find the broken cutpoint\n";
} else {
    $beforeBroken = substr($content, 0, $cutPoint + 2); // include the ], from ID 68
    
    // The new entries to add (properly formatted)
    $newEntries = <<<'PHP'

                    [
                        'id_invoice' => 69,
                        'id_user' => 40,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 81,
                        'id_doc_type' => 1,
                        'id_pr' => 1172,
                        'id_norek_vendor' => 354,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'NASIRUDIN',
                        'norek' => '1057562486',
                        'truck' => 'BL 8462 PG, BL 8316 CO, BL 8316 VO',
                        'invoice_date' => '2026-03-16 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.057',
                        'delivery_date' => '2026-03-13 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-16 06:05:59',
                        'updated_at' => '2026-03-16 06:05:59',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 70,
                        'id_user' => 50,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 268,
                        'id_doc_type' => 1,
                        'id_pr' => 1169,
                        'id_norek_vendor' => 272,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'KARI',
                        'norek' => '7257605838',
                        'truck' => 'BL 8649F',
                        'invoice_date' => '2026-03-13 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.058',
                        'delivery_date' => '2026-03-13 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-16 06:14:25',
                        'updated_at' => '2026-03-16 06:14:25',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 71,
                        'id_user' => 50,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 268,
                        'id_doc_type' => 1,
                        'id_pr' => 1170,
                        'id_norek_vendor' => 272,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'KARI',
                        'norek' => '7257605838',
                        'truck' => 'BL8649F/BK9750BFD',
                        'invoice_date' => '2026-03-14 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.059',
                        'delivery_date' => '2026-03-14 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-16 06:17:56',
                        'updated_at' => '2026-03-16 06:17:56',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 72,
                        'id_user' => 40,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 81,
                        'id_doc_type' => 1,
                        'id_pr' => 1171,
                        'id_norek_vendor' => 354,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'NASIRUDIN',
                        'norek' => '1057562486',
                        'truck' => 'BL 8316 VO',
                        'invoice_date' => '2026-03-12 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.060',
                        'delivery_date' => '2026-03-12 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-16 06:32:03',
                        'updated_at' => '2026-03-16 06:32:03',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 73,
                        'id_user' => 40,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 78,
                        'id_doc_type' => 1,
                        'id_pr' => 1174,
                        'id_norek_vendor' => 355,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'Muhtada Hairy',
                        'norek' => '7302112872',
                        'truck' => 'BL 8627 GB',
                        'invoice_date' => '2026-03-16 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.061',
                        'delivery_date' => '2026-03-14 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-16 06:49:38',
                        'updated_at' => '2026-03-16 06:49:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 74,
                        'id_user' => 41,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 96,
                        'id_doc_type' => 1,
                        'id_pr' => 1178,
                        'id_norek_vendor' => 95,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'Syali Indra, S.Sos. I',
                        'norek' => '1050352672',
                        'truck' => 'BL 6201 B, BL 8376 B, BL 8470 JM',
                        'invoice_date' => '2026-03-16 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.062',
                        'delivery_date' => '2026-03-15 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-17 04:50:40',
                        'updated_at' => '2026-03-17 04:50:40',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 75,
                        'id_user' => 50,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 268,
                        'id_doc_type' => 1,
                        'id_pr' => 1183,
                        'id_norek_vendor' => 272,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'KARI',
                        'norek' => '7257605838',
                        'truck' => 'BK 9750 BED / BL 8649 F',
                        'invoice_date' => '2026-03-16 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.063',
                        'delivery_date' => '2026-03-16 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-17 05:05:31',
                        'updated_at' => '2026-03-17 05:05:45',
                        'deleted_at' => null,
                    ],
                    [
                        'id_invoice' => 76,
                        'id_user' => 41,
                        'id_departement' => 8,
                        'id_company' => 6,
                        'id_vendor' => 96,
                        'id_doc_type' => 1,
                        'id_pr' => 1198,
                        'id_norek_vendor' => 95,
                        'nama_bank' => 'BSI',
                        'nama_penerima' => 'Syali Indra, S.Sos. I',
                        'norek' => '1050352672',
                        'truck' => 'BL 8201 B',
                        'invoice_date' => '2026-03-16 00:00:00',
                        'invoice_number' => 'INVOICE.KSA.2603.064',
                        'delivery_date' => '2026-03-16 00:00:00',
                        'file_name' => null,
                        'created_at' => '2026-03-18 05:39:03',
                        'updated_at' => '2026-03-18 05:39:03',
                        'deleted_at' => null,
                    ],
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_invoice')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
PHP;

    // Convert LF to CRLF to match the rest of the file
    $newEntries = str_replace("\n", "\r\n", $newEntries);
    
    $newContent = $beforeBroken . $newEntries;
    file_put_contents($invoiceFile, $newContent);
    echo "  Fixed! New size: " . strlen($newContent) . " bytes\n";
    
    // Verify the fix
    $verify = file_get_contents($invoiceFile);
    preg_match_all("/'id_invoice'\s*=>\s*(\d+)/", $verify, $m);
    echo "  Invoice count after fix: " . count($m[1]) . " (expected 69)\n";
    echo "  Last IDs: " . implode(', ', array_slice($m[1], -5)) . "\n";
}

// ===================================================
// 2. FIX TblSrSeeder - Fix wrong data for ID 59, 63, 64
// ===================================================
echo "\n=== Fixing TblSrSeeder (updating ID 59, 63, 64 from SQL lama) ===\n";

$srFile = $seederDir . '/TblSrSeeder.php';
$srContent = file_get_contents($srFile);

// --- Fix ID 59: Update wrong vendor/norek/subject/status ---
// Old (wrong in seeder):
// id_vendor => 206, id_email_vendor => 0, id_norek_vendor => 208
// subject => 'SETTLEMENT KASBON SAHUDIN AMRY KE NAMORAMBE SELAMA 1 MINGGU (03 - 09 MARET 2026)'
// qr => NULL, status => 0

// Correct from SQL:
// id_vendor => 168, id_email_vendor => 76, id_norek_vendor => 174
// subject => 'SETTLEMENT KASBON SAHUDIN AMRY KE NAMORAMBE  (03 - 09 MARET 2026) (10 - 15 MARET)'
// qr => 'submit_SR_by5259', status => 6, updated_at => '2026-03-18 03:10:42'

// Find the ID 59 block in the SR seeder
$id59Pos = strpos($srContent, "'id_sr' => 59,");
if ($id59Pos !== false) {
    echo "  Found ID 59 in SR seeder\n";
    // We'll fix specific fields using php str_replace approach
    
    // Fix 1: id_vendor 206 -> 168 (only in context of id_sr=59 block)
    // Find the block start
    $blockStart = $id59Pos;
    // Find block end (next id_sr or end of payload)
    $blockEnd = strpos($srContent, "'id_sr' =>", $id59Pos + 20);
    if ($blockEnd === false) $blockEnd = strlen($srContent);
    
    $id59Block = substr($srContent, $blockStart - 100, $blockEnd - $blockStart + 100);
    echo "  ID 59 block excerpt: " . substr($id59Block, 0, 200) . "\n";
} else {
    echo "  ID 59 not found!\n";
}

// Read the full seeder to do replacements
// Find start of ID 59 entry
if (preg_match("/('id_sr'\s*=>\s*59,.*?'updated_at'\s*=>\s*'[^']+',\s*'deleted_at'[^]]+\],)/s", $srContent, $match59, PREG_OFFSET_CAPTURE)) {
    echo "  Found full ID 59 block\n";
    $old59 = $match59[0][0];
    
    $new59 = preg_replace("/'id_vendor'\s*=>\s*\d+,/", "'id_vendor' => 168,", $old59);
    $new59 = preg_replace("/'id_email_vendor'\s*=>\s*\d+,/", "'id_email_vendor' => 76,", $new59);
    $new59 = preg_replace("/'id_norek_vendor'\s*=>\s*\d+,/", "'id_norek_vendor' => 174,", $new59);
    $new59 = preg_replace("/'subject'\s*=>\s*'[^']+',/", "'subject' => 'SETTLEMENT KASBON SAHUDIN AMRY KE NAMORAMBE  (03 - 09 MARET 2026) (10 - 15 MARET)',", $new59);
    $new59 = preg_replace("/'qr'\s*=>\s*null,/", "'qr' => 'submit_SR_by5259',", $new59);
    $new59 = preg_replace("/'status'\s*=>\s*\d+,/", "'status' => 6,", $new59);
    $new59 = preg_replace("/'updated_at'\s*=>\s*'[^']+',/", "'updated_at' => '2026-03-18 03:10:42',", $new59);
    
    $srContent = str_replace($old59, $new59, $srContent);
    echo "  ID 59 fixed\n";
}

// Fix ID 63 and 64 - these have many NULL values in seeder but real data in SQL
// For ID 63 from SQL:
// id_doc_type=3, id_cost_type=16, id_cost_category=10, id_branch=1, id_departement=17,
// id_company=6, id_email_vendor=116, id_norek_vendor=216, id_email_user=0
// subject='PENYEIESAIAN PERJADIN UNTUK PEMBELIAN TERPENTIN 20 TON DI PERHUTANI JAWA BARAT/NAGREG'
// additional_discount=0, payment_method=1, nom=0, norek='', qr='submit_SR_by3463'

foreach ([63 => [
    'id_doc_type' => 3, 'id_cost_type' => 16, 'id_cost_category' => 10, 'id_branch' => 1,
    'id_departement' => 17, 'id_company' => 6, 'id_email_vendor' => 116, 'id_norek_vendor' => 216,
    'id_email_user' => 0, 
    'subject' => 'PENYEIESAIAN PERJADIN UNTUK PEMBELIAN TERPENTIN 20 TON DI PERHUTANI JAWA BARAT/NAGREG',
    'additional_discount' => '0.0000', 'payment_method' => 1, 'nama_bank' => '', 'nama_penerima' => '', 'norek' => '',
    'qr' => 'submit_SR_by3463',
], 64 => [
    'id_doc_type' => 3, 'id_cost_type' => 16, 'id_cost_category' => 10, 'id_branch' => 1,
    'id_departement' => 6, 'id_company' => 1, 'id_email_vendor' => 0, 'id_norek_vendor' => 207,
    'id_email_user' => 126,
    'subject' => 'SETTLEMENT BIAYA PERJADIN PAK KAMIJA KE ACEH 6 HARI ( 02 - 07 MARET 2026) UNTUK SURVEY AREAL SADAPAN DI PT THL',
    'additional_discount' => '0.0000', 'payment_method' => 1, 'nama_bank' => '', 'nama_penerima' => '', 'norek' => '',
    'qr' => 'submit_SR_by5264',
]] as $srId => $fixes) {
    $pattern = "/'id_sr'\s*=>\s*{$srId},.*?'deleted_at'\s*=>[^]]+\],/s";
    if (preg_match($pattern, $srContent, $matchN, PREG_OFFSET_CAPTURE)) {
        $oldBlock = $matchN[0][0];
        $newBlock = $oldBlock;
        
        foreach ($fixes as $col => $val) {
            if (is_int($val) || is_float($val)) {
                $newBlock = preg_replace("/'" . preg_quote($col) . "'\s*=>\s*(?:null|\d+(?:\.\d+)?),/", "'{$col}' => {$val},", $newBlock);
            } else {
                $escapedVal = addslashes($val);
                $newBlock = preg_replace("/'" . preg_quote($col) . "'\s*=>\s*(?:null|'[^']*'),/", "'{$col}' => '{$escapedVal}',", $newBlock);
            }
        }
        
        $srContent = str_replace($oldBlock, $newBlock, $srContent);
        echo "  ID $srId fixed\n";
    } else {
        echo "  ID $srId not found in seeder!\n";
    }
}

// Fix status and updated_at for IDs 40, 52, 54, 56, 58, 60 in tbl_sr (status 5->6 or 4->6)
$srStatuses = [
    40 => ['status' => 6, 'updated_at' => '2026-03-18 03:39:02'],
    52 => ['status' => 6, 'updated_at' => '2026-03-18 03:40:51'],
    54 => ['status' => 6, 'updated_at' => '2026-03-18 03:43:22'],
    56 => ['status' => 6, 'updated_at' => '2026-03-18 03:45:52'],
    58 => ['status' => 6, 'updated_at' => '2026-03-18 03:41:25'],
    60 => ['status' => 6, 'updated_at' => '2026-03-18 03:47:03'],
];

foreach ($srStatuses as $srId => $fixes) {
    // Find the specific block for this SR id
    $pattern = "/'id_sr'\s*=>\s*{$srId},.*?'updated_at'\s*=>\s*'[^']+',.*?'deleted_at'\s*=>[^]]+\],/s";
    if (preg_match($pattern, $srContent, $matchN, PREG_OFFSET_CAPTURE)) {
        $oldBlock = $matchN[0][0];
        $newBlock = $oldBlock;
        $newBlock = preg_replace("/'status'\s*=>\s*\d+,/", "'status' => {$fixes['status']},", $newBlock);
        $newBlock = preg_replace("/'updated_at'\s*=>\s*'[^']+',/", "'updated_at' => '{$fixes['updated_at']}',", $newBlock);
        $srContent = str_replace($oldBlock, $newBlock, $srContent);
        echo "  SR ID $srId status/updated_at fixed\n";
    }
}

file_put_contents($srFile, $srContent);
echo "  TblSrSeeder saved!\n";

// ===================================================
// 3. FIX TblDetailSrSeeder - Fix NULL values for rows 171-188
// This data should come from SQL lama
// ===================================================
echo "\n=== Fixing TblDetailSrSeeder (fixing NULL values from SQL lama) ===\n";

$sqlFile = __DIR__ . '/sumberb1_eprnaval (8).sql';
$sqlContent = file_get_contents($sqlFile);

// Extract detail_sr data from SQL
function extractDetailSrFromSql(string $sqlContent): array {
    $data = [];
    $insertPattern = '/INSERT INTO `tbl_detail_sr` \(([^)]+)\) VALUES\s*([^;]+);/s';
    preg_match_all($insertPattern, $sqlContent, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        $cols = array_map(fn($c) => trim($c, ' `'), explode(',', $match[1]));
        $rowsBlock = $match[2];
        
        // Split rows
        $rows = [];
        $current = '';
        $depth = 0;
        $inStr = false;
        $strCh = '';
        for ($i = 0; $i < strlen($rowsBlock); $i++) {
            $c = $rowsBlock[$i];
            if (!$inStr && ($c === "'" || $c === '"')) { $inStr = true; $strCh = $c; }
            elseif ($inStr && $c === $strCh && $rowsBlock[$i-1] !== '\\') { $inStr = false; }
            if (!$inStr) {
                if ($c === '(') $depth++;
                elseif ($c === ')') $depth--;
            }
            $current .= $c;
            if ($depth === 0 && $c === ')') {
                $row = trim($current);
                if ($row) $rows[] = $row;
                $current = '';
                if (isset($rowsBlock[$i+1]) && $rowsBlock[$i+1] === ',') $i++;
            }
        }
        
        foreach ($rows as $row) {
            if (!preg_match('/^\((.+)\)$/s', $row, $m)) continue;
            $vals = [];
            $cur = '';
            $inS = false;
            $sCh = '';
            for ($i = 0; $i < strlen($m[1]); $i++) {
                $c = $m[1][$i];
                if (!$inS && ($c === "'" || $c === '"')) { $inS = true; $sCh = $c; $cur .= $c; }
                elseif ($inS && $c === $sCh && ($i === 0 || $m[1][$i-1] !== '\\')) { $inS = false; $cur .= $c; }
                elseif (!$inS && $c === ',') { $vals[] = trim($cur); $cur = ''; }
                else { $cur .= $c; }
            }
            if ($cur !== '') $vals[] = trim($cur);
            
            if (count($vals) === count($cols)) {
                $rowData = [];
                foreach ($cols as $i => $col) {
                    $v = $vals[$i];
                    $rowData[$col] = ($v === 'NULL') ? null : trim($v, "'");
                }
                $data[] = $rowData;
            }
        }
    }
    return $data;
}

$sqlDetailSr = extractDetailSrFromSql($sqlContent);
$sqlDetailSrById = [];
foreach ($sqlDetailSr as $row) {
    $sqlDetailSrById[$row['id_detail_sr']] = $row;
}
echo "  SQL detail_sr count: " . count($sqlDetailSrById) . "\n";

// Read the seeder
$detailSrFile = $seederDir . '/TblDetailSrSeeder.php';
$detailSrContent = file_get_contents($detailSrFile);

// The IDs with NULL data: 171-188 (18 IDs)
// We need to update these from SQL data
$nullIds = [171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188];

$fixCount = 0;
foreach ($nullIds as $dId) {
    if (!isset($sqlDetailSrById[$dId])) {
        echo "  ID $dId not found in SQL!\n";
        continue;
    }
    
    $sqlRow = $sqlDetailSrById[$dId];
    
    // Find this ID's block in seeder
    $pattern = "/'id_detail_sr'\s*=>\s*{$dId},.*?'deleted_at'\s*=>[^]]+\],/s";
    if (preg_match($pattern, $detailSrContent, $matchN, PREG_OFFSET_CAPTURE)) {
        $oldBlock = $matchN[0][0];
        $newBlock = $oldBlock;
        
        // Fix NULL values using SQL data
        $colsToFix = ['id_user', 'id_departement', 'id_doc_type', 'id_uom', 'id_tax_type1', 'id_tax1', 
                      'id_tax_type2', 'id_tax2', 'detail', 'bl_number', 'dpp_pph', 'qty', 'price', 
                      'discount', 'tax1', 'tax2', 'progresif', 'gross', 'ammount'];
        
        foreach ($colsToFix as $col) {
            if (!array_key_exists($col, $sqlRow)) continue;
            $sqlVal = $sqlRow[$col];
            
            if ($sqlVal === null) {
                $phpVal = 'null';
            } elseif (is_numeric($sqlVal) && !str_contains($col, 'detail') && !str_contains($col, 'bl_')) {
                $phpVal = $sqlVal;
            } else {
                $escaped = str_replace("'", "\\'", $sqlVal);
                $phpVal = "'$escaped'";
            }
            
            $newBlock = preg_replace(
                "/'" . preg_quote($col, '/') . "'\s*=>\s*null,/",
                "'{$col}' => {$phpVal},",
                $newBlock
            );
        }
        
        if ($newBlock !== $oldBlock) {
            $detailSrContent = str_replace($oldBlock, $newBlock, $detailSrContent);
            $fixCount++;
        }
    } else {
        echo "  ID $dId block not found in seeder!\n";
    }
}

file_put_contents($detailSrFile, $detailSrContent);
echo "  Fixed $fixCount detail_sr rows\n";

// ===================================================
// 4. FIX TblAttachmentSrSeeder - Add missing IDs 142-151
// ===================================================
echo "\n=== Fixing TblAttachmentSrSeeder (adding missing IDs 142-151) ===\n";

$attachSrFile = $seederDir . '/TblAttachmentSrSeeder.php';
$attachSrContent = file_get_contents($attachSrFile);

// Check current last entry
preg_match_all("/'id_attachment_sr'\s*=>\s*(\d+)/", $attachSrContent, $idMatches);
$existingIds = $idMatches[1];
sort($existingIds);
echo "  Current last IDs: " . implode(', ', array_slice($existingIds, -5)) . "\n";
echo "  Total current: " . count($existingIds) . "\n";

// Find end of $payload array
$payloadEnd = strrpos($attachSrContent, '];');
if ($payloadEnd !== false) {
    // Find the actual closing of the payload array (not DB::table)
    $closingPos = strrpos(substr($attachSrContent, 0, $payloadEnd), '],');
    
    $missingEntries = <<<'PHP'

                    [
                        'id_attachment_sr' => 142,
                        'id_sr' => 59,
                        'id_attachment' => 40,
                        'id_user' => 52,
                        'note' => 'kwitansi',
                        'filename' => '1773640365_a85d802f474df566745c.pdf',
                        'created_at' => '2026-03-16 05:52:45',
                        'updated_at' => '2026-03-16 05:52:45',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 143,
                        'id_sr' => 59,
                        'id_attachment' => 46,
                        'id_user' => 52,
                        'note' => 'REALISASI PERJADIN',
                        'filename' => '1773640435_6d48b577af2f581a862c.png',
                        'created_at' => '2026-03-16 05:53:55',
                        'updated_at' => '2026-03-16 05:53:55',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 144,
                        'id_sr' => 64,
                        'id_attachment' => 40,
                        'id_user' => 52,
                        'note' => 'REALISASI PERJADIN',
                        'filename' => '1773643611_2f83cfa9d8575ee8290b.pdf',
                        'created_at' => '2026-03-16 06:46:51',
                        'updated_at' => '2026-03-16 06:46:51',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 145,
                        'id_sr' => 64,
                        'id_attachment' => 46,
                        'id_user' => 52,
                        'note' => 'REALISASI PERJADIN',
                        'filename' => '1773643681_7740a8e57f68682a80ce.png',
                        'created_at' => '2026-03-16 06:48:01',
                        'updated_at' => '2026-03-16 06:48:01',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 146,
                        'id_sr' => 64,
                        'id_attachment' => 63,
                        'id_user' => 52,
                        'note' => 'NOTA',
                        'filename' => '1773644086_190d10e86d370d147c0f.jpeg',
                        'created_at' => '2026-03-16 06:54:46',
                        'updated_at' => '2026-03-16 06:54:46',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 147,
                        'id_sr' => 63,
                        'id_attachment' => 40,
                        'id_user' => 34,
                        'note' => 'Kwitansi',
                        'filename' => '1773648044_d6d023f12bcfa8a357d0.jpeg',
                        'created_at' => '2026-03-16 08:00:44',
                        'updated_at' => '2026-03-16 08:00:44',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 148,
                        'id_sr' => 63,
                        'id_attachment' => 40,
                        'id_user' => 34,
                        'note' => 'Kwitansi',
                        'filename' => '1773648093_b8a4439c15fbb1ff4692.jpeg',
                        'created_at' => '2026-03-16 08:01:33',
                        'updated_at' => '2026-03-16 08:01:33',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 149,
                        'id_sr' => 63,
                        'id_attachment' => 40,
                        'id_user' => 34,
                        'note' => 'Kwitansi',
                        'filename' => '1773648133_da018b0277bd11cb6ec8.jpeg',
                        'created_at' => '2026-03-16 08:02:13',
                        'updated_at' => '2026-03-16 08:02:13',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 150,
                        'id_sr' => 63,
                        'id_attachment' => 40,
                        'id_user' => 34,
                        'note' => 'Kwitansi',
                        'filename' => '1773648171_6a47b6be3d487ac649d5.jpeg',
                        'created_at' => '2026-03-16 08:02:51',
                        'updated_at' => '2026-03-16 08:02:51',
                        'deleted_at' => null,
                    ],
                    [
                        'id_attachment_sr' => 151,
                        'id_sr' => 64,
                        'id_attachment' => 46,
                        'id_user' => 52,
                        'note' => 'BUKTI TF',
                        'filename' => '1773729844_c247db0111b228963c5c.jpeg',
                        'created_at' => '2026-03-17 06:44:04',
                        'updated_at' => '2026-03-17 06:44:04',
                        'deleted_at' => null,
                    ],
PHP;

    // Find the right position to insert - before the closing ];\n\n        $chunks
    $insertMarker = "\n        ];\n";
    $insertPos = strrpos($attachSrContent, $insertMarker);
    
    if ($insertPos !== false) {
        $missingEntries = str_replace("\n", "\r\n", $missingEntries);
        $newContent = substr($attachSrContent, 0, $insertPos) . $missingEntries . substr($attachSrContent, $insertPos);
        file_put_contents($attachSrFile, $newContent);
        
        // Verify
        $verify = file_get_contents($attachSrFile);
        preg_match_all("/'id_attachment_sr'\s*=>\s*(\d+)/", $verify, $vm);
        echo "  Fixed! Total attachment_sr: " . count($vm[1]) . " (expected 141)\n";
    } else {
        echo "  ERROR: Could not find insert position!\n";
    }
}

echo "\n=== All fixes complete! ===\n";
echo "Files fixed:\n";
echo "  - TblInvoiceSeeder.php (added ID 69-76)\n";
echo "  - TblSrSeeder.php (fixed ID 59, 63, 64 data + status updates for 40,52,54,56,58,60)\n";
echo "  - TblDetailSrSeeder.php (fixed NULL values for ID 171-188)\n";
echo "  - TblAttachmentSrSeeder.php (added ID 142-151)\n";
