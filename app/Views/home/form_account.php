<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 850px;">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><?= esc($title) ?></h2>

                <a href="<?= site_url('accounts') ?>" class="btn btn-secondary">
                    Back
                </a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= esc($action) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Account Number</label>
                        <input type="text"
                               name="account_number"
                               class="form-control"
                               value="<?= esc($account['account_number'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text"
                               name="customer_name"
                               class="form-control"
                               value="<?= esc($account['customer_name'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="2"
                                  required><?= esc($account['address'] ?? '') ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?= esc($account['phone'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?= esc($account['email'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meter Number</label>
                        <input type="text"
                               name="meter_number"
                               class="form-control"
                               value="<?= esc($account['meter_number'] ?? '') ?>"
                               required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Connection Type</label>
                        <select name="connection_type" class="form-select" required>
                            <option value="residential"
                                <?= (($account['connection_type'] ?? '') === 'residential') ? 'selected' : '' ?>>
                                Residential
                            </option>

                            <option value="commercial"
                                <?= (($account['connection_type'] ?? '') === 'commercial') ? 'selected' : '' ?>>
                                Commercial
                            </option>

                            <option value="industrial"
                                <?= (($account['connection_type'] ?? '') === 'industrial') ? 'selected' : '' ?>>
                                Industrial
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active"
                                <?= (($account['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>
                                Active
                            </option>

                            <option value="inactive"
                                <?= (($account['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>
                                Inactive
                            </option>

                            <option value="suspended"
                                <?= (($account['status'] ?? '') === 'suspended') ? 'selected' : '' ?>>
                                Suspended
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Save Account
                    </button>

                    <a href="<?= site_url('accounts') ?>"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>