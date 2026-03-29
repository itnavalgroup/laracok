<?php
/**
 * Regenerate 4 seeder files dari SQL terbaru (data source terpercaya)
 * 
 * Acuan: database/datasql/terbaru/*.sql
 * Output: database/seeders/Tbl*Seeder.php
 *
 * Seeder yang diregenerasi:
 *  - TblPrSeeder.php
 *  - TblDetailPrSeeder.php
 *  - TblSignTransactionSeeder.php
 *  - TblAttachmentSrSeeder.php
 */

set_time_limit(600);
ini_set('memory_limit', '768M');

$terbaruDir = __DIR__ . '/terbaru';
$seederDir  = __DIR__ . '/../seeders';

// ---- Helper: parse SQL ----
function splitRowsSQL(string $block): array {
    $rows = []; $cur = ''; $d = 0; $inS = false; $sc = '';
    for ($i = 0, $len = strlen($block); $i < $len; $i++) {
        $c = $block[$i];
        if (!$inS && ($c === "'" || $c === '"')) { $inS = true;  $sc = $c; }
        elseif ($inS && $c === $sc && ($i === 0 || $block[$i-1] !== '\\')) { $inS = false; }
        if (!$inS) { if ($c === '(') $d++; elseif ($c === ')') $d--; }
        $cur .= $c;
        if ($d === 0 && $c === ')') {
            $r = trim($cur); if ($r) $rows[] = $r; $cur = '';
            if (isset($block[$i+1]) && $block[$i+1] === ',') $i++;
        }
    }
    return $rows;
}

function parseRowSQL(string $row): array {
    if (!preg_match('/^\((.+)\)$/s', $row, $m)) return [];
    $vals = []; $cur = ''; $inS = false; $sc = ''; $s = $m[1];
    for ($i = 0, $len = strlen($s); $i < $len; $i++) {
        $c = $s[$i];
        if (!$inS && ($c === "'" || $c === '"')) { $inS = true; $sc = $c; $cur .= $c; }
        elseif ($inS && $c === $sc && ($i === 0 || $s[$i-1] !== '\\')) { $inS = false; $cur .= $c; }
        elseif (!$inS && $c === ',') { $vals[] = trim($cur); $cur = ''; }
        else { $cur .= $c; }
    }
    if ($cur !== '') $vals[] = trim($cur);
    return $vals;
}

function extractTableRows(string $sqlPath, string $tableName): array {
    $sql  = file_get_contents($sqlPath);
    $data = [];
    $pat  = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \(([^)]+)\) VALUES\s*([^;]+);/s';
    preg_match_all($pat, $sql, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $cols = array_map(fn($c) => trim($c, ' `'), explode(',', $m[1]));
        foreach (splitRowsSQL($m[2]) as $row) {
            $vals = parseRowSQL($row);
            if (count($vals) === count($cols)) {
                $r = [];
                foreach ($cols as $i => $col) {
                    $v = $vals[$i];
                    $r[$col] = ($v === 'NULL') ? null : trim($v, "'");
                }
                $data[] = $r;
            }
        }
    }
    return $data;
}

// ---- Helper: format PHP value ----
function phpVal($val): string {
    if ($val === null) return 'null';
    // numeric that should stay numeric (not padded strings)
    if (is_numeric($val) && !preg_match('/^0\d/', $val)) {
        // keep floats as-is with 4dp
        if (strpos($val, '.') !== false) return number_format((float)$val, 4, '.', '');
        return (string)(int)$val;
    }
    // string – escape single-quotes
    $escaped = str_replace(["\\", "'"], ["\\\\", "\\'"], $val);
    return "'$escaped'";
}

