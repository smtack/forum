<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Update Profile</h2>

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

<form action="<?= site_url('user/update-profile') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <input type="text" name="user_username" placeholder="Username" value="<?= esc($user['user_username']) ?>" disabled="disabled">
    </div>
    <div class="form-group">
        <input type="text" name="user_email" placeholdr="Email" value="<?= esc($user['user_email']) ?>">
    </div>
    <div class="form-group">
        <button type="submit">Update Profile</button>
    </div>
</form>

<h3>Update Profile Picture</h3>

<form enctype="multipart/form-data" action="<?= site_url('user/update-avatar') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <input type="file" name="avatar">
    </div>
    <div class="form-group">
        <button type="submit">Update Avatar</button>
    </div>
</form>

<h3>Update Password</h3>

<form action="<?= site_url('user/update-password') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <input type="password" name="current_password" placeholder="Current Password">
    </div>
    <div class="form-group">
        <input type="password" name="new_password" placeholder="New Password">
    </div>
    <div class="form-group">
        <input type="password" name="confirm_new_password" placeholder="Confirm New Password">
    </div>
    <div class="form-group">
        <button type="submit">Update Password</button>
    </div>
</form>

<h3>Delete Profile</h3>

<form action="<?= site_url('user/delete-profile') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <button type="submit">Delete Profile</button>
    </div>
</form>

<?= $this->endSection('content') ?>