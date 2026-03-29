<?php
/**
 * Detail investigasi perbedaan antara SQL lama dan seeder baru
 */
set_time_limit(120);
ini_set('memory_limit', '256M');

$sqlFile = __DIR__ . '/sumberb1_eprnaval (8).sql';
$seederDir = __DIR__ . '/../seeders';

$sqlContent = file_get_contents($sqlFile);

echo "=== INVESTIGASI DETAIL PERBEDAAN DATABASE ===\n\n";

// ============================================================
// 1. tbl_sign_transaction - Missing 460 IDs
// ============================================================
echo "1. tbl_sign_transaction\n";
echo "------------------------\n";

// SQL IDs
preg_match_all('/INSERT INTO `tbl_sign_transaction` \([^)]+\) VALUES\s*([^;]+);/s', $sqlContent, $matches);
$sqlIds = [];
foreach ($matches[1] as $valBlock) {
    preg_match_all('/^\((\d+),/m', $valBlock, $rowIds);
    $sqlIds = array_merge($sqlIds, $rowIds[1]);
}
sort($sqlIds);
echo "SQL count: " . count($sqlIds) . " | Min: " . (min($sqlIds) ?: 'N/A') . " | Max: " . (max($sqlIds) ?: 'N/A') . "\n";

// Seeder IDs
$seederContent = file_get_contents($seederDir . '/TblSignTransactionSeeder.php');
preg_match_all("/'id_sign_transaction'\s*=>\s*(\d+)/", $seederContent, $seederMatches);
$seederIds = $seederMatches[1];
sort($seederIds);
echo "Seeder count: " . count($seederIds) . " | Min: " . (min($seederIds) ?: 'N/A') . " | Max: " . (max($seederIds) ?: 'N/A') . "\n";

$missingInSeeder = array_diff($sqlIds, $seederIds);
$extraInSeeder = array_diff($seederIds, $sqlIds);
sort($missingInSeeder);
sort($extraInSeeder);

echo "Missing in seeder (" . count($missingInSeeder) . "):\n";
// Cek apakah missing IDs adalah ID tinggi (data baru setelah seeder dibuat)
$missingArr = array_values($missingInSeeder);
$highMissing = array_filter($missingArr, fn($id) => $id > max($seederIds));
$lowMissing = array_filter($missingArr, fn($id) => $id <= max($seederIds));
echo "  - ID rendah (kemungkinan data hilang dari seeder): " . count($lowMissing) . " IDs\n";
if (!empty($lowMissing)) {
    echo "    Sample: " . implode(', ', array_slice(array_values($lowMissing), 0, 15)) . "\n";
}
echo "  - ID tinggi (kemungkinan data baru setelah seeder): " . count($highMissing) . " IDs\n";
if (!empty($highMissing)) {
    echo "    Sample: " . implode(', ', array_slice(array_values($highMissing), 0, 15)) . "\n";
}

echo "Extra in seeder (exist in seeder but not SQL) (" . count($extraInSeeder) . "):  ";
echo implode(', ', $extraInSeeder) . "\n";

// Cek kolom yang hilang di seeder (id_sign_flow)
echo "\n  Analisis kolom id_sign_flow:\n";
preg_match_all("/INSERT INTO `tbl_sign_transaction` \(`id_sign_transaction`, `id_pr`, `id_sign_flow`/", $sqlContent, $m);
echo "  -> id_sign_flow ada di SQL lama (ditemukan di INSERT)\n";
$countSignFlow = substr_count($seederContent, "'id_sign_flow'");
echo "  -> id_sign_flow di seeder: " . ($countSignFlow > 0 ? "ADA ($countSignFlow kali)" : "TIDAK ADA - kolom ini sudah dihapus dari schema baru") . "\n";
$countIkb = substr_count($seederContent, "'id_ikb'");
echo "  -> id_ikb di seeder: " . ($countIkb > 0 ? "ADA ($countIkb kali) - kolom baru" : "TIDAK ADA") . "\n";

echo "\n";

// ============================================================
// 2. tbl_invoice - Missing 8 IDs (69-76)
// ============================================================
echo "2. tbl_invoice\n";
echo "---------------\n";

preg_match_all('/INSERT INTO `tbl_invoice` \([^)]+\) VALUES\s*([^;]+);/s', $sqlContent, $matches);
$sqlIds = [];
foreach ($matches[1] as $valBlock) {
    preg_match_all('/^\((\d+),/m', $valBlock, $rowIds);
    $sqlIds = array_merge($sqlIds, $rowIds[1]);
}
sort($sqlIds);
echo "SQL count: " . count($sqlIds) . " | All IDs: " . implode(', ', $sqlIds) . "\n";

$seederContent = file_get_contents($seederDir . '/TblInvoiceSeeder.php');
preg_match_all("/'id_invoice'\s*=>\s*(\d+)/", $seederContent, $seederMatches);
$seederIds = $seederMatches[1];
sort($seederIds);
echo "Seeder count: " . count($seederIds) . " | All IDs: " . implode(', ', $seederIds) . "\n";

$missing = array_diff($sqlIds, $seederIds);
echo "Missing in seeder: " . implode(', ', $missing) . "\n";