// ---- Helper: generate seeder file ----
function generateSeeder(
    string $className,
    string $tableName,
    array  $rows,
    string $insertMethod,  // insertOrIgnore | upsert
    string $seederDir,
    ?string $upsertKey = null
): void {
    $chunkComment = '// Break payload into manageable memory chunks and insert';

    // build insert code snippet
    if ($insertMethod === 'upsert' && $upsertKey) {
        $insertSnippet = <<<PHP
        // Upsert – update existing rows, insert new ones
        \$chunks = array_chunk(\$payload, 200);
        foreach (\$chunks as \$chunk) {
            \$keys = array_keys(\$chunk[0]);
            DB::table('$tableName')->upsert(\$chunk, ['$upsertKey'], array_diff(\$keys, ['$upsertKey']));
        }
PHP;
    } else {
        $insertSnippet = <<<PHP
        $chunkComment
        \$chunks = array_chunk(\$payload, 200);
        foreach (\$chunks as \$chunk) {
            DB::table('$tableName')->insertOrIgnore(\$chunk);
        }
PHP;
    }

    $targetFile = $seederDir . '/' . $className . '.php';

    // Write header
    $header = "<?php\r\n\r\nnamespace Database\\Seeders;\r\n\r\nuse Illuminate\\Database\\Seeder;\r\nuse Illuminate\\Support\\Facades\\DB;\r\nuse Illuminate\\Support\\Facades\\Schema;\r\n\r\nclass $className extends Seeder\r\n{\r\n    /**\r\n     * Run the database seeds.\r\n     * Regenerated from: datasql/terbaru/$tableName.sql\r\n     * Generated at: " . date('Y-m-d H:i:s') . "\r\n     */\r\n    public function run(): void\r\n    {\r\n        Schema::disableForeignKeyConstraints();\r\n\r\n        \$payload = [\r\n";

    $fp = fopen($targetFile, 'w');
    fwrite($fp, $header);

    // Write rows
    foreach ($rows as $idx => $row) {
        fwrite($fp, "                    [\r\n");
        foreach ($row as $col => $val) {
            $v = phpVal($val);
            fwrite($fp, "                        '$col' => $v,\r\n");
        }
        fwrite($fp, "                    ],\r\n");
    }

    // Close payload and add insert code
    $footer = "        ];\r\n\r\n$insertSnippet\r\n\r\n        Schema::enableForeignKeyConstraints();\r\n    }\r\n}\r\n";
    fwrite($fp, $footer);
    fclose($fp);

    $size = round(filesize($targetFile) / 1024, 1);
    echo "  ✔ $className generated: " . count($rows) . " rows | $size KB\n";
}

// ====================================================
// 1. tbl_pr
// ====================================================
echo "=== tbl_pr ===\n";
$rows = extractTableRows("$terbaruDir/tbl_pr.sql", 'tbl_pr');
echo "  Parsed: " . count($rows) . " rows\n";

// Pastikan kolom schema baru ada (id_warehouse, deleted_at)
// Ambil contoh kolom dari seeder lama sebagai referensi
$seederSample = file_get_contents("$seederDir/TblPrSeeder.php");
preg_match('/\$payload\s*=\s*\[\s*\[(.+?)\],/s', $seederSample, $firstRow);
preg_match_all("/'([^']+)'\s*=>/", $firstRow[1] ?? '', $colMatch);
$seederCols = $colMatch[1] ?? [];

// Tambahkan kolom baru yang tidak ada di SQL terbaru tapi ada di seeder
foreach ($rows as &$row) {
    if (!array_key_exists('id_warehouse', $row)) $row['id_warehouse'] = null;
    if (!array_key_exists('deleted_at',   $row)) $row['deleted_at']   = null;
    // Reorder sesuai seeder cols jika tersedia
    if (!empty($seederCols)) {
        $ordered = [];
        foreach ($seederCols as $col) {
            $ordered[$col] = array_key_exists($col, $row) ? $row[$col] : null;
        }
        $row = $ordered;
    }
}
unset($row);

generateSeeder('TblPrSeeder', 'tbl_pr', $rows, 'insertOrIgnore', $seederDir);

// ====================================================
// 2. tbl_detail_pr
// ====================================================
echo "\n=== tbl_detail_pr ===\n";
$rows = extractTableRows("$terbaruDir/tbl_detail_pr.sql", 'tbl_detail_pr');
echo "  Parsed: " . count($rows) . " rows\n";

$seederSample2 = file_get_contents("$seederDir/TblDetailPrSeeder.php");
preg_match('/\$payload\s*=\s*\[\s*\[(.+?)\],/s', $seederSample2, $firstRow2);
preg_match_all("/'([^']+)'\s*=>/", $firstRow2[1] ?? '', $colMatch2);
$seederCols2 = $colMatch2[1] ?? [];

