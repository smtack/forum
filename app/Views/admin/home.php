<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="content">
    <table border="1">
        <tr>
            <th>Options</th>
        </tr>
        <tr>
            <td>
                <p><a href="<?= base_url('admin/users') ?>">Users</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p><a href="<?= base_url('admin/category') ?>">Categories</a></p>
            </td>
        </tr>
    </table>
</div>

<?= $this->endSection('content') ?>