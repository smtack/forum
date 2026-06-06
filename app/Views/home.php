<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<table border="1">
    <tr>
        <th>Category</th>
        <th>Last Topic</th>
    </tr>
    <?php if(!isset($categories)): ?>
        <tr>
            <td colspan="2">
                <p class="error">No categories</p>
            </td>
        </tr>
    <?php endif; ?>
    <?php foreach($categories as $category): ?>    
        <tr>
            <td>
                <h2><a href="<?= base_url("/category/") . esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></a></h2>
                <p><?= esc($category['category_description']) ?></p>
            </td>
            <td width="400px">
                <?php if (empty($category['last_topic_id'])): ?>
                    <p>No topics</p>
                <?php else: ?>
                    <p><a href="<?= base_url('/topic/show/') . esc($category['last_topic_id'])?>"><?= esc($category['last_topic_title']) ?></a> on <?= esc(date('l j F Y H:i:s', strtotime($category['last_topic_created_at']))) ?></p>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection('content') ?>