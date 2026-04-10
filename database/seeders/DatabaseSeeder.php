<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable FK checks so truncate works regardless of order
        Schema::disableForeignKeyConstraints();

        $this->call(TblCompanySeeder::class);
        $this->call(TblBranchSeeder::class);
        $this->call(TblDepartementSeeder::class);
        $this->call(TblPositionSeeder::class);
        $this->call(TblLevelsSeeder::class);
        $this->call(TblCurrencySeeder::class);
        $this->call(TblUomsSeeder::class);
        $this->call(TblPackagingsSeeder::class);
        $this->call(TblTaxTypesSeeder::class);
        $this->call(TblTaxSeeder::class);
        $this->call(TblDocTypesSeeder::class);
        $this->call(TblCostCategoriesSeeder::class);
        $this->call(TblCostTypesSeeder::class);
        $this->call(TblItemCategoriesSeeder::class);
        $this->call(TblItemsSeeder::class);
        $this->call(TblIkbTransactionTypesSeeder::class);
        $this->call(TblPermissionsSeeder::class);
        $this->call(TblUserSeeder::class);
        $this->call(TblUserPermissionsSeeder::class);
        $this->call(TblEmailUserSeeder::class);
        $this->call(TblNorekUserSeeder::class);
        $this->call(TblVendorSeeder::class);
        $this->call(TblEmailVendorSeeder::class);
        $this->call(TblNorekVendorSeeder::class);
        $this->call(TblWarehouseSeeder::class);
        $this->call(TblAttachmentSeeder::class);
        $this->call(TblLoansSeeder::class);
        $this->call(TblContractSeeder::class);
        $this->call(TblIkbSeeder::class);
        $this->call(TblIkbDetailsSeeder::class);
        $this->call(TblAttachmentIkbSeeder::class);
        $this->call(TblItemTransactionsSeeder::class);
        $this->call(TblPrSeeder::class);
        $this->call(TblDetailPrSeeder::class);
        $this->call(TblAttachmentPrSeeder::class);
        $this->call(TblSrSeeder::class);
        $this->call(TblDetailSrSeeder::class);
        $this->call(TblAttachmentSrSeeder::class);
        $this->call(TblPaymentSeeder::class);
        $this->call(TblAttachmentPaymentSeeder::class);
        $this->call(TblInvoiceSeeder::class);
        $this->call(TblSignTransactionSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
