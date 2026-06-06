<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h3>Users</h3>

<table border="1">
    <tr>
        <th>User Info</th>
    </tr>
    <?php if(!$users): ?>
        <tr>
            <td colspan="3">
                <p class="error">No Users</p>
            </td>
        </tr>
    <?php else: ?>
        <?php foreach($users as $user): ?>
            <tr>
                <td>
                    <h2><a href="<?= base_url('profile?id=') . esc($user['user_id'])?>"><?= esc($user['user_username']) ?></a></h2>
                    <p>Email: <?= esc($user['user_email'])?></p>
                    <p>Joined: <?= esc(date('l j F Y H:i:s', strtotime($user['created_at']))) ?></p>

                    <div class="options">
                        <ul>
                            <li>Admin Options:</li>

                            <?php if($user['user_level'] !== 0): ?>
                                <?php if($user['user_level'] == 2): ?>
                                     <li><a href="<?= base_url('/admin/make-moderator/') . esc($user['user_id']) ?>">Make Moderator</a></li>
                                <?php elseif($user['user_level'] == 1): ?>
                                    <li><a href="<?= base_url('/admin/remove-moderator/') . esc($user['user_id']) ?>">Remove Moderator</a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?= $this->endSection('content') ?>