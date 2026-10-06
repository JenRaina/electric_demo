<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .page-container {
        max-width: 900px;
        margin: 40px auto;
    }
    .card-custom {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: none;
        padding: 30px;
    }
    .info-header {
        background-color: #0d6efd;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
    }
    .info-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px 16px;
    }
    .badge-status-active { background-color: #198754; }
    .badge-status-inactive { background-color: #dc3545; }
    .badge-status-suspended { background-color: #ffc107; color: #000; }
</style>

<div class="container page-container">
    <div class="card card-custom">
        <!-- Brand Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #4a6cf7;">
                <i class="fa-solid fa-bolt text-warning me-2"></i>Puihaha Electric Company
            </h2>
            <p class="text-muted">Customer Account Details</p>
        </div>

        <!-- Top Back Button -->
        <div class="mb-3">
            <a href="<?= base_url('accounts') ?>" class="btn btn-sm btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
            </a>

            <a href="<?= base_url('accounts/edit/' . $account['id']) ?>"
            class="btn btn-sm btn-warning">
                <i class="fa-solid fa-pen-to-square me-1"></i>
                Edit Account
            </a>
        </div>

        <!-- Account Info Section Banner -->
        <div class="info-header mb-3">
            <i class="fa-regular fa-user me-2"></i> Account Information
        </div>

        <!-- Details Grid -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Account Number</small>
                    <span class="fw-bold"><?= esc($account['account_number'] ?? $account['account_no'] ?? 'EC-2024-' . str_pad($account['id'], 4, '0', STR_PAD_LEFT)) ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Status</small>
                    <?php 
                        $status = strtolower($account['status'] ?? 'active');
                        $statusClass = match($status) {
                            'inactive' => 'badge-status-inactive',
                            'suspended' => 'badge-status-suspended',
                            default => 'badge-status-active'
                        };
                    ?>
                    <span class="badge <?= $statusClass ?>"><?= ucfirst($status) ?></span>
                </div>
            </div>

            <div class="col-12">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Customer Name</small>
                    <span class="fw-bold"><?= esc(($account['first_name'] ?? '') . ' ' . ($account['last_name'] ?? $account['customer_name'] ?? 'N/A')) ?></span>
                </div>
            </div>

            <div class="col-12">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Address</small>
                    <span><?= esc($account['address'] ?? 'N/A') ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Phone</small>
                    <span><i class="fa-solid fa-phone me-1 text-primary"></i> <?= esc($account['phone'] ?? 'N/A') ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Email</small>
                    <span><i class="fa-solid fa-envelope me-1 text-primary"></i> <?= esc($account['email'] ?? 'N/A') ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Meter Number</small>
                    <span><?= esc($account['meter_number'] ?? 'MTR-' . str_pad($account['id'], 3, '0', STR_PAD_LEFT)) ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Connection Type</small>
                    <span class="badge bg-info text-white"><?= ucfirst(esc($account['connection_type'] ?? $account['type'] ?? 'Residential')) ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Created At</small>
                    <small><?= esc($account['created_at'] ?? 'N/A') ?></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <small class="text-muted d-block mb-1">Last Updated</small>
                    <small><?= esc($account['updated_at'] ?? 'N/A') ?></small>
                </div>
            </div>
        </div>

        <!-- Bottom Action Button -->
        <div class="text-center">
            <a href="<?= base_url('accounts') ?>" class="btn btn-primary px-4">
                <i class="fa-solid fa-house me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>