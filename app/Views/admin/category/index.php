<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h3>Categories</h3>

<h5><a href="<?= base_url('admin/category/new') ?>">Create Category</a></h5>

<table border="1">
    <tr>
        <th>Category Info</th>
    </tr>
    <?php if(!$categories): ?>
        <tr>
            <td colspan="3">
                <p class="error">No Categories</p>
            </td>
        </tr>
    <?php else: ?>
        <?php foreach($categories as $category): ?>
            <tr>
                <td>
                    <h2><?= esc($category['category_name']) ?></a></h2>
                    <p>Description: <?= esc($category['category_description'])?></p>

                    <div class="options">
                        <h4>Admin Options:</h3>
                        <ul>
                            <li><a href="<?= base_url("admin/category/edit/{$category['category_id']}") ?>">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?= $this->endSection('content') ?>