// Cari data si ID yang missing dari SQL
echo "\nData invoice yang HILANG dari seeder (dari SQL lama):\n";
foreach ($missing as $missingId) {
    // Cari baris ini di SQL
    preg_match("/INSERT INTO `tbl_invoice` \(([^)]+)\) VALUES\s*\($missingId,[^\n]+\)/", $sqlContent, $rowMatch);
    if (!empty($rowMatch)) {
        echo "  ID=$missingId: " . substr($rowMatch[0], 0, 200) . "\n";
    } else {
        // Coba cara lain
        $pos = strpos($sqlContent, "($missingId,");
        if ($pos !== false) {
            $snippet = substr($sqlContent, max(0, $pos-100), 300);
            if (strpos($snippet, 'tbl_invoice') !== false) {
                echo "  ID=$missingId: (found near tbl_invoice)\n";
            }
        }
    }
}

echo "\n";

// ============================================================
// 3. tbl_pr - Extra 1 ID (1126)
// ============================================================
echo "3. tbl_pr\n";
echo "----------\n";

preg_match_all('/INSERT INTO `tbl_pr` \([^)]+\) VALUES\s*([^;]+);/s', $sqlContent, $matches);
$sqlIds = [];
foreach ($matches[1] as $valBlock) {
    preg_match_all('/^\((\d+),/m', $valBlock, $rowIds);
    $sqlIds = array_merge($sqlIds, $rowIds[1]);
}
sort($sqlIds);
echo "SQL count: " . count($sqlIds) . " | Max ID: " . max($sqlIds) . "\n";

$seederContent = file_get_contents($seederDir . '/TblPrSeeder.php');
preg_match_all("/'id_pr'\s*=>\s*(\d+)/", $seederContent, $seederMatches);
$seederIds = $seederMatches[1];
sort($seederIds);
echo "Seeder count: " . count($seederIds) . " | Max ID: " . max($seederIds) . "\n";

$extra = array_diff($seederIds, $sqlIds);
echo "Extra in seeder (ID 1126): " . implode(', ', $extra) . "\n";
echo "  -> ID 1126 ada di seeder tapi tidak di SQL lama (data baru belakangan)\n";

echo "\n";

// ============================================================
// 4. tbl_detail_pr - Extra 745 IDs
// ============================================================
echo "4. tbl_detail_pr\n";
echo "-----------------\n";

preg_match_all('/INSERT INTO `tbl_detail_pr` \([^)]+\) VALUES\s*([^;]+);/s', $sqlContent, $matches);
$sqlIds = [];
foreach ($matches[1] as $valBlock) {
    preg_match_all('/^\((\d+),/m', $valBlock, $rowIds);
    $sqlIds = array_merge($sqlIds, $rowIds[1]);
}
sort($sqlIds);
echo "SQL count: " . count($sqlIds) . " | Max ID: " . (max($sqlIds) ?: 'N/A') . "\n";

$seederContent = file_get_contents($seederDir . '/TblDetailPrSeeder.php');
preg_match_all("/'id_detail_pr'\s*=>\s*(\d+)/", $seederContent, $seederMatches);
$seederIds = $seederMatches[1];
sort($seederIds);
echo "Seeder count: " . count($seederIds) . " | Max ID: " . (max($seederIds) ?: 'N/A') . "\n";

$extra = array_diff($seederIds, $sqlIds);
$missing = array_diff($sqlIds, $seederIds);
echo "Extra in seeder (" . count($extra) . ")\n";
echo "Missing from seeder (" . count($missing) . ")\n";
if (!empty($missing)) echo "  Missing IDs: " . implode(', ', array_slice(array_values($missing), 0, 20)) . "\n";

// Analisis pola: ID extra di seeder apakah berurutan dengan SQL max?
if (!empty($extra)) {
    $extraArr = array_values($extra);
    echo "  Sample extra IDs: " . implode(', ', array_slice($extraArr, 0, 20)) . "\n";
    $sqlMax = max($sqlIds);
    $extraAboveSqlMax = array_filter($extra, fn($id) => $id > $sqlMax);
    $extraBelowSqlMax = array_filter($extra, fn($id) => $id <= $sqlMax);
    echo "  Extra IDs lebih besar dari SQL max ($sqlMax): " . count($extraAboveSqlMax) . "\n";
    echo "  Extra IDs di dalam range SQL: " . count($extraBelowSqlMax) . "\n";
}

echo "\n";

// ============================================================
// 5. tbl_attachment_sr - Extra 1 ID (137)
// ============================================================  
echo "5. tbl_attachment_sr\n";
echo "---------------------\n";

preg_match_all('/INSERT INTO `tbl_attachment_sr` \([^)]+\) VALUES\s*([^;]+);/s', $sqlContent, $matches);
$sqlIds = [];
foreach ($matches[1] as $valBlock) {
    preg_match_all('/^\((\d+),/m', $valBlock, $rowIds);
    $sqlIds = array_merge($sqlIds, $rowIds[1]);
}
sort($sqlIds);
echo "SQL count: " . count($sqlIds) . " | Max ID: " . (max($sqlIds) ?: 'N/A') . "\n";

$seederContent = file_get_contents($seederDir . '/TblAttachmentSrSeeder.php');
preg_match_all("/'id_attachment_sr'\s*=>\s*(\d+)/", $seederContent, $seederMatches);
$seederIds = $seederMatches[1];
sort($seederIds);
echo "Seeder count: " . count($seederIds) . " | Max ID: " . (max($seederIds) ?: 'N/A') . "\n";

$extra = array_diff($seederIds, $sqlIds);
echo "Extra in seeder (ID 137): " . implode(', ', $extra) . "\n";
echo "  -> ID 137 ada di seeder tapi tidak di SQL lama (data baru belakangan)\n";

echo "\nSelesai: " . date('Y-m-d H:i:s') . "\n";
