<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Create Topic</h2>

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

<form action="<?= site_url('topic/create') ?>" method="post">
    <?= csrf_field() ?>

     <div class="form-group">
        <input type="text" name="topic_title" placeholder="Topic Title" value="<?= old('topic_title') ?>">
    </div>
    <div class="form-group">
        <select name="topic_category">
            <?php foreach($categories as $category): ?>
                <option value="<?= esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <textarea name="post_text" placeholder="Post"></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Create Topic</button>
    </div>
</form>

<?= $this->endSection('content') ?>