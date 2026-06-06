<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h3>Edit Category</h3>

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

<form action="<?= site_url("admin/category/update/{$category['category_id']}") ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="form-group">
        <input type="text" name="category_name" placeholder="Category Name" value="<?= $category['category_name'] ?>">
    </div>
    <div class="form-group">
        <textarea name="category_description" placeholder="Category Description"><?= $category['category_description'] ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit">Update Category</button>
    </div>
</form>

<h4>Delete Category</h4>

<form action="<?= site_url("admin/category/delete/{$category['category_id']}") ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="form-group">
        <button type="submit">Delete Category</button>
    </div>
</form>

<?= $this->endSection('content') ?>