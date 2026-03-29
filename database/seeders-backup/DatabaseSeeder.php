<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable FK checks to allow legacy data with inconsistent FK references
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call([
            PermissionSeeder::class,

            // 1. Core Master Data (Independent or Local Dependencies)
            CompanySeeder::class,
            BranchSeeder::class,
            DepartementSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            UomSeeder::class,

            // 2. User & Auth
            UserSeeder::class,

            // 3. Financial & Support Master Data
            DocTypeSeeder::class,
            TaxTypeSeeder::class,
            TaxSeeder::class,
            CurrencySeeder::class,
            CostCategorySeeder::class,
            CostTypeSeeder::class,

            // 4. Configuration
            VerificationTypeSeeder::class,
            SignFlowSeeder::class,

            // 5. External Entities
            VendorSeeder::class,

            // 6. Details (Bank & Email)
            UserEmailSeeder::class,
            VendorEmailSeeder::class,
            UserBankAccountSeeder::class,
            VendorBankAccountSeeder::class,

            // 7. Legacy Tables
            LoanSeeder::class,
            InspectionSeeder::class,

            // 8. Transactions (Order Matters for FKs)
            PrSeeder::class,
            SrSeeder::class,
            PrDetailSeeder::class,
            SrDetailSeeder::class,

            // 9. Finance Transactions
            InvoiceSeeder::class,
            PaymentSeeder::class,

            // 10. System Logs & Signatures
            LogSeeder::class,
            SignTransactionSeeder::class,

            // 11. Attachments
            AttachmentSeeder::class,
            PrAttachmentSeeder::class,
            SrAttachmentSeeder::class,
            PaymentAttachmentSeeder::class,
        ]);

        // Re-enable FK checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
