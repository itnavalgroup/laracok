#!/usr/bin/env python3
"""
Laravel Seeder Generator from MySQL Backup
==========================================
Parses mysqldump (data-only) SQL file and generates individual Laravel
seeder PHP classes for each table, plus a DatabaseSeeder that calls them all
in the correct dependency order (parents before children).

Usage:
    python generate_seeders.py

Output:
    database/seeders/<TableName>Seeder.php  — one file per table
    database/seeders/DatabaseSeeder.php     — orchestrator
"""

import re
import os
import sys
from pathlib import Path

# ─────────────────────────── Configuration ────────────────────────────────────

SQL_FILE = r"D:\!Kerja\Krishna Sukses Abadi\Backup Database\sumberb1_laracok_data2026_04_09.sql"
OUTPUT_DIR = r"d:\!Kerja\laracok - Copy\database\seeders"

# Tables to SKIP (framework infrastructure, not business data)
SKIP_TABLES = {"migrations", "cache", "cache_locks", "sessions", "jobs",
               "job_batches", "failed_jobs", "password_reset_tokens"}

# Seeder order: tables with no FK deps first, then their dependents.
# Anything not listed here will be appended at the end alphabetically.
SEEDER_ORDER = [
    # ── Core lookup / master data ──────────────────────────────────────────
    "tbl_company",
    "tbl_branch",
    "tbl_departement",
    "tbl_position",
    "tbl_levels",
    "tbl_currency",
    "tbl_uoms",
    "tbl_packagings",
    "tbl_tax_types",
    "tbl_tax",
    "tbl_doc_types",
    "tbl_cost_categories",
    "tbl_cost_types",
    "tbl_item_categories",
    "tbl_items",
    "tbl_ikb_transaction_types",
    "tbl_permissions",
    # ── Users & contacts ──────────────────────────────────────────────────
    "tbl_user",
    "tbl_user_permissions",
    "tbl_email_user",
    "tbl_norek_user",
    "tbl_vendor",
    "tbl_email_vendor",
    "tbl_norek_vendor",
    # ── Warehouses & attachments ──────────────────────────────────────────
    "tbl_warehouse",
    "tbl_attachment",
    # ── Transactions ─────────────────────────────────────────────────────
    "tbl_loans",
    "tbl_contract",
    "tbl_contract_detail",
    "tbl_ikb",
    "tbl_ikb_details",
    "tbl_attachment_ikb",
    "tbl_item_transactions",
    "tbl_pr",
    "tbl_detail_pr",
    "tbl_pr_item_transactions",
    "tbl_attachment_pr",
    "tbl_sr",
    "tbl_detail_sr",
    "tbl_sr_item_transactions",
    "tbl_attachment_sr",
    "tbl_payment",
    "tbl_attachment_payment",
    "tbl_invoice",
    "tbl_sign_transaction",
    # ── Production ───────────────────────────────────────────────────────
    "tbl_productions",
    "tbl_production_materials",
    "tbl_production_results",
    "tbl_production_attachments",
    # ── Logs ─────────────────────────────────────────────────────────────
    "tbl_log",
]

# ─────────────────────────── SQL Parsing ──────────────────────────────────────

def parse_sql_file(sql_path: str) -> dict[str, list[str]]:
    """
    Returns a dict  table_name -> [raw_sql_insert_statement, ...]
    Each element is a complete  INSERT INTO ... statement (may span multi-line values).
    """
    print(f"Reading SQL file: {sql_path}")
    with open(sql_path, "r", encoding="utf-8", errors="replace") as f:
        content = f.read()

    # Split on INSERT INTO boundaries
    # Pattern: capture each "INSERT INTO `table` (...) VALUES\n(...);"
    pattern = re.compile(
        r"INSERT INTO `(\w+)` \(([^)]+)\) VALUES\s*\n(.*?);",
        re.DOTALL
    )

    tables: dict[str, list[dict]] = {}  # table -> list of row-dicts

    for m in pattern.finditer(content):
        table_name = m.group(1)
        if table_name in SKIP_TABLES:
            continue

        columns_raw = m.group(2)
        values_block = m.group(3)

        columns = [c.strip().strip("`") for c in columns_raw.split(",")]

        # Parse individual row tuples from the VALUES block
        rows = parse_value_rows(values_block, columns)

        if table_name not in tables:
            tables[table_name] = []
        tables[table_name].extend(rows)

    print(f"Found {len(tables)} tables with data.")
    return tables


