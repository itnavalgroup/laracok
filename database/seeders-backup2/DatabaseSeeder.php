<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TblAttachmentSeeder::class);
        $this->call(TblAttachmentPaymentSeeder::class);
        $this->call(TblAttachmentPrSeeder::class);
        $this->call(TblAttachmentSrSeeder::class);
        $this->call(TblBranchSeeder::class);
        $this->call(TblCompanySeeder::class);
        $this->call(TblContractSeeder::class);
        $this->call(TblCostCategoriesSeeder::class);
        $this->call(TblCostTypesSeeder::class);
        $this->call(TblCurrencySeeder::class);
        $this->call(TblDepartementSeeder::class);
        $this->call(TblDetailPrSeeder::class);
        $this->call(TblDetailSrSeeder::class);
        $this->call(TblDocTypesSeeder::class);
        $this->call(TblEmailUserSeeder::class);
        $this->call(TblEmailVendorSeeder::class);
        $this->call(TblIkbTransactionTypesSeeder::class);
        $this->call(TblInvoiceSeeder::class);
        $this->call(TblItemsSeeder::class);
        $this->call(TblItemCategoriesSeeder::class);
        $this->call(TblItemTransactionsSeeder::class);
        $this->call(TblLevelsSeeder::class);
        $this->call(TblLoansSeeder::class);
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
        $this->call(TblUserSeeder::class);
        $this->call(TblUserPermissionsSeeder::class);
        $this->call(TblVendorSeeder::class);
        $this->call(TblWarehouseSeeder::class);
    }
}
