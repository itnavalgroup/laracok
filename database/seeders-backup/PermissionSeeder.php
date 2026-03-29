<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // MASTER DATA
            ['name' => 'company.view', 'desc' => 'View Company List', 'module' => 'Company'],
            ['name' => 'company.create', 'desc' => 'Create Company', 'module' => 'Company'],
            ['name' => 'company.edit', 'desc' => 'Edit Company', 'module' => 'Company'],
            ['name' => 'company.delete', 'desc' => 'Delete Company', 'module' => 'Company'],
            
            ['name' => 'branch.view', 'desc' => 'View Branch List', 'module' => 'Branch'],
            ['name' => 'branch.create', 'desc' => 'Create Branch', 'module' => 'Branch'],
            ['name' => 'branch.edit', 'desc' => 'Edit Branch', 'module' => 'Branch'],
            ['name' => 'branch.delete', 'desc' => 'Delete Branch', 'module' => 'Branch'],

            ['name' => 'dept.view', 'desc' => 'View Department List', 'module' => 'Department'],
            ['name' => 'dept.create', 'desc' => 'Create Department', 'module' => 'Department'],
            ['name' => 'dept.edit', 'desc' => 'Edit Department', 'module' => 'Department'],
            ['name' => 'dept.delete', 'desc' => 'Delete Department', 'module' => 'Department'],

            ['name' => 'vendor.view', 'desc' => 'View Vendor List', 'module' => 'Vendor'],
            ['name' => 'vendor.create', 'desc' => 'Create Vendor', 'module' => 'Vendor'],
            ['name' => 'vendor.edit', 'desc' => 'Edit Vendor', 'module' => 'Vendor'],
            ['name' => 'vendor.delete', 'desc' => 'Delete Vendor', 'module' => 'Vendor'],
            ['name' => 'vendor.upload', 'desc' => 'Upload Vendor', 'module' => 'Vendor'],
            ['name' => 'vendor.download', 'desc' => 'Download Vendor', 'module' => 'Vendor'],
            
            ['name' => 'uom.view', 'desc' => 'View UOM List', 'module' => 'UOM'],
            ['name' => 'uom.create', 'desc' => 'Create UOM', 'module' => 'UOM'],
            ['name' => 'uom.edit', 'desc' => 'Edit UOM', 'module' => 'UOM'],
            ['name' => 'uom.delete', 'desc' => 'Delete UOM', 'module' => 'UOM'],

            ['name' => 'package.view', 'desc' => 'View Package List', 'module' => 'Package'],
            ['name' => 'package.create', 'desc' => 'Create Package', 'module' => 'Package'],
            ['name' => 'package.edit', 'desc' => 'Edit Package', 'module' => 'Package'],
            ['name' => 'package.delete', 'desc' => 'Delete Package', 'module' => 'Package'],
            
            ['name' => 'cost_type.view', 'desc' => 'View Cost Type List', 'module' => 'Cost Type'],
            ['name' => 'cost_type.create', 'desc' => 'Create Cost Type', 'module' => 'Cost Type'],
            ['name' => 'cost_type.edit', 'desc' => 'Edit Cost Type', 'module' => 'Cost Type'],
            ['name' => 'cost_type.delete', 'desc' => 'Delete Cost Type', 'module' => 'Cost Type'],

            ['name' => 'cost.view', 'desc' => 'View Cost List', 'module' => 'Cost'],
            ['name' => 'cost.create', 'desc' => 'Create Cost', 'module' => 'Cost'],
            ['name' => 'cost.edit', 'desc' => 'Edit Cost', 'module' => 'Cost'],
            ['name' => 'cost.delete', 'desc' => 'Delete Cost', 'module' => 'Cost'],

            ['name' => 'currency.view', 'desc' => 'View Currency List', 'module' => 'Currency'],
            ['name' => 'currency.create', 'desc' => 'Create Currency', 'module' => 'Currency'],
            ['name' => 'currency.edit', 'desc' => 'Edit Currency', 'module' => 'Currency'],
            ['name' => 'currency.delete', 'desc' => 'Delete Currency', 'module' => 'Currency'],
            
            ['name' => 'attachment.view', 'desc' => 'View Attachment List', 'module' => 'Attachment'],
            ['name' => 'attachment.create', 'desc' => 'Create Attachment', 'module' => 'Attachment'],
            ['name' => 'attachment.edit', 'desc' => 'Edit Attachment', 'module' => 'Attachment'],
            ['name' => 'attachment.delete', 'desc' => 'Delete Attachment', 'module' => 'Attachment'],
            
            ['name' => 'loan.view', 'desc' => 'View Loan List', 'module' => 'Loan'],
            ['name' => 'loan.create', 'desc' => 'Create Loan', 'module' => 'Loan'],
            ['name' => 'loan.edit', 'desc' => 'Edit Loan', 'module' => 'Loan'],
            ['name' => 'loan.delete', 'desc' => 'Delete Loan', 'module' => 'Loan'],

            ['name' => 'tax_type.view', 'desc' => 'View Tax Type List', 'module' => 'Tax Type'],
            ['name' => 'tax_type.create', 'desc' => 'Create Tax Type', 'module' => 'Tax Type'],
            ['name' => 'tax_type.edit', 'desc' => 'Edit Tax Type', 'module' => 'Tax Type'],
            ['name' => 'tax_type.delete', 'desc' => 'Delete Tax Type', 'module' => 'Tax Type'],

            ['name' => 'tax.view', 'desc' => 'View Tax List', 'module' => 'Tax'],
            ['name' => 'tax.create', 'desc' => 'Create Tax', 'module' => 'Tax'],
            ['name' => 'tax.edit', 'desc' => 'Edit Tax', 'module' => 'Tax'],
            ['name' => 'tax.delete', 'desc' => 'Delete Tax', 'module' => 'Tax'],

            ['name' => 'position.view', 'desc' => 'View Position List', 'module' => 'Position'],
            ['name' => 'position.create', 'desc' => 'Create Position', 'module' => 'Position'],
            ['name' => 'position.edit', 'desc' => 'Edit Position', 'module' => 'Position'],
            ['name' => 'position.delete', 'desc' => 'Delete Position', 'module' => 'Position'],

            ['name' => 'item_category.view', 'desc' => 'View Item Category List', 'module' => 'Item Category'],
            ['name' => 'item_category.create', 'desc' => 'Create Item Category', 'module' => 'Item Category'],
            ['name' => 'item_category.edit', 'desc' => 'Edit Item Category', 'module' => 'Item Category'],
            ['name' => 'item_category.delete', 'desc' => 'Delete Item Category', 'module' => 'Item Category'],

            ['name' => 'item.view', 'desc' => 'View Item List', 'module' => 'Item'],
            ['name' => 'item.create', 'desc' => 'Create Item', 'module' => 'Item'],
            ['name' => 'item.edit', 'desc' => 'Edit Item', 'module' => 'Item'],
            ['name' => 'item.delete', 'desc' => 'Delete Item', 'module' => 'Item'],

            ['name' => 'doc_type.view', 'desc' => 'View Document Type List', 'module' => 'Document Type'],
            ['name' => 'doc_type.create', 'desc' => 'Create Document Type', 'module' => 'Document Type'],
            ['name' => 'doc_type.edit', 'desc' => 'Edit Document Type', 'module' => 'Document Type'],
            ['name' => 'doc_type.delete', 'desc' => 'Delete Document Type', 'module' => 'Document Type'],

            ['name' => 'dashboard.view', 'desc' => 'View Dashboard', 'module' => 'Dashboard'],
            ['name' => 'dashboard.view.dept', 'desc' => 'View Dept Dashboard', 'module' => 'Dashboard'],
            ['name' => 'dashboard.view.subordinate', 'desc' => 'View User Dashboard', 'module' => 'Dashboard'],

            // PR
            ['name' => 'pr.view.all', 'desc' => 'View PR List', 'module' => 'PR'],
            ['name' => 'pr.view.dept', 'desc' => 'View PR Dept List', 'module' => 'PR'],
            ['name' => 'pr.view.subordinate', 'desc' => 'View PR Subordinate List', 'module' => 'PR'],
            ['name' => 'pr.create', 'desc' => 'Create New PR', 'module' => 'PR'],
            ['name' => 'pr.edit', 'desc' => 'Edit Draft PR', 'module' => 'PR'],
            ['name' => 'pr.delete', 'desc' => 'Delete Draft PR', 'module' => 'PR'],
            ['name' => 'pr.print', 'desc' => 'Print PR', 'module' => 'PR'],
            
            ['name' => 'pr_detail.view', 'desc' => 'View PR Detail List', 'module' => 'PR'],
            ['name' => 'pr_detail.create', 'desc' => 'Create New PR Detail', 'module' => 'PR'],
            ['name' => 'pr_detail.edit', 'desc' => 'Edit Draft PR Detail', 'module' => 'PR'],
            ['name' => 'pr_detail.delete', 'desc' => 'Delete Draft PR Detail', 'module' => 'PR'],
            ['name' => 'pr_detail.print', 'desc' => 'Print PR Detail', 'module' => 'PR'],
            ['name' => 'pr_detail.download', 'desc' => 'Download PR Detail', 'module' => 'PR'],

            ['name' => 'pr_attachment.view', 'desc' => 'View PR Attachment List', 'module' => 'PR'],
            ['name' => 'pr_attachment.create', 'desc' => 'Create New PR Attachment', 'module' => 'PR'],
            ['name' => 'pr_attachment.edit', 'desc' => 'Edit Draft PR Attachment', 'module' => 'PR'],
            ['name' => 'pr_attachment.delete', 'desc' => 'Delete Draft PR Attachment', 'module' => 'PR'],
            ['name' => 'pr_attachment.download', 'desc' => 'Download PR Attachment', 'module' => 'PR'],

            ['name' => 'pr_payment.view', 'desc' => 'View PR Payment List', 'module' => 'PR'],
            ['name' => 'pr_payment.create', 'desc' => 'Create New PR Payment', 'module' => 'PR'],
            ['name' => 'pr_payment.edit', 'desc' => 'Edit Draft PR Payment', 'module' => 'PR'],
            ['name' => 'pr_payment.delete', 'desc' => 'Delete Draft PR Payment', 'module' => 'PR'],
            ['name' => 'pr_payment.print', 'desc' => 'Print PR Payment', 'module' => 'PR'],
            ['name' => 'pr_payment.download', 'desc' => 'Download PR Payment', 'module' => 'PR'],

            ['name' => 'pr_payment.approve.step1', 'desc' => 'Approve PR Payment (SPV/Manager)', 'module' => 'PR'],
            ['name' => 'pr_payment.cancel_approve.step1', 'desc' => 'Cancel Approve PR Payment (SPV/Manager)', 'module' => 'PR'],
            ['name' => 'pr_payment.approve.step2', 'desc' => 'Approve PR Payment (Director)', 'module' => 'PR'],
            ['name' => 'pr_payment.cancel_approve.step2', 'desc' => 'Cancel Approve PR Payment (Director)', 'module' => 'PR'],
            ['name' => 'pr_payment.revision', 'desc' => 'Revision PR Payment', 'module' => 'PR'],

            ['name' => 'pr_invoice.view', 'desc' => 'View PR Invoice List', 'module' => 'PR'],
            ['name' => 'pr_invoice.create', 'desc' => 'Create New PR Invoice', 'module' => 'PR'],
            ['name' => 'pr_invoice.edit', 'desc' => 'Edit Draft PR Invoice', 'module' => 'PR'],
            ['name' => 'pr_invoice.delete', 'desc' => 'Delete Draft PR Invoice', 'module' => 'PR'],
            ['name' => 'pr_invoice.print', 'desc' => 'Print PR Invoice', 'module' => 'PR'],
            ['name' => 'pr_invoice.download', 'desc' => 'Download PR Invoice', 'module' => 'PR'],

            // PR Approval Workflow
            ['name' => 'pr.submit', 'desc' => 'Submit PR', 'module' => 'PR'],
            ['name' => 'pr.cancel_submit', 'desc' => 'Cancel Submit PR', 'module' => 'PR'],
            ['name' => 'pr.approve.step1', 'desc' => 'Approve PR Step 1 (SPV/Manager)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step1', 'desc' => 'Cancel Approve PR Step 1 (SPV/Manager)', 'module' => 'PR'],
            ['name' => 'pr.approve.step2', 'desc' => 'Approve PR Step 2 (Director)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step2', 'desc' => 'Cancel Approve PR Step 2 (Director)', 'module' => 'PR'],
            ['name' => 'pr.approve.step3', 'desc' => 'Approve PR Step 3 (Accounting)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step3', 'desc' => 'Cancel Approve PR Step 3 (Accounting)', 'module' => 'PR'],
            ['name' => 'pr.approve.step4', 'desc' => 'Approve PR Step 4 (Finance Staff)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step4', 'desc' => 'Cancel Approve PR Step 4 (Finance Staff)', 'module' => 'PR'],
            ['name' => 'pr.approve.step5', 'desc' => 'Approve PR Step 5 (Finance SPV)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step5', 'desc' => 'Cancel Approve PR Step 5 (Finance SPV)', 'module' => 'PR'],
            ['name' => 'pr.approve.step6', 'desc' => 'Approve PR Step 6 (CFO)', 'module' => 'PR'],
            ['name' => 'pr.cancel_approve.step6', 'desc' => 'Cancel Approve PR Step 6 (CFO)', 'module' => 'PR'],
            ['name' => 'pr.reject', 'desc' => 'Reject PR', 'module' => 'PR'],
            ['name' => 'pr.revision', 'desc' => 'Revision PR', 'module' => 'PR'],

            // SR
            ['name' => 'sr.view.all', 'desc' => 'View SR List', 'module' => 'SR'],
            ['name' => 'sr.view.dept', 'desc' => 'View SR Dept List', 'module' => 'SR'],
            ['name' => 'sr.view.subordinate', 'desc' => 'View SR Subordinate List', 'module' => 'SR'],
            ['name' => 'sr.create', 'desc' => 'Create New SR', 'module' => 'SR'],
            ['name' => 'sr.edit', 'desc' => 'Edit Draft SR', 'module' => 'SR'],
            ['name' => 'sr.delete', 'desc' => 'Delete Draft SR', 'module' => 'SR'],
            ['name' => 'sr.print', 'desc' => 'Print SR', 'module' => 'SR'],
            ['name' => 'sr.download', 'desc' => 'Download SR', 'module' => 'SR'],

            ['name' => 'sr_detail.view', 'desc' => 'View SR Detail List', 'module' => 'SR'],
            ['name' => 'sr_detail.create', 'desc' => 'Create New SR Detail', 'module' => 'SR'],
            ['name' => 'sr_detail.edit', 'desc' => 'Edit Draft SR Detail', 'module' => 'SR'],
            ['name' => 'sr_detail.delete', 'desc' => 'Delete Draft SR Detail', 'module' => 'SR'],
            ['name' => 'sr_detail.print', 'desc' => 'Print SR Detail', 'module' => 'SR'],
            ['name' => 'sr_detail.download', 'desc' => 'Download SR Detail', 'module' => 'SR'],

            ['name' => 'sr_attachment.view', 'desc' => 'View SR Attachment List', 'module' => 'SR'],
            ['name' => 'sr_attachment.create', 'desc' => 'Create New SR Attachment', 'module' => 'SR'],
            ['name' => 'sr_attachment.edit', 'desc' => 'Edit Draft SR Attachment', 'module' => 'SR'],
            ['name' => 'sr_attachment.delete', 'desc' => 'Delete Draft SR Attachment', 'module' => 'SR'],
            ['name' => 'sr_attachment.download', 'desc' => 'Download SR Attachment', 'module' => 'SR'],

            ['name' => 'sr_payment.view', 'desc' => 'View SR Payment List', 'module' => 'SR'],
            ['name' => 'sr_payment.create', 'desc' => 'Create New SR Payment', 'module' => 'SR'],
            ['name' => 'sr_payment.edit', 'desc' => 'Edit Draft SR Payment', 'module' => 'SR'],
            ['name' => 'sr_payment.delete', 'desc' => 'Delete Draft SR Payment', 'module' => 'SR'],
            ['name' => 'sr_payment.print', 'desc' => 'Print SR Payment', 'module' => 'SR'],
            ['name' => 'sr_payment.download', 'desc' => 'Download SR Payment', 'module' => 'SR'],
            ['name' => 'sr_payment.approve.step1', 'desc' => 'Approve SR Payment (SPV/Manager)', 'module' => 'SR'],
            ['name' => 'sr_payment.cancel_approve.step1', 'desc' => 'Cancel Approve SR Payment (SPV/Manager)', 'module' => 'SR'],
            ['name' => 'sr_payment.approve.step2', 'desc' => 'Approve SR Payment (Director)', 'module' => 'SR'],
            ['name' => 'sr_payment.cancel_approve.step2', 'desc' => 'Cancel Approve SR Payment (Director)', 'module' => 'SR'],
            ['name' => 'sr_payment.revision', 'desc' => 'Revision SR Payment', 'module' => 'SR'],

            // SR Approval Workflow (6 Steps)
            ['name' => 'sr.submit', 'desc' => 'Submit SR', 'module' => 'SR'],
            ['name' => 'sr.cancel_submit', 'desc' => 'Cancel Submit SR', 'module' => 'SR'],
            ['name' => 'sr.approve.step1', 'desc' => 'Approve SR Step 1 (SPV/Manager)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step1', 'desc' => 'Cancel Approve SR Step 1 (SPV/Manager)', 'module' => 'SR'],
            ['name' => 'sr.approve.step2', 'desc' => 'Approve SR Step 2 (Director)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step2', 'desc' => 'Cancel Approve SR Step 2 (Director)', 'module' => 'SR'],
            ['name' => 'sr.approve.step3', 'desc' => 'Approve SR Step 3 (Accounting)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step3', 'desc' => 'Cancel Approve SR Step 3 (Accounting)', 'module' => 'SR'],
            ['name' => 'sr.approve.step4', 'desc' => 'Approve SR Step 4 (Finance Staff)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step4', 'desc' => 'Cancel Approve SR Step 4 (Finance Staff)', 'module' => 'SR'],
            ['name' => 'sr.approve.step5', 'desc' => 'Approve SR Step 5 (Finance SPV)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step5', 'desc' => 'Cancel Approve SR Step 5 (Finance SPV)', 'module' => 'SR'],
            ['name' => 'sr.approve.step6', 'desc' => 'Approve SR Step 6 (CFO)', 'module' => 'SR'],
            ['name' => 'sr.cancel_approve.step6', 'desc' => 'Cancel Approve SR Step 6 (CFO)', 'module' => 'SR'],
            ['name' => 'sr.reject', 'desc' => 'Reject SR', 'module' => 'SR'],
            ['name' => 'sr.revision', 'desc' => 'Revision SR', 'module' => 'SR'],

            // Item Transaction
            ['name' => 'item_transaction.view.all', 'desc' => 'View Item Transaction All List', 'module' => 'Item Transaction'],
            ['name' => 'item_transaction.view.user', 'desc' => 'View Item Transaction User List', 'module' => 'Item Transaction'],
            ['name' => 'item_transaction.create', 'desc' => 'Create New Item Transaction', 'module' => 'Item Transaction'],
            ['name' => 'item_transaction.edit', 'desc' => 'Edit Draft Item Transaction', 'module' => 'Item Transaction'],
            ['name' => 'item_transaction.delete', 'desc' => 'Delete Draft Item Transaction', 'module' => 'Item Transaction'],

            // Warehouse
            ['name' => 'warehouse.view', 'desc' => 'View Warehouse List', 'module' => 'Warehouse'],
            ['name' => 'warehouse.create', 'desc' => 'Create Warehouse', 'module' => 'Warehouse'],
            ['name' => 'warehouse.edit', 'desc' => 'Edit Warehouse', 'module' => 'Warehouse'],
            ['name' => 'warehouse.delete', 'desc' => 'Delete Warehouse', 'module' => 'Warehouse'],

            // IKB (Inventory)
            ['name' => 'ikb.view.all', 'desc' => 'View IKB List', 'module' => 'IKB'],
            ['name' => 'ikb.view.dept', 'desc' => 'View IKB Dept List', 'module' => 'IKB'],
            ['name' => 'ikb.view.subordinate', 'desc' => 'View IKB Subordinate List', 'module' => 'IKB'],
            ['name' => 'ikb.create', 'desc' => 'Create New IKB', 'module' => 'IKB'],
            ['name' => 'ikb.edit', 'desc' => 'Edit Draft IKB', 'module' => 'IKB'],
            ['name' => 'ikb.delete', 'desc' => 'Delete Draft IKB', 'module' => 'IKB'],
            ['name' => 'ikb.print', 'desc' => 'Print IKB', 'module' => 'IKB'],
            ['name' => 'ikb.download', 'desc' => 'Download IKB', 'module' => 'IKB'],
            
            ['name' => 'ikb_detail.view', 'desc' => 'View IKB Detail List', 'module' => 'IKB'],
            ['name' => 'ikb_detail.create', 'desc' => 'Create New IKB Detail', 'module' => 'IKB'],
            ['name' => 'ikb_detail.edit', 'desc' => 'Edit Draft IKB Detail', 'module' => 'IKB'],
            ['name' => 'ikb_detail.delete', 'desc' => 'Delete Draft IKB Detail', 'module' => 'IKB'],
            ['name' => 'ikb_detail.print', 'desc' => 'Print IKB Detail', 'module' => 'IKB'],
            ['name' => 'ikb_detail.download', 'desc' => 'Download IKB Detail', 'module' => 'IKB'],

            // IKB Approval Workflow (10 Steps)
            ['name' => 'ikb.submit', 'desc' => 'Submit IKB', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_submit', 'desc' => 'Cancel Submit IKB', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step1', 'desc' => 'Approve IKB Step 1 (SPV/Manager)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step1', 'desc' => 'Cancel Approve IKB Step 1 (SPV/Manager)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step2', 'desc' => 'Approve IKB Step 2 (Director Log)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step2', 'desc' => 'Cancel Approve IKB Step 2 (Director Log)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step3', 'desc' => 'Approve IKB Step 3 (PPIC)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step3', 'desc' => 'Cancel Approve IKB Step 3 (PPIC)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step4', 'desc' => 'Approve IKB Step 4 (Inventory Control)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step4', 'desc' => 'Cancel Approve IKB Step 4 (Inventory Control)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step5', 'desc' => 'Approve IKB Step 5 (Logistic Coord)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step5', 'desc' => 'Cancel Approve IKB Step 5 (Logistic Coord)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step6', 'desc' => 'Approve IKB Step 6 (Warehouse Staff)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step6', 'desc' => 'Cancel Approve IKB Step 6 (Warehouse Staff)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step7', 'desc' => 'Approve IKB Step 7 (Warehouse SPV)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step7', 'desc' => 'Cancel Approve IKB Step 7 (Warehouse SPV)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step8', 'desc' => 'Approve IKB Step 8 (Security Officer)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step8', 'desc' => 'Cancel Approve IKB Step 8 (Security Officer)', 'module' => 'IKB'],
            ['name' => 'ikb.approve.step9', 'desc' => 'Approve IKB Step 9 (Logistic Coord Final)', 'module' => 'IKB'],
            ['name' => 'ikb.cancel_approve.step9', 'desc' => 'Cancel Approve IKB Step 9 (Logistic Coord Final)', 'module' => 'IKB'],
            ['name' => 'ikb.reject', 'desc' => 'Reject IKB', 'module' => 'IKB'],
            ['name' => 'ikb.revision', 'desc' => 'Revision IKB', 'module' => 'IKB'],

            // USER MANAGEMENT
            ['name' => 'user.view.all', 'desc' => 'View User List', 'module' => 'User'],
            ['name' => 'user.view.dept', 'desc' => 'View User Dept List', 'module' => 'User'],
            ['name' => 'user.view.subordinate', 'desc' => 'View User Subordinate List', 'module' => 'User'],
            ['name' => 'user.create', 'desc' => 'Create User', 'module' => 'User'],
            ['name' => 'user.edit', 'desc' => 'Edit User', 'module' => 'User'],
            ['name' => 'user.delete', 'desc' => 'Delete User', 'module' => 'User'],
            ['name' => 'user.reset_password', 'desc' => 'Reset Password User', 'module' => 'User'],
            ['name' => 'user.change_password', 'desc' => 'Change Password User', 'module' => 'User'],
            ['name' => 'user.permissions', 'desc' => 'Manage User Permissions', 'module' => 'User'],
        ];

        foreach ($permissions as $perm) {
            \App\Models\Permission::firstOrCreate(
                ['permission_name' => $perm['name']],

                [
                    'permission_description' => $perm['desc'],
                    'module' => $perm['module']
                ]
            );
        }
    }
}
