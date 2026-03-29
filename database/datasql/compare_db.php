<?php

/**
 * Database Comparison Script
 * Membandingkan data antara SQL lama dengan seeder baru
 * 
 * Tabel yang dibandingkan:
 * - tbl_pr
 * - tbl_detail_pr
 * - tbl_invoice
 * - tbl_payment
 * - tbl_sign_transaction
 * - tbl_attachment (pr, sr, payment, ikb)
 * - tbl_sr
 * - tbl_detail_sr
 */

set_time_limit(300);
ini_set('memory_limit', '512M');

$sqlFile = __DIR__ . '/sumberb1_eprnaval (8).sql';
$seederDir = __DIR__ . '/../seeders';

$results = [];

// ========================================
// FUNGSI HELPER
// ========================================

/**
 * Ekstrak semua ID dari SQL lama untuk sebuah tabel
 */
function extractIdsFromSql(string $sqlContent, string $tableName, string $idColumn): array {
    $ids = [];
    // Match INSERT INTO `table` (...) VALUES (...) patterns
    $pattern = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \([^)]+\) VALUES\s*\(([^;]+)\);/s';
    preg_match_all($pattern, $sqlContent, $matches);
    
    // Jika tidak ada, coba pattern multi-row
    if (empty($matches[0])) {
        return $ids;
    }
    
    foreach ($matches[1] as $valuesBlock) {
        // Split rows
        $rows = splitValues($valuesBlock);
        foreach ($rows as $row) {
            $cols = parseRow($row);
            if (!empty($cols)) {
                $ids[] = $cols[0]; // Biasanya id adalah kolom pertama
            }
        }
    }
    
    return array_unique($ids);
}

/**
 * Ekstrak kolom header dari CREATE TABLE
 */
function extractColumns(string $sqlContent, string $tableName): array {
    $pattern = '/CREATE TABLE `' . preg_quote($tableName, '/') . '`\s*\(([^;]+?)\)\s*ENGINE/s';
    if (!preg_match($pattern, $sqlContent, $match)) {
        return [];
    }
    
    $cols = [];
    $lines = explode("\n", $match[1]);
    foreach ($lines as $line) {
        $line = trim($line);
        if (preg_match('/^`([^`]+)`\s+/', $line, $m)) {
            $cols[] = $m[1];
        }
    }
    return $cols;
}

/**
 * Parse satu baris values dari SQL
 */
function parseRow(string $row): array {
    $row = trim($row);
    if (!preg_match('/^\((.+)\)$/s', $row, $m)) return [];
    
    $values = [];
    $current = '';
    $inString = false;
    $stringChar = '';
    $depth = 0;
    
    for ($i = 0; $i < strlen($m[1]); $i++) {
        $c = $m[1][$i];
        if (!$inString && ($c === "'" || $c === '"')) {
            $inString = true;
            $stringChar = $c;
            $current .= $c;
        } elseif ($inString && $c === $stringChar && ($i === 0 || $m[1][$i-1] !== '\\')) {
            $inString = false;
            $current .= $c;
        } elseif (!$inString && $c === ',') {
            $values[] = trim($current);
            $current = '';
        } else {
            $current .= $c;
        }
    }
    if ($current !== '') $values[] = trim($current);
    
    return $values;
}

/**
 * Split multiple rows dari VALUES block
 */
function splitValues(string $block): array {
    $rows = [];
    $current = '';
    $depth = 0;
    $inString = false;
    $stringChar = '';
    
    for ($i = 0; $i < strlen($block); $i++) {
        $c = $block[$i];
        if (!$inString && ($c === "'" || $c === '"')) {
            $inString = true;
            $stringChar = $c;
        } elseif ($inString && $c === $stringChar && ($i === 0 || $block[$i-1] !== '\\')) {
            $inString = false;
        }
        
        if (!$inString) {
            if ($c === '(') $depth++;
            elseif ($c === ')') $depth--;
        }
        
        $current .= $c;
        
        if ($depth === 0 && $c === ')') {
            $row = trim($current);
            if ($row !== '') $rows[] = $row;
            $current = '';
            // skip comma
            if (isset($block[$i+1]) && $block[$i+1] === ',') $i++;
        }
    }
    
    return $rows;
}

/**
 * Ekstrak semua data dari SQL untuk sebuah tabel
 */
