<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Sign Up</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= site_url('signup') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <input type="text" name="user_username" placeholder="Username" value="<?= old('user_username') ?>" required>
    </div>
    <div class="form-group">
        <input type="text" name="user_email" placeholder="Email" value="<?= old('user_email') ?>" required>
    </div>
    <div class="form-group">
        <input type="password" name="user_password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="password" name="user_password_confirm" placeholder="Confirm Password" required>
    </div>
    <div class="form-group">
        <button type="submit">Sign Up</button>
    </div>
    <div class="form-group">
        <p>Already have an account? <a href="<?= base_url('/login') ?>">Log In</a></p>
    </div>
</form>

<?= $this->endSection('content') ?>