foreach ($rows as &$row) {
    if (!array_key_exists('id_item_category',  $row)) $row['id_item_category']  = null;
    if (!array_key_exists('id_item',            $row)) $row['id_item']            = null;
    if (!array_key_exists('id_warehouse',       $row)) $row['id_warehouse']       = null;
    if (!array_key_exists('is_purchase_items',  $row)) $row['is_purchase_items']  = null;
    if (!array_key_exists('deleted_at',         $row)) $row['deleted_at']         = null;
    if (!empty($seederCols2)) {
        $ordered = [];
        foreach ($seederCols2 as $col) {
            $ordered[$col] = array_key_exists($col, $row) ? $row[$col] : null;
        }
        $row = $ordered;
    }
}
unset($row);

generateSeeder('TblDetailPrSeeder', 'tbl_detail_pr', $rows, 'insertOrIgnore', $seederDir);

// ====================================================
// 3. tbl_sign_transaction
// ====================================================
echo "\n=== tbl_sign_transaction ===\n";
$rows = extractTableRows("$terbaruDir/tbl_sign_transaction.sql", 'tbl_sign_transaction');
echo "  Parsed: " . count($rows) . " rows\n";

$seederSample3 = file_get_contents("$seederDir/TblSignTransactionSeeder.php");
preg_match('/\$payload\s*=\s*\[\s*\[(.+?)\],/s', $seederSample3, $firstRow3);
preg_match_all("/'([^']+)'\s*=>/", $firstRow3[1] ?? '', $colMatch3);
$seederCols3 = $colMatch3[1] ?? [];

foreach ($rows as &$row) {
    // Kolom baru di seeder yang tidak ada di SQL lama
    if (!array_key_exists('id_ikb',     $row)) $row['id_ikb']     = null;
    if (!array_key_exists('deleted_at', $row)) $row['deleted_at'] = null;
    // Hapus kolom lama yang sudah tidak ada (id_sign_flow)
    unset($row['id_sign_flow']);
    if (!empty($seederCols3)) {
        $ordered = [];
        foreach ($seederCols3 as $col) {
            $ordered[$col] = array_key_exists($col, $row) ? $row[$col] : null;
        }
        $row = $ordered;
    }
}
unset($row);

generateSeeder('TblSignTransactionSeeder', 'tbl_sign_transaction', $rows, 'insertOrIgnore', $seederDir);

// ====================================================
// 4. tbl_attachment_sr
// ====================================================
echo "\n=== tbl_attachment_sr ===\n";
$rows = extractTableRows("$terbaruDir/tbl_attachment_sr.sql", 'tbl_attachment_sr');
echo "  Parsed: " . count($rows) . " rows\n";

$seederSample4 = file_get_contents("$seederDir/TblAttachmentSrSeeder.php");
preg_match('/\$payload\s*=\s*\[\s*\[(.+?)\],/s', $seederSample4, $firstRow4);
preg_match_all("/'([^']+)'\s*=>/", $firstRow4[1] ?? '', $colMatch4);
$seederCols4 = $colMatch4[1] ?? [];

foreach ($rows as &$row) {
    if (!array_key_exists('deleted_at', $row)) $row['deleted_at'] = null;
    if (!empty($seederCols4)) {
        $ordered = [];
        foreach ($seederCols4 as $col) {
            $ordered[$col] = array_key_exists($col, $row) ? $row[$col] : null;
        }
        $row = $ordered;
    }
}
unset($row);

generateSeeder('TblAttachmentSrSeeder', 'tbl_attachment_sr', $rows, 'insertOrIgnore', $seederDir);

// ====================================================
// Verifikasi cepat
// ====================================================
echo "\n=== VERIFIKASI ===\n";
$checks = [
    'TblPrSeeder.php'               => ['tbl_pr',               'id_pr',               1128],
    'TblDetailPrSeeder.php'         => ['tbl_detail_pr',        'id_detail_pr',        1107],
    'TblSignTransactionSeeder.php'  => ['tbl_sign_transaction', 'id_sign_transaction', 7905],
    'TblAttachmentSrSeeder.php'     => ['tbl_attachment_sr',    'id_attachment_sr',    140],
];

foreach ($checks as $file => [$tbl, $idCol, $expected]) {
    $content = file_get_contents("$seederDir/$file");
    preg_match_all("/'" . preg_quote($idCol, '/') . "'\s*=>\s*(\d+)/", $content, $m);
    $got = count($m[1]);
    $status = ($got === $expected) ? 'OK' : "MISMATCH (expected $expected)";
    echo "  $file: $got rows [$status]\n";
}

echo "\nSelesai: " . date('Y-m-d H:i:s') . "\n";
