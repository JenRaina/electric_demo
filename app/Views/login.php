<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .login-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
    }
    .login-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
        padding: 40px;
        max-width: 440px;
        width: 100%;
    }
    .brand-icon {
        font-size: 2.5rem;
        color: #ffc107;
    }
    .btn-orange {
        background-color: #f09300;
        border-color: #f09300;
        color: #ffffff;
        font-weight: 600;
        border-radius: 25px;
        padding: 12px;
        transition: all 0.3s ease;
    }
    .btn-orange:hover {
        background-color: #d88300;
        border-color: #d88300;
        color: #ffffff;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px 14px;
    }
</style>

<div class="container login-wrapper">
    <div class="login-card text-center">
        <!-- Lightning Icon -->
        <div class="mb-3">
            <i class="fa-solid fa-bolt brand-icon"></i>
        </div>

        <!-- Title -->
        <h3 class="fw-bold mb-1" style="color: #2b50d8;">Dashboard Login</h3>
        <p class="text-muted small mb-4">Enter any username and password.</p>

        <!-- Form -->
        <form action="<?= site_url('login/authenticate') ?>" method="post" class="text-start">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    placeholder="Enter your email"
                    value="<?= esc(old('username')) ?>"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required>
            </div>

            <button type="submit" class="btn btn-orange w-100 mb-3">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Login
            </button>
        </form>

        <a href="<?= base_url() ?>" class="text-decoration-underline small text-primary">Return to Home</a>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-start">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>