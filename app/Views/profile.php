<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="info">
    <?php if($user['user_avatar']): ?>
        <img src="<?= base_url('avatars/') . esc($user['user_avatar']) ?>" alt="<?= esc($user['user_avatar']) ?>">
    <?php endif; ?>

    <h2><?= esc($user['user_username'])?></h2>
    <p>Joined <?= esc(date('l j F Y', strtotime($user['created_at']))) ?></p>

    <?php if($user['user_level'] == 0): ?>
        <p>Admin</p>
    <?php elseif($user['user_level'] == 1): ?>
        <p>Moderator</p>
    <?php endif; ?>
</div>
<div class="topics">
    <h2><?= esc($user['user_username']) ?>'s Topics</h2>

    <table border="1">
        <tr>
            <th>Topic</th>
            <th>Created at</th>
        </tr>

        <?php if(!$users_topics): ?>
            <tr>
                <td colspan="3">
                    <p class="error"><?= esc($user['user_username']) ?> hasn't made a topic yet.</p>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach($users_topics as $users_topic): ?>
                <tr>
                    <td>
                        <h2><a href="<?= base_url('topic/show/') . esc($users_topic['topic_id']) ?>"><?= esc($users_topic['topic_title']) ?></a></h2>
                        <p>in <a href="<?= base_url('category/') . esc($users_topic['category_id']) ?>"><?= esc($users_topic['category_name']) ?></a></p>
                    </td>
                    <td>
                        <p><?= esc(date('l j F Y H:i:s', strtotime($users_topic['created_at']))) ?></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>

<?= $this->endSection('content') ?>