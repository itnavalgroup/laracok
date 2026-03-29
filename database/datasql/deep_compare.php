<?php
/**
 * Deep Column-Level Database Comparison
 * 
 * Untuk setiap tabel:
 * 1. Tampilkan data EKSTRA di seeder (ada di seeder tapi bukan di SQL lama)
 * 2. Tampilkan data KURANG di seeder (ada di SQL lama tapi tidak di seeder) → perlu ditambah
 * 3. Untuk setiap ID yang ada di KEDUANYA → bandingkan nilai per kolom
 *
 * Kolom acuan: SEEDER BARU (schema baru)
 * Data acuan (jika kurang): SQL LAMA
 */

set_time_limit(600);
ini_set('memory_limit', '512M');

$sqlFile = __DIR__ . '/sumberb1_eprnaval (8).sql';
$seederDir = __DIR__ . '/../seeders';
$outputDir = __DIR__ . '/comparison_output';

if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);

echo "=== DEEP DATABASE COMPARISON ===\n";
echo "Membaca SQL lama...\n";
$sqlContent = file_get_contents($sqlFile);
echo "File: " . round(filesize($sqlFile)/1024/1024, 2) . " MB\n\n";

// =============================================
// HELPER FUNCTIONS
// =============================================

function extractTableFromSql(string $sqlContent, string $tableName): array {
    $data = [];
    
    // Dapatkan semua INSERT blocks untuk tabel ini
    $insertPattern = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \(([^)]+)\) VALUES\s*([^;]+);/s';
    preg_match_all($insertPattern, $sqlContent, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        // Parse column names
        $cols = array_map(fn($c) => trim($c, ' `'), explode(',', $match[1]));
        
        // Parse value rows
        $rows = splitSqlRows($match[2]);
        foreach ($rows as $row) {
            $vals = parseSqlRow($row);
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

function splitSqlRows(string $block): array {
    $rows = [];
    $current = '';
    $depth = 0;
    $inStr = false;
    $strCh = '';
    
    for ($i = 0; $i < strlen($block); $i++) {
        $c = $block[$i];
        if (!$inStr && ($c === "'" || $c === '"')) {
            $inStr = true; $strCh = $c;
        } elseif ($inStr && $c === $strCh && $block[$i-1] !== '\\') {
            $inStr = false;
        }
        if (!$inStr) {
            if ($c === '(') $depth++;
            elseif ($c === ')') $depth--;
        }
        $current .= $c;
        if ($depth === 0 && $c === ')') {
            $row = trim($current);
            if ($row) $rows[] = $row;
            $current = '';
            if (isset($block[$i+1]) && $block[$i+1] === ',') $i++;
        }
    }
    return $rows;
}

function parseSqlRow(string $row): array {
    if (!preg_match('/^\((.+)\)$/s', $row, $m)) return [];
    $vals = [];
    $cur = '';
    $inStr = false;
    $strCh = '';
    $content = $m[1];
    
    for ($i = 0; $i < strlen($content); $i++) {
        $c = $content[$i];
        if (!$inStr && ($c === "'" || $c === '"')) {
            $inStr = true; $strCh = $c; $cur .= $c;
        } elseif ($inStr && $c === $strCh && ($i === 0 || $content[$i-1] !== '\\')) {
            $inStr = false; $cur .= $c;
        } elseif (!$inStr && $c === ',') {
            $vals[] = trim($cur); $cur = '';
        } else {
            $cur .= $c;
        }
    }
    if ($cur !== '') $vals[] = trim($cur);
    return $vals;
}

function extractTableFromSeeder(string $seederContent): array {
    $data = [];
    
    // Cari payload array
    if (!preg_match('/\$payload\s*=\s*\[(.+?)(?:^\s*DB::table)/ms', $seederContent, $match)) {
        if (!preg_match('/\$payload\s*=\s*\[(.+?)\];\s*$/ms', $seederContent, $match)) {
            return $data;
        }
    }
    
    $payloadStr = $match[1];
    
    // Split berdasarkan pattern array baru
    $blocks = [];
    $current = '';
    $depth = 0;
    
    for ($i = 0; $i < strlen($payloadStr); $i++) {
        $c = $payloadStr[$i];
        if ($c === '[') {
            $depth++;
            if ($depth === 1) { $current = ''; continue; }
        }
        if ($c === ']') {
            $depth--;
            if ($depth === 0 && trim($current)) {
                $blocks[] = $current;
                $current = '';
                continue;
            }
        }
        if ($depth >= 1) $current .= $c;
    }
    
    foreach ($blocks as $block) {
        $row = [];
        // Parse key => value pairs
        preg_match_all("/'([^']+)'\s*=>\s*(null|\d+\.\d+|-?\d+|'[^']*'|\"[^\"]*\"),?/", $block, $pairs, PREG_SET_ORDER);
        foreach ($pairs as $pair) {
            $key = $pair[1];
            $val = $pair[2];
            if ($val === 'null') $val = null;
            else $val = trim($val, "'\"");
            $row[$key] = $val;
        }
        if (!empty($row)) $data[] = $row;
    }
    
    return $data;
}

function normalizeValue($val): string {
    if ($val === null || strtoupper((string)$val) === 'NULL') return 'NULL';
    // Trim whitespace
    $v = trim((string)$val);
    // Normalize float: 1.0000 = 1.0000
    if (is_numeric($v) && strpos($v, '.') !== false) {
        return rtrim(rtrim(number_format((float)$v, 4, '.', ''), '0'), '.');
    }
    return $v;
}

function compareCols(array $sqlRow, array $seederRow, array $seederCols): array {
    $diffs = [];
    foreach ($seederCols as $col) {
        // Skip kolom yang memang baru (tidak ada di SQL)
        if (!array_key_exists($col, $sqlRow)) continue;
        // Skip deleted_at (tidak ada di SQL)
        if ($col === 'deleted_at') continue;
        
        $oldVal = normalizeValue($sqlRow[$col] ?? null);
        $newVal = normalizeValue($seederRow[$col] ?? null);
        
        if ($oldVal !== $newVal) {
            $diffs[$col] = ['sql' => $oldVal, 'seeder' => $newVal];
        }
    }
    return $diffs;
}

// =============================================
// KONFIGURASI TABEL
// =============================================

$tables = [
    'tbl_pr' => ['seeder' => 'TblPrSeeder.php', 'id' => 'id_pr'],
    'tbl_detail_pr' => ['seeder' => 'TblDetailPrSeeder.php', 'id' => 'id_detail_pr'],
    'tbl_invoice' => ['seeder' => 'TblInvoiceSeeder.php', 'id' => 'id_invoice'],
    'tbl_payment' => ['seeder' => 'TblPaymentSeeder.php', 'id' => 'id_payment'],
    'tbl_sign_transaction' => ['seeder' => 'TblSignTransactionSeeder.php', 'id' => 'id_sign_transaction'],
    'tbl_attachment' => ['seeder' => 'TblAttachmentSeeder.php', 'id' => 'id_attachment'],
    'tbl_attachment_pr' => ['seeder' => 'TblAttachmentPrSeeder.php', 'id' => 'id_attachment_pr'],
    'tbl_attachment_sr' => ['seeder' => 'TblAttachmentSrSeeder.php', 'id' => 'id_attachment_sr'],
    'tbl_attachment_payment' => ['seeder' => 'TblAttachmentPaymentSeeder.php', 'id' => 'id_payment_attachment'],
    'tbl_sr' => ['seeder' => 'TblSrSeeder.php', 'id' => 'id_sr'],
    'tbl_detail_sr' => ['seeder' => 'TblDetailSrSeeder.php', 'id' => 'id_detail_sr'],
];

// =============================================
// PROSES SETIAP TABEL
// =============================================

$allTableResults = [];

foreach ($tables as $tableName => $config) {
    echo "=====================================\n";
    echo "TABEL: $tableName\n";
    echo "=====================================\n";
    
    $idCol = $config['id'];
    $seederFile = $seederDir . '/' . $config['seeder'];
    
    // Ambil data SQL lama
    echo "  Membaca SQL lama...\n";
    $sqlData = extractTableFromSql($sqlContent, $tableName);
    $sqlById = [];
    foreach ($sqlData as $row) {
        $id = $row[$idCol] ?? null;
        if ($id !== null) $sqlById[$id] = $row;
    }
    echo "  SQL: " . count($sqlById) . " rows\n";
    
    // Ambil data seeder
    if (!file_exists($seederFile)) {
        echo "  [!] Seeder tidak ditemukan!\n\n";
        continue;
    }
    
    echo "  Membaca seeder...\n";
    $seederContent = file_get_contents($seederFile);
    $seederData = extractTableFromSeeder($seederContent);
    $seederById = [];
    foreach ($seederData as $row) {
        $id = $row[$idCol] ?? null;
        if ($id !== null) $seederById[$id] = $row;
    }
    echo "  Seeder: " . count($seederById) . " rows\n";
    
    // Ambil kolom dari seeder (schema baru)
    $seederCols = !empty($seederData) ? array_keys($seederData[0]) : [];
    
    // ---- 1. ID yang ada di SQL tapi tidak di seeder (MISSING) ----
    $missingIds = array_diff(array_keys($sqlById), array_keys($seederById));
    
    // ---- 2. ID yang ada di seeder tapi tidak di SQL (EXTRA) ----
    $extraIds = array_diff(array_keys($seederById), array_keys($sqlById));
    
    // ---- 3. ID yang ada di keduanya → bandingkan kolom ----
    $commonIds = array_intersect(array_keys($sqlById), array_keys($seederById));
    
    $tableResult = [
        'table' => $tableName,
        'id_col' => $idCol,
        'sql_count' => count($sqlById),
        'seeder_count' => count($seederById),
        'missing' => [],
        'extra' => [],
        'col_diffs' => [],
        'seeder_cols' => $seederCols,
    ];
    
    // --- Missing data ---
    if (!empty($missingIds)) {
        echo "  [MISSING] " . count($missingIds) . " rows ADA di SQL tapi TIDAK di seeder:\n";
        foreach ($missingIds as $id) {
            $sqlRow = $sqlById[$id];
            // Bangun row sesuai kolom seeder
            $newRow = [];
            foreach ($seederCols as $col) {
                if ($col === 'deleted_at') { $newRow[$col] = null; continue; }
                $newRow[$col] = $sqlRow[$col] ?? null;
            }
            $tableResult['missing'][$id] = $newRow;
            echo "    ID=$id\n";
        }
    } else {
        echo "  [OK] Tidak ada data yang kurang di seeder\n";
    }
    
    // --- Extra data ---
    if (!empty($extraIds)) {
        echo "  [EXTRA] " . count($extraIds) . " rows ADA di seeder tapi TIDAK di SQL lama:\n";
        foreach ($extraIds as $id) {
            $row = $seederById[$id];
            $tableResult['extra'][$id] = $row;
            echo "    ID=$id";
            // Tampilkan beberapa kolom kunci
            $previewCols = array_slice(array_keys($row), 0, 5);
            $preview = array_map(fn($c) => "$c=" . ($row[$c] ?? 'NULL'), $previewCols);
            echo " | " . implode(', ', $preview) . "\n";
        }
    }
    
    // --- Column diff ---
    $colDiffCount = 0;
    foreach ($commonIds as $id) {
        $sqlRow = $sqlById[$id];
        $seederRow = $seederById[$id];
        $diffs = compareCols($sqlRow, $seederRow, $seederCols);
        if (!empty($diffs)) {
            $tableResult['col_diffs'][$id] = $diffs;
            $colDiffCount++;
        }
    }
    
    if ($colDiffCount > 0) {
        echo "  [DIFF] $colDiffCount IDs memiliki perbedaan nilai kolom!\n";
    } else {
        echo "  [OK] Semua kolom cocok untuk " . count($commonIds) . " rows\n";
    }
    
    $allTableResults[$tableName] = $tableResult;
    echo "\n";
}

// =============================================
// BUAT OUTPUT FILE DETAIL
// =============================================

echo "\n=== MEMBUAT FILE LAPORAN DETAIL ===\n";

foreach ($allTableResults as $tableName => $result) {
    $outputFile = $outputDir . '/' . $tableName . '_diff.txt';
    $lines = [];
    
    $lines[] = "===== $tableName =====";
    $lines[] = "SQL Lama: {$result['sql_count']} rows";
    $lines[] = "Seeder Baru: {$result['seeder_count']} rows";
    $lines[] = "Kolom seeder: " . implode(', ', $result['seeder_cols']);
    $lines[] = "";
    
    // Missing
    if (!empty($result['missing'])) {
        $lines[] = "--- DATA KURANG DI SEEDER (" . count($result['missing']) . " rows) ---";
        $lines[] = "Sumber: SQL Lama → perlu ditambahkan ke seeder";
        $lines[] = "";
        foreach ($result['missing'] as $id => $row) {
            $lines[] = "ID={$id}:";
            foreach ($row as $col => $val) {
                $lines[] = "  $col = " . ($val ?? 'NULL');
            }
            $lines[] = "";
        }
    } else {
        $lines[] = "--- DATA: Tidak ada yang kurang ---";
        $lines[] = "";
    }
    
    // Extra
    if (!empty($result['extra'])) {
        $lines[] = "--- DATA EKSTRA DI SEEDER (" . count($result['extra']) . " rows) ---";
        $lines[] = "Data ini ada di seeder tapi TIDAK di SQL lama";
        $lines[] = "";
        foreach ($result['extra'] as $id => $row) {
            $lines[] = "ID={$id}:";
            foreach ($row as $col => $val) {
                $lines[] = "  $col = " . ($val ?? 'NULL');
            }
            $lines[] = "";
        }
    } else {
        $lines[] = "--- EKSTRA: Tidak ada data ekstra ---";
        $lines[] = "";
    }
    
    // Column diffs
    if (!empty($result['col_diffs'])) {
        $lines[] = "--- PERBEDAAN NILAI KOLOM (" . count($result['col_diffs']) . " IDs) ---";
        $lines[] = "";
        foreach ($result['col_diffs'] as $id => $diffs) {
            $lines[] = "ID={$id}:";
            foreach ($diffs as $col => $diff) {
                $lines[] = "  Kolom '$col':";
                $lines[] = "    SQL Lama  : " . $diff['sql'];
                $lines[] = "    Seeder Baru: " . $diff['seeder'];
            }
            $lines[] = "";
        }
    } else {
        $lines[] = "--- KOLOM: Semua nilai cocok ---";
    }
    
    file_put_contents($outputFile, implode("\n", $lines));
    echo "  Laporan: $outputFile\n";
}

// =============================================
// RINGKASAN AKHIR
// =============================================

echo "\n";
echo "============================================================\n";
echo "RINGKASAN AKHIR\n";
echo "============================================================\n";
printf("%-28s %8s %8s %8s %8s %10s\n", "Tabel", "SQL", "Seeder", "Miss", "Extra", "ColDiff");
echo str_repeat("-", 80) . "\n";

foreach ($allTableResults as $tableName => $result) {
    $miss = count($result['missing']);
    $extra = count($result['extra']);
    $diff = count($result['col_diffs']);
    $status = ($miss === 0 && $diff === 0) ? 'OK' : '!!';
    printf("%-28s %8d %8d %8d %8d %10d  [%s]\n",
        $tableName,
        $result['sql_count'], $result['seeder_count'],
        $miss, $extra, $diff, $status
    );
}

echo "\nFile laporan detail tersimpan di: $outputDir\n";
echo "Selesai: " . date('Y-m-d H:i:s') . "\n";
