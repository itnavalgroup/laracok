import re

file_path = "d:\\!Kerja\\laracok - Copy\\database\\migrations\\2026_10_14_104102_add_foreign_keys.php"

with open(file_path, "r", encoding="utf-8") as f:
    content = f.read()

fks = [
    # tbl_productions
    ('tbl_productions', 'id_user', 'tbl_user', 'id_user'),
    ('tbl_productions', 'id_warehouse', 'tbl_warehouse', 'id_warehouse'),
    ('tbl_productions', 'id_departement', 'tbl_departement', 'id_departement'),
    ('tbl_productions', 'id_company', 'tbl_company', 'id_company'),
    ('tbl_productions', 'processed_by', 'tbl_user', 'id_user'),
    ('tbl_productions', 'finished_by', 'tbl_user', 'id_user'),
    ('tbl_productions', 'canceled_by', 'tbl_user', 'id_user'),
    
    # tbl_production_materials
    ('tbl_production_materials', 'id_production', 'tbl_productions', 'id_production'),
    ('tbl_production_materials', 'id_item', 'tbl_items', 'id_item'),
    ('tbl_production_materials', 'id_item_category', 'tbl_item_categories', 'id_item_category'),
    ('tbl_production_materials', 'id_uom', 'tbl_uoms', 'id_uom'),
    ('tbl_production_materials', 'id_packaging', 'tbl_packagings', 'id_packaging'),

    # tbl_production_results
    ('tbl_production_results', 'id_production', 'tbl_productions', 'id_production'),
    ('tbl_production_results', 'id_item', 'tbl_items', 'id_item'),
    ('tbl_production_results', 'id_item_category', 'tbl_item_categories', 'id_item_category'),
    ('tbl_production_results', 'id_uom', 'tbl_uoms', 'id_uom'),
    ('tbl_production_results', 'id_packaging', 'tbl_packagings', 'id_packaging'),

    # tbl_production_attachments
    ('tbl_production_attachments', 'id_production', 'tbl_productions', 'id_production'),
    ('tbl_production_attachments', 'id_attachment', 'tbl_attachment', 'id_attachment'),
    ('tbl_production_attachments', 'id_user', 'tbl_user', 'id_user'),
]

ups = []
downs = []

for t, c, rt, rc in fks:
    up = f"""        Schema::table('{t}', function (Blueprint $table) {{
            $foreignKeys = array_map(function($fk) {{ return $fk['columns']; }}, Schema::getForeignKeys('{t}'));
            $exists = false;
            foreach ($foreignKeys as $columns) {{
                if (in_array('{c}', $columns)) {{
                    $exists = true;
                    break;
                }}
            }}
            if (!$exists) {{
                $table->foreign('{c}')->references('{rc}')->on('{rt}')->onDelete('restrict');
            }}
        }});
"""
    down = f"""        Schema::table('{t}', function (Blueprint $table) {{
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('{t}');
            $exists = collect($foreignKeys)->contains(function ($fk) {{
                return in_array('{c}', $fk->getLocalColumns());
            }});
            
            if ($exists) {{
                $table->dropForeign(['{c}']);
            }}
        }});
"""
    ups.append(up)
    downs.append(down)

ups_str = "\n".join(ups)
downs_str = "\n".join(downs)

up_target = """        });
    }

    public function down(): void"""

up_replacement = "        });\n\n" + ups_str + """    }

    public function down(): void"""

down_target = """        });
    }

};"""

down_replacement = "        });\n\n" + downs_str + """    }

};"""

if up_target in content:
    content = content.replace(up_target, up_replacement)
else:
    print("Could not find up_target")
    
if down_target in content:
    content = content.replace(down_target, down_replacement)
else:
    print("Could not find down_target")

with open(file_path, "w", encoding="utf-8") as f:
    f.write(content)

print("Done")