def parse_value_rows(values_block: str, columns: list[str]) -> list[dict]:
    """
    Tokenises a MySQL VALUES block into a list of column→value dicts.
    Handles:
      - NULL
      - Integer / float literals
      - Single-quoted strings with escaped quotes (\' and '')
      - Multi-line strings
    """
    rows = []
    pos = 0
    text = values_block.strip()

    while pos < len(text):
        # Skip whitespace / commas between rows
        while pos < len(text) and text[pos] in (" ", "\t", "\r", "\n", ","):
            pos += 1
        if pos >= len(text):
            break

        if text[pos] != "(":
            pos += 1
            continue

        pos += 1  # skip '('
        values = []
        while pos < len(text):
            # Skip whitespace
            while pos < len(text) and text[pos] in (" ", "\t", "\r", "\n"):
                pos += 1
            if pos >= len(text):
                break

            ch = text[pos]

            if ch == ")":
                pos += 1  # end of row
                break

            elif ch == "'":
                # Quoted string — scan to the closing unescaped quote
                pos += 1
                buf = []
                while pos < len(text):
                    c = text[pos]
                    if c == "\\" and pos + 1 < len(text):
                        next_c = text[pos + 1]
                        escape_map = {
                            "'": "'", '"': '"', "\\": "\\",
                            "n": "\n", "r": "\r", "t": "\t",
                            "0": "\x00",
                        }
                        buf.append(escape_map.get(next_c, next_c))
                        pos += 2
                    elif c == "'" and pos + 1 < len(text) and text[pos + 1] == "'":
                        buf.append("'")
                        pos += 2
                    elif c == "'":
                        pos += 1
                        break
                    else:
                        buf.append(c)
                        pos += 1
                values.append(("str", "".join(buf)))

            elif text[pos:pos+4].upper() == "NULL":
                values.append(("null", None))
                pos += 4

            else:
                # Numeric / unquoted token
                end = pos
                while end < len(text) and text[end] not in (",", ")", " ", "\t", "\r", "\n"):
                    end += 1
                token = text[pos:end]
                pos = end
                values.append(("num", token))

            # Skip trailing comma / whitespace
            while pos < len(text) and text[pos] in (" ", "\t", "\r", "\n"):
                pos += 1
            if pos < len(text) and text[pos] == ",":
                pos += 1

        # Map columns → values
        if values:
            row = {}
            for i, col in enumerate(columns):
                if i < len(values):
                    row[col] = values[i]
                else:
                    row[col] = ("null", None)
            rows.append(row)

    return rows


# ─────────────────────────── PHP Rendering ────────────────────────────────────

def php_value(val_tuple) -> str:
    """Convert a parsed value tuple to a PHP literal.

    MySQL 'zero' datetime values (0000-00-00, 0000-00-00 00:00:00) are
    invalid in strict mode — convert them to null automatically.
    """
    kind, val = val_tuple
    if kind == "null":
        return "null"
    if kind == "num":
        return val  # already a PHP-compatible numeric literal
    # kind == "str"
    # Treat MySQL zero-date values as null (rejected by MySQL strict mode)
    if val in ("0000-00-00", "0000-00-00 00:00:00"):
        return "null"
    escaped = val.replace("\\", "\\\\").replace("'", "\\'")
    return f"'{escaped}'"


def table_to_class_name(table_name: str) -> str:
    """tbl_ikb_details → TblIkbDetailsSeeder"""
    parts = table_name.split("_")
    return "".join(p.capitalize() for p in parts) + "Seeder"


def generate_seeder_php(table_name: str, rows: list[dict]) -> str:
    """Generate the PHP content for a single table seeder."""
    class_name = table_to_class_name(table_name)

    # Build data array lines
    data_lines = []
    for row in rows:
        pairs = []
        for col, val_tuple in row.items():
            pairs.append(f"                '{col}' => {php_value(val_tuple)}")
        data_lines.append("            [\n" + ",\n".join(pairs) + "\n            ]")

    data_str = ",\n".join(data_lines)

    php = f"""<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;

class {class_name} extends Seeder
{{
    public function run(): void
    {{
        DB::table('{table_name}')->truncate();

        $data = [
{data_str}
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {{
            DB::table('{table_name}')->insert($chunk);
        }}
    }}
}}
"""
    return php


def generate_database_seeder(all_tables: list[str]) -> str:
    """Generate the orchestrating DatabaseSeeder.php."""
    calls = "\n".join(
        f"        $this->call({table_to_class_name(t)}::class);"
        for t in all_tables
    )

    use_lines = "\n".join(
        f"use Database\\Seeders\\{table_to_class_name(t)};"
        for t in all_tables
    )

    php = f"""<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Facades\\Schema;

class DatabaseSeeder extends Seeder
{{
    public function run(): void
    {{
        // Disable FK checks so truncate works regardless of order
        Schema::disableForeignKeyConstraints();

{calls}

        Schema::enableForeignKeyConstraints();
    }}
}}
"""
    return php


# ─────────────────────────── Main ─────────────────────────────────────────────

def main():
    tables_data = parse_sql_file(SQL_FILE)

    # Determine output order
    ordered = []
    for t in SEEDER_ORDER:
        if t in tables_data:
            ordered.append(t)

    # Append any tables in the SQL that aren't in SEEDER_ORDER
    for t in sorted(tables_data.keys()):
        if t not in ordered:
            ordered.append(t)

    os.makedirs(OUTPUT_DIR, exist_ok=True)

    generated = []
    for table_name in ordered:
        rows = tables_data[table_name]
        php_content = generate_seeder_php(table_name, rows)
        class_name = table_to_class_name(table_name)
        out_path = os.path.join(OUTPUT_DIR, f"{class_name}.php")
        with open(out_path, "w", encoding="utf-8", newline="\n") as f:
            f.write(php_content)
        generated.append(table_name)
        print(f"  [OK]  {class_name}.php  ({len(rows)} rows)")

    # Write DatabaseSeeder
    db_seeder_path = os.path.join(OUTPUT_DIR, "DatabaseSeeder.php")
    with open(db_seeder_path, "w", encoding="utf-8", newline="\n") as f:
        f.write(generate_database_seeder(generated))
    print(f"\n  [OK]  DatabaseSeeder.php  ({len(generated)} seeders called)")
    print(f"\nDone! Seeder files written to: {OUTPUT_DIR}")


if __name__ == "__main__":
    main()
