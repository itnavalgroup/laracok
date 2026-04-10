<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::table('tbl_attachment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_ikb', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_ikb')->references('id_ikb')->on('tbl_ikb')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_attachment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_attachment')->references('id_attachment')->on('tbl_attachment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_attachment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_attachment')->references('id_attachment')->on('tbl_attachment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_payment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_payment')->references('id_payment')->on('tbl_payment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_attachment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_attachment')->references('id_attachment')->on('tbl_attachment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_sr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_sr')->references('id_sr')->on('tbl_sr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_attachment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_attachment')->references('id_attachment')->on('tbl_attachment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_attachment_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_cost_categories', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_cost_categories'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_cost_types', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_cost_types'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_cost_types', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_cost_types'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_category')->references('id_cost_category')->on('tbl_cost_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax_type1', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax_type1')->references('id_tax_type')->on('tbl_tax_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax1', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax1')->references('id_tax')->on('tbl_tax')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax_type2', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax_type2')->references('id_tax_type')->on('tbl_tax_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax2', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax2')->references('id_tax')->on('tbl_tax')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_sr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_sr')->references('id_sr')->on('tbl_sr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax_type1', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax_type1')->references('id_tax_type')->on('tbl_tax_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax1', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax1')->references('id_tax')->on('tbl_tax')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax_type2', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax_type2')->references('id_tax_type')->on('tbl_tax_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax2', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax2')->references('id_tax')->on('tbl_tax')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_detail_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_email_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_email_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_email_vendor', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_email_vendor'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_ikb_transaction_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_ikb_transaction_type')->references('id_ikb_transaction_type')->on('tbl_ikb_transaction_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_attachment', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_attachment')->references('id_attachment')->on('tbl_attachment')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract_detail'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_contract', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_contract')->references('id_contract')->on('tbl_contract')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract_detail'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_contract_detail'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_ikb', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_ikb')->references('id_ikb')->on('tbl_ikb')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_contract')->references('id_contract')->on('tbl_contract')->onDelete('restrict');
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_ikb_details'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_packaging', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_packaging')->references('id_packaging')->on('tbl_packagings')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_invoice'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_norek_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_norek_vendor')->references('id_norek_vendor')->on('tbl_norek_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_items', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_items'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_categories', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_categories'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item_category')->references('id_item_category')->on('tbl_item_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_packaging', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_packaging')->references('id_packaging')->on('tbl_packagings')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_sr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_sr')->references('id_sr')->on('tbl_sr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_loans', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_loans'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_log', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_log'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_log', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_log'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_norek_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_norek_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_norek_vendor', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_norek_vendor'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_packagings', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_packagings'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_packagings', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_packagings'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_type')->references('id_cost_type')->on('tbl_cost_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_category')->references('id_cost_category')->on('tbl_cost_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_branch', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_branch')->references('id_branch')->on('tbl_branch')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_payment'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_norek_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_norek_vendor')->references('id_norek_vendor')->on('tbl_norek_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_type')->references('id_cost_type')->on('tbl_cost_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_category')->references('id_cost_category')->on('tbl_cost_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_branch', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_branch')->references('id_branch')->on('tbl_branch')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_loan', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_loan')->references('id_loan')->on('tbl_loans')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_email_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_email_vendor')->references('id_email_vendor')->on('tbl_email_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_norek_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_norek_vendor')->references('id_norek_vendor')->on('tbl_norek_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_email_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_email_user')->references('id_email_user')->on('tbl_email_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_currency', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_currency')->references('id_currency')->on('tbl_currency')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_packaging', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_packaging')->references('id_packaging')->on('tbl_packagings')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_pr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sign_transaction'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sign_transaction'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_ikb', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_ikb')->references('id_ikb')->on('tbl_ikb')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sign_transaction'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sign_transaction'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_pr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_pr')->references('id_pr')->on('tbl_pr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_type')->references('id_cost_type')->on('tbl_cost_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_cost_category', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_cost_category')->references('id_cost_category')->on('tbl_cost_categories')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_branch', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_branch')->references('id_branch')->on('tbl_branch')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_loan', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_loan')->references('id_loan')->on('tbl_loans')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_vendor')->references('id_vendor')->on('tbl_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_email_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_email_vendor')->references('id_email_vendor')->on('tbl_email_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_norek_vendor', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_norek_vendor')->references('id_norek_vendor')->on('tbl_norek_vendor')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_email_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_email_user')->references('id_email_user')->on('tbl_email_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_sr', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_sr')->references('id_sr')->on('tbl_sr')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_item', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_item')->references('id_item')->on('tbl_items')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_uom', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_uom')->references('id_uom')->on('tbl_uoms')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_packaging', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_packaging')->references('id_packaging')->on('tbl_packagings')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_sr_item_transactions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_doc_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_doc_type')->references('id_doc_type')->on('tbl_doc_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_tax', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_tax'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_tax_type', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_tax_type')->references('id_tax_type')->on('tbl_tax_types')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_company', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_company')->references('id_company')->on('tbl_company')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_branch', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_branch')->references('id_branch')->on('tbl_branch')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_position', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_position')->references('id_position')->on('tbl_position')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_warehouse', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_warehouse')->references('id_warehouse')->on('tbl_warehouse')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user_permissions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user_permissions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_user_permissions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_user_permissions'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_permission', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_permission')->references('id_permission')->on('tbl_permissions')->onDelete('restrict');
            }
        });

        Schema::table('tbl_vendor', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_vendor'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_departement', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_departement')->references('id_departement')->on('tbl_departement')->onDelete('restrict');
            }
        });

        Schema::table('tbl_vendor', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_vendor'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_warehouse', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_warehouse'));
            $exists = false;
            foreach ($foreignKeys as $columns) {
                if (in_array('id_user', $columns)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            }
        });

        Schema::table('tbl_productions', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_productions'));
            $fks = [
                ['id_user', 'id_user', 'tbl_user'],
                ['id_warehouse', 'id_warehouse', 'tbl_warehouse'],
                ['id_departement', 'id_departement', 'tbl_departement'],
                ['id_company', 'id_company', 'tbl_company'],
                ['processed_by', 'id_user', 'tbl_user'],
                ['finished_by', 'id_user', 'tbl_user'],
                ['canceled_by', 'id_user', 'tbl_user'],
            ];
            foreach ($fks as $fk_data) {
                $exists = false;
                foreach ($foreignKeys as $columns) {
                    if (in_array($fk_data[0], $columns)) { $exists = true; break; }
                }
                if (!$exists) {
                    $table->foreign($fk_data[0])->references($fk_data[1])->on($fk_data[2])->onDelete('restrict');
                }
            }
        });

        $matResFks = [
            ['id_production', 'id_production', 'tbl_productions'],
            ['id_item', 'id_item', 'tbl_items'],
            ['id_item_category', 'id_item_category', 'tbl_item_categories'],
            ['id_uom', 'id_uom', 'tbl_uoms'],
            ['id_packaging', 'id_packaging', 'tbl_packagings'],
        ];

        foreach (['tbl_production_materials', 'tbl_production_results'] as $t) {
            Schema::table($t, function (Blueprint $table) use ($matResFks, $t) {
                $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys($t));
                foreach ($matResFks as $fk_data) {
                    $exists = false;
                    foreach ($foreignKeys as $columns) {
                        if (in_array($fk_data[0], $columns)) { $exists = true; break; }
                    }
                    if (!$exists) {
                        $table->foreign($fk_data[0])->references($fk_data[1])->on($fk_data[2])->onDelete('restrict');
                    }
                }
            });
        }

        Schema::table('tbl_production_attachments', function (Blueprint $table) {
            $foreignKeys = array_map(function($fk) { return $fk['columns']; }, Schema::getForeignKeys('tbl_production_attachments'));
            $fks = [
                ['id_production', 'id_production', 'tbl_productions'],
                ['id_attachment', 'id_attachment', 'tbl_attachment'],
                ['id_user', 'id_user', 'tbl_user'],
            ];
            foreach ($fks as $fk_data) {
                $exists = false;
                foreach ($foreignKeys as $columns) {
                    if (in_array($fk_data[0], $columns)) { $exists = true; break; }
                }
                if (!$exists) {
                    $table->foreign($fk_data[0])->references($fk_data[1])->on($fk_data[2])->onDelete('restrict');
                }
            }
        });
    }

    public function down(): void
    {

        Schema::table('tbl_attachment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_attachment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_ikb', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_ikb']);
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

        Schema::table('tbl_attachment_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_payment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_payment']);
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_attachment_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

        Schema::table('tbl_attachment_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_sr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_sr']);
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

        Schema::table('tbl_attachment_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_attachment_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_cost_categories', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_cost_categories');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_cost_types', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_cost_types');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_cost_types', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_cost_types');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_category']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax_type1', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax_type1']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax1', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax1']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax_type2', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax_type2']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax2', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax2']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_detail_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_sr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_sr']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax_type1', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax_type1']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax1', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax1']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax_type2', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax_type2']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax2', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax2']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_detail_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_detail_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_email_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_email_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_email_vendor', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_email_vendor');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_ikb', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_ikb_transaction_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_ikb_transaction_type']);
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });
        
        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

         Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_contract', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_contract']);
            }
        });

        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });
        
        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

         Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });
        
        Schema::table('tbl_contract', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_attachment', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_attachment']);
            }
        });

         Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_contract', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_contract']);
            }
        });

        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });
        
        Schema::table('tbl_contract_detail', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_contract_detail');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_ikb', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_ikb']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_contract', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_contract']);
            }
        });

        Schema::table('tbl_ikb_details', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_ikb_details');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_packaging', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_packaging']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_invoice', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_invoice');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_norek_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_norek_vendor']);
            }
        });

        Schema::table('tbl_items', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_items');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });

        Schema::table('tbl_item_categories', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_categories');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item_category']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_packaging', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_packaging']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_sr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_sr']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_loans', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_loans');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_log', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_log');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_log', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_log');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_norek_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_norek_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_norek_vendor', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_norek_vendor');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_packagings', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_packagings');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_packagings', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_packagings');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_type']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_category']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_branch', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_branch']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_payment', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_payment');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_norek_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_norek_vendor']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_type']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_category']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_branch', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_branch']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_loan', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_loan']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_email_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_email_vendor']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_norek_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_norek_vendor']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_email_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_email_user']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_currency', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_currency']);
            }
        });

        Schema::table('tbl_pr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_packaging', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_packaging']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_pr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_pr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sign_transaction');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sign_transaction');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_ikb', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_ikb']);
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sign_transaction');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_sign_transaction', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sign_transaction');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_pr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_pr']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_type']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_cost_category', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_cost_category']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_branch', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_branch']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_loan', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_loan']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_vendor']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_email_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_email_vendor']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_norek_vendor', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_norek_vendor']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_email_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_email_user']);
            }
        });

        Schema::table('tbl_sr', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_sr', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_sr']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_item', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_item']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_uom', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_uom']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_packaging', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_packaging']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_sr_item_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_sr_item_transactions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_doc_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_doc_type']);
            }
        });

        Schema::table('tbl_tax', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_tax');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_tax_type', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_tax_type']);
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_company', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_company']);
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_branch', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_branch']);
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_position', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_position']);
            }
        });

        Schema::table('tbl_user', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_warehouse', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_warehouse']);
            }
        });

        Schema::table('tbl_user_permissions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user_permissions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_user_permissions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_user_permissions');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_permission', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_permission']);
            }
        });

        Schema::table('tbl_vendor', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_vendor');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_departement', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_departement']);
            }
        });

        Schema::table('tbl_vendor', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_vendor');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        Schema::table('tbl_warehouse', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('tbl_warehouse');
            $exists = collect($foreignKeys)->contains(function ($fk) {
                return in_array('id_user', $fk->getLocalColumns());
            });
            
            if ($exists) {
                $table->dropForeign(['id_user']);
            }
        });

        $tables = [
            'tbl_productions' => ['id_user', 'id_warehouse', 'id_departement', 'id_company', 'processed_by', 'finished_by', 'canceled_by', 'id_requestor'],
            'tbl_production_materials' => ['id_production', 'id_item', 'id_item_category', 'id_uom', 'id_packaging'],
            'tbl_production_results' => ['id_production', 'id_item', 'id_item_category', 'id_uom', 'id_packaging'],
            'tbl_production_attachments' => ['id_production', 'id_attachment', 'id_user'],
        ];

        foreach ($tables as $t => $cols) {
            Schema::table($t, function (Blueprint $table) use ($t, $cols) {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $foreignKeys = $sm->listTableForeignKeys($t);
                foreach ($cols as $c) {
                    $exists = collect($foreignKeys)->contains(function ($fk) use ($c) {
                        return in_array($c, $fk->getLocalColumns());
                    });
                    if ($exists) {
                        $table->dropForeign([$c]);
                    }
                }
            });
        }
    }

};
