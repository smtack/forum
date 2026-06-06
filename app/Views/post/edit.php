<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Edit Post</h2>

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

<form action="<?= site_url("/post/update/{$post['post_id']}") ?> ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <textarea name="post_text" placeholder="Post Text"><?= esc($post['post_text']) ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Update Post</button>
    </div>
</form>

<h3>Delete Post</h3>

<form action="<?= site_url("/post/delete/{$post['post_id']}") ?> ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <button type="submit">Delete Post</button>
    </div>
</form>

<?= $this->endSection('content') ?>