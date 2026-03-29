<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // $this->call(TblAttachmentIkbSeeder::class);
        $this->call(TblAttachmentPaymentSeeder::class);
        $this->call(TblAttachmentPrSeeder::class);
        $this->call(TblAttachmentSeeder::class);
        $this->call(TblAttachmentSrSeeder::class);
        $this->call(TblBranchSeeder::class);
        $this->call(TblCompanySeeder::class);
        $this->call(TblCostCategoriesSeeder::class);
        $this->call(TblCostTypesSeeder::class);
        $this->call(TblCurrencySeeder::class);
        $this->call(TblDepartementSeeder::class);
        $this->call(TblDetailPrSeeder::class);
        $this->call(TblDetailSrSeeder::class);
        $this->call(TblDocTypesSeeder::class);
        $this->call(TblEmailUserSeeder::class);
        $this->call(TblEmailVendorSeeder::class);
        // $this->call(TblIkbDetailsSeeder::class);
        // $this->call(TblIkbSeeder::class);
        $this->call(TblIkbTransactionTypesSeeder::class);
        $this->call(TblInvoiceSeeder::class);
        $this->call(TblItemCategoriesSeeder::class);
        $this->call(TblItemTransactionsSeeder::class);
        $this->call(TblItemsSeeder::class);
        $this->call(TblLevelsSeeder::class);
        $this->call(TblLoansSeeder::class);
        $this->call(TblLogSeeder::class);
        $this->call(TblNorekUserSeeder::class);
        $this->call(TblNorekVendorSeeder::class);
        $this->call(TblPackagingsSeeder::class);
        $this->call(TblPaymentSeeder::class);
        $this->call(TblPermissionsSeeder::class);
        $this->call(TblPositionSeeder::class);
        $this->call(TblPrSeeder::class);
        $this->call(TblSignTransactionSeeder::class);
        $this->call(TblSrSeeder::class);
        $this->call(TblTaxSeeder::class);
        $this->call(TblTaxTypesSeeder::class);
        $this->call(TblUomsSeeder::class);
        $this->call(TblUserPermissionsSeeder::class);
        $this->call(TblUserSeeder::class);
        $this->call(TblVendorSeeder::class);
        $this->call(TblWarehouseSeeder::class);

        // --- AUTO-GENERATED FOREIGN KEY CLEANUP ---
        
        DB::statement("
            UPDATE `tbl_attachment_payment` t1
            LEFT JOIN `tbl_attachment` t2 
            ON t1.`id_attachment` = t2.`id_attachment`
            SET t1.`id_attachment` = NULL 
            WHERE t1.`id_attachment` IS NOT NULL 
            AND t2.`id_attachment` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_attachment_payment` t1
            LEFT JOIN `tbl_payment` t2 
            ON t1.`id_payment` = t2.`id_payment`
            SET t1.`id_payment` = NULL 
            WHERE t1.`id_payment` IS NOT NULL 
            AND t2.`id_payment` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_uoms` t2 
            ON t1.`id_uom` = t2.`id_uom`
            SET t1.`id_uom` = NULL 
            WHERE t1.`id_uom` IS NOT NULL 
            AND t2.`id_uom` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_items` t2 
            ON t1.`id_item` = t2.`id_item`
            SET t1.`id_item` = NULL 
            WHERE t1.`id_item` IS NOT NULL 
            AND t2.`id_item` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_pr` t1
            LEFT JOIN `tbl_warehouse` t2 
            ON t1.`id_warehouse` = t2.`id_warehouse`
            SET t1.`id_warehouse` = NULL 
            WHERE t1.`id_warehouse` IS NOT NULL 
            AND t2.`id_warehouse` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_sr` t2 
            ON t1.`id_sr` = t2.`id_sr`
            SET t1.`id_sr` = NULL 
            WHERE t1.`id_sr` IS NOT NULL 
            AND t2.`id_sr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_uoms` t2 
            ON t1.`id_uom` = t2.`id_uom`
            SET t1.`id_uom` = NULL 
            WHERE t1.`id_uom` IS NOT NULL 
            AND t2.`id_uom` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_items` t2 
            ON t1.`id_item` = t2.`id_item`
            SET t1.`id_item` = NULL 
            WHERE t1.`id_item` IS NOT NULL 
            AND t2.`id_item` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_detail_sr` t1
            LEFT JOIN `tbl_warehouse` t2 
            ON t1.`id_warehouse` = t2.`id_warehouse`
            SET t1.`id_warehouse` = NULL 
            WHERE t1.`id_warehouse` IS NOT NULL 
            AND t2.`id_warehouse` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_ikb` t1
            LEFT JOIN `tbl_ikb_transaction_types` t2 
            ON t1.`id_ikb_transaction_type` = t2.`id_ikb_transaction_type`
            SET t1.`id_ikb_transaction_type` = NULL 
            WHERE t1.`id_ikb_transaction_type` IS NOT NULL 
            AND t2.`id_ikb_transaction_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_company` t2 
            ON t1.`id_company` = t2.`id_company`
            SET t1.`id_company` = NULL 
            WHERE t1.`id_company` IS NOT NULL 
            AND t2.`id_company` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_vendor` t2 
            ON t1.`id_vendor` = t2.`id_vendor`
            SET t1.`id_vendor` = NULL 
            WHERE t1.`id_vendor` IS NOT NULL 
            AND t2.`id_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_invoice` t1
            LEFT JOIN `tbl_norek_vendor` t2 
            ON t1.`id_norek_vendor` = t2.`id_norek_vendor`
            SET t1.`id_norek_vendor` = NULL 
            WHERE t1.`id_norek_vendor` IS NOT NULL 
            AND t2.`id_norek_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_item_transactions` t1
            LEFT JOIN `tbl_sr` t2 
            ON t1.`id_sr` = t2.`id_sr`
            SET t1.`id_sr` = NULL 
            WHERE t1.`id_sr` IS NOT NULL 
            AND t2.`id_sr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_item_transactions` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_item_transactions` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_item_transactions` t1
            LEFT JOIN `tbl_vendor` t2 
            ON t1.`id_vendor` = t2.`id_vendor`
            SET t1.`id_vendor` = NULL 
            WHERE t1.`id_vendor` IS NOT NULL 
            AND t2.`id_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_packagings` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_payment` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_payment` t1
            LEFT JOIN `tbl_norek_vendor` t2 
            ON t1.`id_norek_vendor` = t2.`id_norek_vendor`
            SET t1.`id_norek_vendor` = NULL 
            WHERE t1.`id_norek_vendor` IS NOT NULL 
            AND t2.`id_norek_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_cost_types` t2 
            ON t1.`id_cost_type` = t2.`id_cost_type`
            SET t1.`id_cost_type` = NULL 
            WHERE t1.`id_cost_type` IS NOT NULL 
            AND t2.`id_cost_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_branch` t2 
            ON t1.`id_branch` = t2.`id_branch`
            SET t1.`id_branch` = NULL 
            WHERE t1.`id_branch` IS NOT NULL 
            AND t2.`id_branch` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_loans` t2 
            ON t1.`id_loan` = t2.`id_loan`
            SET t1.`id_loan` = NULL 
            WHERE t1.`id_loan` IS NOT NULL 
            AND t2.`id_loan` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_company` t2 
            ON t1.`id_company` = t2.`id_company`
            SET t1.`id_company` = NULL 
            WHERE t1.`id_company` IS NOT NULL 
            AND t2.`id_company` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_vendor` t2 
            ON t1.`id_vendor` = t2.`id_vendor`
            SET t1.`id_vendor` = NULL 
            WHERE t1.`id_vendor` IS NOT NULL 
            AND t2.`id_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_email_vendor` t2 
            ON t1.`id_email_vendor` = t2.`id_email_vendor`
            SET t1.`id_email_vendor` = NULL 
            WHERE t1.`id_email_vendor` IS NOT NULL 
            AND t2.`id_email_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_norek_vendor` t2 
            ON t1.`id_norek_vendor` = t2.`id_norek_vendor`
            SET t1.`id_norek_vendor` = NULL 
            WHERE t1.`id_norek_vendor` IS NOT NULL 
            AND t2.`id_norek_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_email_user` t2 
            ON t1.`id_email_user` = t2.`id_email_user`
            SET t1.`id_email_user` = NULL 
            WHERE t1.`id_email_user` IS NOT NULL 
            AND t2.`id_email_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_currency` t2 
            ON t1.`id_currency` = t2.`id_currency`
            SET t1.`id_currency` = NULL 
            WHERE t1.`id_currency` IS NOT NULL 
            AND t2.`id_currency` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_pr` t1
            LEFT JOIN `tbl_warehouse` t2 
            ON t1.`id_warehouse` = t2.`id_warehouse`
            SET t1.`id_warehouse` = NULL 
            WHERE t1.`id_warehouse` IS NOT NULL 
            AND t2.`id_warehouse` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sign_transaction` t1
            LEFT JOIN `tbl_pr` t2 
            ON t1.`id_pr` = t2.`id_pr`
            SET t1.`id_pr` = NULL 
            WHERE t1.`id_pr` IS NOT NULL 
            AND t2.`id_pr` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sign_transaction` t1
            LEFT JOIN `tbl_ikb` t2 
            ON t1.`id_ikb` = t2.`id_ikb`
            SET t1.`id_ikb` = NULL 
            WHERE t1.`id_ikb` IS NOT NULL 
            AND t2.`id_ikb` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_doc_types` t2 
            ON t1.`id_doc_type` = t2.`id_doc_type`
            SET t1.`id_doc_type` = NULL 
            WHERE t1.`id_doc_type` IS NOT NULL 
            AND t2.`id_doc_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_cost_types` t2 
            ON t1.`id_cost_type` = t2.`id_cost_type`
            SET t1.`id_cost_type` = NULL 
            WHERE t1.`id_cost_type` IS NOT NULL 
            AND t2.`id_cost_type` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_branch` t2 
            ON t1.`id_branch` = t2.`id_branch`
            SET t1.`id_branch` = NULL 
            WHERE t1.`id_branch` IS NOT NULL 
            AND t2.`id_branch` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_loans` t2 
            ON t1.`id_loan` = t2.`id_loan`
            SET t1.`id_loan` = NULL 
            WHERE t1.`id_loan` IS NOT NULL 
            AND t2.`id_loan` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_company` t2 
            ON t1.`id_company` = t2.`id_company`
            SET t1.`id_company` = NULL 
            WHERE t1.`id_company` IS NOT NULL 
            AND t2.`id_company` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_vendor` t2 
            ON t1.`id_vendor` = t2.`id_vendor`
            SET t1.`id_vendor` = NULL 
            WHERE t1.`id_vendor` IS NOT NULL 
            AND t2.`id_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_email_vendor` t2 
            ON t1.`id_email_vendor` = t2.`id_email_vendor`
            SET t1.`id_email_vendor` = NULL 
            WHERE t1.`id_email_vendor` IS NOT NULL 
            AND t2.`id_email_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_norek_vendor` t2 
            ON t1.`id_norek_vendor` = t2.`id_norek_vendor`
            SET t1.`id_norek_vendor` = NULL 
            WHERE t1.`id_norek_vendor` IS NOT NULL 
            AND t2.`id_norek_vendor` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_email_user` t2 
            ON t1.`id_email_user` = t2.`id_email_user`
            SET t1.`id_email_user` = NULL 
            WHERE t1.`id_email_user` IS NOT NULL 
            AND t2.`id_email_user` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_sr` t1
            LEFT JOIN `tbl_warehouse` t2 
            ON t1.`id_warehouse` = t2.`id_warehouse`
            SET t1.`id_warehouse` = NULL 
            WHERE t1.`id_warehouse` IS NOT NULL 
            AND t2.`id_warehouse` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_user` t1
            LEFT JOIN `tbl_branch` t2 
            ON t1.`id_branch` = t2.`id_branch`
            SET t1.`id_branch` = NULL 
            WHERE t1.`id_branch` IS NOT NULL 
            AND t2.`id_branch` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_user` t1
            LEFT JOIN `tbl_warehouse` t2 
            ON t1.`id_warehouse` = t2.`id_warehouse`
            SET t1.`id_warehouse` = NULL 
            WHERE t1.`id_warehouse` IS NOT NULL 
            AND t2.`id_warehouse` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_vendor` t1
            LEFT JOIN `tbl_departement` t2 
            ON t1.`id_departement` = t2.`id_departement`
            SET t1.`id_departement` = NULL 
            WHERE t1.`id_departement` IS NOT NULL 
            AND t2.`id_departement` IS NULL
        ");

        DB::statement("
            UPDATE `tbl_warehouse` t1
            LEFT JOIN `tbl_user` t2 
            ON t1.`id_user` = t2.`id_user`
            SET t1.`id_user` = NULL 
            WHERE t1.`id_user` IS NOT NULL 
            AND t2.`id_user` IS NULL
        ");

        
        Schema::enableForeignKeyConstraints();
    }
}