function extractTableDataFromSql(string $sqlContent, string $tableName): array {
    $data = [];
    
    // Get column names dari INSERT statements
    $colPattern = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \(`([^)]+)`\) VALUES/';
    
    // Cari semua INSERT blocks
    $insertPattern = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \(([^)]+)\) VALUES\s*([^;]+);/s';
    preg_match_all($insertPattern, $sqlContent, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        // Parse column names
        $colStr = $match[1];
        $cols = array_map(function($c) { return trim($c, ' `'); }, explode(',', $colStr));
        
        // Parse values
        $valuesBlock = $match[2];
        $rows = splitValues($valuesBlock);
        
        foreach ($rows as $row) {
            $vals = parseRow($row);
            if (count($vals) === count($cols)) {
                $rowData = [];
                foreach ($cols as $i => $col) {
                    $val = trim($vals[$i] ?? 'NULL');
                    if ($val === 'NULL') $val = null;
                    else $val = trim($val, "'");
                    $rowData[$col] = $val;
                }
                $data[] = $rowData;
            }
        }
    }
    
    return $data;
}

/**
 * Ekstrak semua ID dari seeder PHP dan key-value pairs
 */
function extractFromSeeder(string $seederContent): array {
    $data = [];
    
    // Match all array entries in $payload
    if (!preg_match('/\$payload\s*=\s*\[(.+?)(?:^\s*\];)/ms', $seederContent, $match)) {
        return $data;
    }
    
    // Lebih sederhana: extract id values  
    preg_match_all("/'([^']+)'\s*=>\s*([^,\n]+),/", $seederContent, $matches, PREG_SET_ORDER);
    
    // Collect all id values from seeder
    // Pattern: look for id_xxx => value
    $rows = [];
    $blocks = preg_split('/\[\s*$|^\s*\],/m', $seederContent);
    
    foreach ($blocks as $block) {
        if (strpos($block, '=>') === false) continue;
        $row = [];
        preg_match_all("/'([^']+)'\s*=>\s*(.+?),?\s*$/m", $block, $ms, PREG_SET_ORDER);
        foreach ($ms as $m) {
            $key = $m[1];
            $val = trim($m[2]);
            if ($val === 'null') $val = null;
            else $val = trim($val, "'\"");
            $row[$key] = $val;
        }
        if (!empty($row)) $rows[] = $row;
    }
    
    return $rows;
}

/**
 * Dapatkan ID pertama setiap row dari seeder
 */
function getIdsFromSeeder(string $seederContent): array {
    // Cari semua 'id_xxx' => value patterns sebagai ID utama
    $ids = [];
    
    // Pattern untuk mendapatkan ID dari seeder
    preg_match_all("/'id_\w+'\s*=>\s*(\d+|null),/", $seederContent, $matches);
    
    return $matches[1] ?? [];
}

// ========================================
// BACA FILE SQL LAMA
// ========================================

echo "=== DATABASE COMPARISON TOOL ===\n";
echo "Membaca file SQL lama...\n";

if (!file_exists($sqlFile)) {
    die("ERROR: File SQL tidak ditemukan: $sqlFile\n");
}

$sqlContent = file_get_contents($sqlFile);
if (!$sqlContent) {
    die("ERROR: Gagal membaca file SQL\n");
}

echo "File SQL berhasil dibaca (" . round(filesize($sqlFile) / 1024 / 1024, 2) . " MB)\n\n";

// ========================================
// DAFTAR TABEL YANG DIBANDINGKAN
// ========================================

