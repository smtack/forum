<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="category-description">
    <h3>Topics in <?= esc($category['category_name']) ?></h3>
    <p><?= esc($category['category_description']) ?></p>
</div>

<table border="1">
    <tr>
        <th>Topic</th>
        <th>Created at</th>
    </tr>
    <?php if(!$topics): ?>
        <tr>
            <td colspan="3">
                <p class="error">No topics</p>
            </td>
        </tr>
    <?php else: ?>
        <?php foreach($topics as $topic): ?>
            <tr>
                <td>
                    <h2><a href="<?= base_url('/topic/show/') . esc($topic['topic_id']) ?>"><?= esc($topic['topic_title']) ?></a></h2>
                </td>
                <td width="200px">
                    <p><?= esc(date('l j F Y H:i:s', strtotime($topic['created_at']))) ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?= $this->endSection('content') ?>