<?php
/**
 * Analisis file SQL terbaru di folder terbaru/
 * dan tampilkan perbandingan dengan seeder yang ada
 */
set_time_limit(300);
ini_set('memory_limit', '512M');

$terbaruDir = __DIR__ . '/terbaru';
$seederDir  = __DIR__ . '/../seeders';

$files = [
    'tbl_pr'               => ['seeder' => 'TblPrSeeder.php',               'id' => 'id_pr'],
    'tbl_detail_pr'        => ['seeder' => 'TblDetailPrSeeder.php',          'id' => 'id_detail_pr'],
    'tbl_sign_transaction' => ['seeder' => 'TblSignTransactionSeeder.php',   'id' => 'id_sign_transaction'],
    'tbl_attachment_sr'    => ['seeder' => 'TblAttachmentSrSeeder.php',      'id' => 'id_attachment_sr'],
];

// ---- helpers ----

function splitRows(string $block): array {
    $rows = []; $cur = ''; $d = 0; $inS = false; $sc = '';
    for ($i = 0; $i < strlen($block); $i++) {
        $c = $block[$i];
        if (!$inS && ($c === "'" || $c === '"')) { $inS = true;  $sc = $c; }
        elseif ($inS && $c === $sc && ($i === 0 || $block[$i-1] !== '\\')) { $inS = false; }
        if (!$inS) { if ($c === '(') $d++; elseif ($c === ')') $d--; }
        $cur .= $c;
        if ($d === 0 && $c === ')') {
            $row = trim($cur); if ($row) $rows[] = $row; $cur = '';
            if (isset($block[$i+1]) && $block[$i+1] === ',') $i++;
        }
    }
    return $rows;
}

function parseRow(string $row): array {
    if (!preg_match('/^\((.+)\)$/s', $row, $m)) return [];
    $vals = []; $cur = ''; $inS = false; $sc = ''; $s = $m[1];
    for ($i = 0; $i < strlen($s); $i++) {
        $c = $s[$i];
        if (!$inS && ($c === "'" || $c === '"')) { $inS = true; $sc = $c; $cur .= $c; }
        elseif ($inS && $c === $sc && ($i === 0 || $s[$i-1] !== '\\')) { $inS = false; $cur .= $c; }
        elseif (!$inS && $c === ',') { $vals[] = trim($cur); $cur = ''; }
        else { $cur .= $c; }
    }
    if ($cur !== '') $vals[] = trim($cur);
    return $vals;
}

function extractFromSqlFile(string $sqlPath, string $tableName): array {
    $sql = file_get_contents($sqlPath);
    $data = [];
    $pat = '/INSERT INTO `' . preg_quote($tableName, '/') . '` \(([^)]+)\) VALUES\s*([^;]+);/s';
    preg_match_all($pat, $sql, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $cols = array_map(fn($c) => trim($c, ' `'), explode(',', $m[1]));
        foreach (splitRows($m[2]) as $row) {
            $vals = parseRow($row);
            if (count($vals) === count($cols)) {
                $r = [];
                foreach ($cols as $i => $col) {
                    $v = $vals[$i]; $r[$col] = ($v === 'NULL') ? null : trim($v, "'");
                }
                $data[] = $r;
            }
        }
    }
    return $data;
}

function getSeederIds(string $seederFile, string $idCol): array {
    $content = file_get_contents($seederFile);
    preg_match_all("/'" . preg_quote($idCol, '/') . "'\s*=>\s*(\d+)/", $content, $m);
    return $m[1];
}

// ---- Analisis ----

echo "=== ANALISIS DATA TERBARU ===\n\n";

foreach ($files as $tableName => $cfg) {
    $sqlPath    = $terbaruDir . '/' . $tableName . '.sql';
    $seederPath = $seederDir  . '/' . $cfg['seeder'];
    $idCol      = $cfg['id'];

    echo "=== $tableName ===\n";

    if (!file_exists($sqlPath)) { echo "  File SQL tidak ada\n\n"; continue; }

    $newData  = extractFromSqlFile($sqlPath, $tableName);
    $newIds   = array_column($newData, $idCol);
    $newCount = count($newIds);
    echo "  SQL Terbaru : $newCount rows | Min: " . (min($newIds) ?: '?') . " | Max: " . (max($newIds) ?: '?') . "\n";

    if (file_exists($seederPath)) {
        $seederIds   = getSeederIds($seederPath, $idCol);
        $seederCount = count($seederIds);
        echo "  Seeder Lama : $seederCount rows | Min: " . (min($seederIds) ?: '?') . " | Max: " . (max($seederIds) ?: '?') . "\n";

        $diff = $newCount - $seederCount;
        if ($diff === 0) {
            echo "  [=] Jumlah rows SAMA\n";
        } elseif ($diff > 0) {
            echo "  [+] SQL Terbaru LEBIH BANYAK $diff rows\n";
        } else {
            echo "  [-] Seeder lebih banyak " . abs($diff) . " rows\n";
        }

        $newInSql    = array_diff($newIds, $seederIds);
        $onlySeeder  = array_diff($seederIds, $newIds);
        if (!empty($newInSql)) {
            echo "  [NEW] Ada di SQL Terbaru tapi TIDAK di seeder (" . count($newInSql) ." IDs)\n";
            echo "        Sample: " . implode(', ', array_slice(array_values($newInSql), 0, 20)) . "\n";
        }
        if (!empty($onlySeeder)) {
            echo "  [DEL] Ada di seeder tapi TIDAK di SQL Terbaru (" . count($onlySeeder) . " IDs)\n";
            echo "        Sample: " . implode(', ', array_slice(array_values($onlySeeder), 0, 10)) . "\n";
        }
    } else {
        echo "  Seeder belum ada\n";
    }
    echo "\n";
}