$tables = [
    'tbl_pr' => [
        'seeder' => 'TblPrSeeder.php',
        'id_column' => 'id_pr',
        'label' => 'Payment Request (PR)',
    ],
    'tbl_detail_pr' => [
        'seeder' => 'TblDetailPrSeeder.php',
        'id_column' => 'id_detail_pr',
        'label' => 'Detail PR',
    ],
    'tbl_invoice' => [
        'seeder' => 'TblInvoiceSeeder.php',
        'id_column' => 'id_invoice',
        'label' => 'Invoice',
    ],
    'tbl_payment' => [
        'seeder' => 'TblPaymentSeeder.php',
        'id_column' => 'id_payment',
        'label' => 'Payment',
    ],
    'tbl_sign_transaction' => [
        'seeder' => 'TblSignTransactionSeeder.php',
        'id_column' => 'id_sign_transaction',
        'label' => 'Sign Transaction',
    ],
    'tbl_attachment' => [
        'seeder' => 'TblAttachmentSeeder.php',
        'id_column' => 'id_attachment',
        'label' => 'Attachment (Umum)',
    ],
    'tbl_attachment_pr' => [
        'seeder' => 'TblAttachmentPrSeeder.php',
        'id_column' => 'id_attachment_pr',
        'label' => 'Attachment PR',
    ],
    'tbl_attachment_sr' => [
        'seeder' => 'TblAttachmentSrSeeder.php',
        'id_column' => 'id_attachment_sr',
        'label' => 'Attachment SR',
    ],
    'tbl_attachment_payment' => [
        'seeder' => 'TblAttachmentPaymentSeeder.php',
        'id_column' => 'id_attachment_payment',
        'label' => 'Attachment Payment',
    ],
    'tbl_attachment_ikb' => [
        'seeder' => 'TblAttachmentIkbSeeder.php',
        'id_column' => 'id_attachment_ikb',
        'label' => 'Attachment IKB',
    ],
    'tbl_sr' => [
        'seeder' => 'TblSrSeeder.php',
        'id_column' => 'id_sr',
        'label' => 'Settlement Report (SR)',
    ],
    'tbl_detail_sr' => [
        'seeder' => 'TblDetailSrSeeder.php',
        'id_column' => 'id_detail_sr',
        'label' => 'Detail SR',
    ],
];

// ========================================
// ANALISIS PER TABEL
// ========================================

$summary = [];

