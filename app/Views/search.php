<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Search</h2>

<form action="<?= site_url('search') ?>" method="get">
    <div class="form-group">
        <input type="text" name="s" placeholder="Search">
    </div>
    <div class="form-group">
        <button type="submit">Search</button>
    </div>
</form>

<?php if(isset($_GET['s'])): ?>
    <table border="1">
        <tr>
            <th>Topic</th>
            <th>Created at</th>
        </tr>
        <?php if(!isset($results) || !$results): ?>
            <tr>
                <td colspan="3">
                    <p class="error">No Results</p>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach($results as $result): ?>
                <tr>
                    <td>
                        <h2><a href="<?= base_url('/topic/show/') . esc($result['topic_id']) ?>"><?= esc($result['topic_title']) ?></a></h2>
                        <p><?= esc($result['category_name']) ?></p>
                    </td>
                    <td>
                        <p><?= esc(date('l j F Y H:i:s', strtotime($result['created_at']))) ?></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
<?php endif; ?>

<?= $this->endSection('content') ?>