foreach ($tables as $tableName => $config) {
    echo "----------------------------------------\n";
    echo "TABEL: {$config['label']} ({$tableName})\n";
    echo "----------------------------------------\n";
    
    $seederFile = $seederDir . '/' . $config['seeder'];
    $idCol = $config['id_column'];
    
    // --- Ambil columns tabel lama ---
    $oldColumns = extractColumns($sqlContent, $tableName);
    
    // --- Ambil data dari SQL lama ---
    echo "  Mengekstrak data dari SQL lama ({$tableName})...\n";
    $oldData = extractTableDataFromSql($sqlContent, $tableName);
    $oldIds = array_column($oldData, $idCol);
    $oldCount = count($oldData);
    echo "  SQL Lama: {$oldCount} rows\n";
    
    // Jika tidak ada data di SQL lama untuk tabel ini
    if ($oldCount === 0) {
        echo "  [!] Tabel '{$tableName}' TIDAK DITEMUKAN/KOSONG di SQL lama\n";
    }
    
    // --- Ambil data dari seeder ---
    if (!file_exists($seederFile)) {
        echo "  [!] Seeder tidak ditemukan: {$config['seeder']}\n";
        $summary[$tableName] = [
            'label' => $config['label'],
            'old_count' => $oldCount,
            'new_count' => 0,
            'missing_in_new' => [],
            'extra_in_new' => [],
            'seeder_missing' => true,
        ];
        echo "\n";
        continue;
    }
    
    $seederContent = file_get_contents($seederFile);
    
    // Extract seeder IDs
    echo "  Mengekstrak data dari seeder {$config['seeder']}...\n";
    
    // Ambil semua ID dari seeder menggunakan pattern yang lebih sederhana
    $pattern = "/'" . preg_quote($idCol, '/') . "'\s*=>\s*(\d+|null)/";
    preg_match_all($pattern, $seederContent, $matches);
    $newIds = $matches[1] ?? [];
    $newCount = count($newIds);
    
    echo "  Seeder Baru: {$newCount} rows\n";
    
    // --- Columns comparison ---
    // Ambil columns dari seeder (dari key names di array pertama)
    $seederColPattern = "/'([^']+)'\s*=>/";
    preg_match_all($seederColPattern, $seederContent, $colMatches);
    // Ambil bagian antara $payload = [ dan pertama ], untuk mendapatkan key2 row pertama
    if (preg_match('/\$payload\s*=\s*\[\s*\[(.+?)\],/s', $seederContent, $firstRow)) {
        preg_match_all("/'([^']+)'\s*=>/", $firstRow[1], $newColMatch);
        $newColumns = $newColMatch[1] ?? [];
    } else {
        $newColumns = [];
    }
    
    // --- Perbandingan columns ---
    $oldColNames = $oldColumns;
    $newColNames = $newColumns;
    
    $colsInOldNotNew = array_diff($oldColNames, $newColNames);
    $colsInNewNotOld = array_diff($newColNames, $oldColNames);
    
    if (!empty($oldColNames) && !empty($newColNames)) {
        if (empty($colsInOldNotNew) && empty($colsInNewNotOld)) {
            echo "  [OK] Kolom: Cocok antara SQL lama dan seeder\n";
        } else {
            if (!empty($colsInOldNotNew)) {
                echo "  [DIFF] Kolom di SQL lama tapi TIDAK di seeder: " . implode(', ', $colsInOldNotNew) . "\n";
            }
            if (!empty($colsInNewNotOld)) {
                echo "  [NEW]  Kolom baru di seeder tapi TIDAK di SQL lama: " . implode(', ', $colsInNewNotOld) . "\n";
            }
        }
    }
    
    // --- Perbandingan jumlah ---
    $diff = $newCount - $oldCount;
    if ($diff === 0) {
        echo "  [OK] Jumlah rows: SAMA ({$oldCount})\n";
    } elseif ($diff > 0) {
        echo "  [+] Seeder memiliki {$diff} rows LEBIH BANYAK dari SQL lama\n";
    } else {
        echo "  [-] Seeder memiliki " . abs($diff) . " rows LEBIH SEDIKIT dari SQL lama\n";
    }
    
    // --- Cari ID yang ada di SQL lama tapi tidak di seeder ---
    $missingInNew = array_diff($oldIds, $newIds);
    $extraInNew = array_diff($newIds, $oldIds);
    
    if (!empty($missingInNew)) {
        $missingArr = array_slice(array_values($missingInNew), 0, 20);
        echo "  [!] ID di SQL lama TIDAK ADA di seeder (" . count($missingInNew) . " ID): ";
        echo implode(', ', $missingArr);
        if (count($missingInNew) > 20) echo "... (dan " . (count($missingInNew) - 20) . " lainnya)";
        echo "\n";
    } else {
        if ($oldCount > 0) echo "  [OK] Semua ID dari SQL lama ada di seeder\n";
    }
    
    if (!empty($extraInNew)) {
        $extraArr = array_slice(array_values($extraInNew), 0, 20);
        echo "  [+] ID di seeder tapi TIDAK di SQL lama (" . count($extraInNew) . " ID): ";
        echo implode(', ', $extraArr);
        if (count($extraInNew) > 20) echo "... (dan " . (count($extraInNew) - 20) . " lainnya)";
        echo "\n";
    }
    
    $summary[$tableName] = [
        'label' => $config['label'],
        'old_count' => $oldCount,
        'new_count' => $newCount,
        'missing_in_new' => array_values($missingInNew),
        'extra_in_new' => array_values($extraInNew),
        'cols_removed' => array_values($colsInOldNotNew),
        'cols_added' => array_values($colsInNewNotOld),
        'seeder_missing' => false,
    ];
    
    echo "\n";
}

// ========================================
// RINGKASAN AKHIR
// ========================================

echo "========================================\n";
echo "RINGKASAN PERBANDINGAN DATABASE\n";
echo "========================================\n";
printf("%-30s %10s %10s %10s %10s\n", "Tabel", "SQL Lama", "Seeder Baru", "Kurang", "Lebih");
echo str_repeat("-", 75) . "\n";

foreach ($summary as $tableName => $info) {
    $missing = count($info['missing_in_new']);
    $extra = count($info['extra_in_new']);
    $status = ($missing === 0 && $extra === 0 && $info['old_count'] === $info['new_count']) ? 'OK' : '!!';
    
    printf("%-30s %10d %10d %10d %10d  [%s]\n",
        $tableName,
        $info['old_count'],
        $info['new_count'],
        $missing,
        $extra,
        $status
    );
    
    if (!empty($info['cols_removed'])) {
        echo "    -> Kolom dihapus: " . implode(', ', $info['cols_removed']) . "\n";
    }
    if (!empty($info['cols_added'])) {
        echo "    -> Kolom ditambah: " . implode(', ', $info['cols_added']) . "\n";
    }
}

echo "\n";
echo "Selesai: " . date('Y-m-d H:i:s') . "\n";
