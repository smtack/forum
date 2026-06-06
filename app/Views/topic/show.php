<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<table border="1">
    <tr>
        <th colspan="2"><?= esc($topic['topic_title']) ?></th>
    </tr>

    <?php foreach($posts as $post): ?>
        <tr>
            <td class="user-info">
                <h4><a href="<?= base_url('user/') . esc($post['user_id']) ?>"><?= esc($post['user_username']) ?></a></h4>

                <?php if($post['user_avatar']): ?>
                <img src="<?= base_url('avatars/') . esc($post['user_avatar']) ?>" alt="<?= esc($post['user_avatar']) ?>">
                <?php endif; ?>
        
                <p><?= esc(date('l jS F Y H:i:s', strtotime($post['created_at']))) ?></p>
            </td>
            <td>
                <div class="post">
                    <p><?= esc($post['post_text']) ?></p>
                </div>

                <?php if (session()->has('loggedIn') && session('user_id') === $post['post_user']): ?>
                    <div class="options">
                        <ul>
                            <li><a href="<?= base_url('/post/edit/') . esc($post['post_id']) ?>">Edit</a></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if(session()->has('loggedIn')): ?>
                    <?php if(session('user_level') == 0 || session('user_level') == 1): ?>
                        <div class="options">
                            <ul>
                                <li>Admin Options:</li>
                                <li><a href="<?= base_url('/post/edit/') . esc($post['post_id']) ?>">Edit</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php if (session()->has('loggedIn')): ?>
        <tr>
            <td colspan="3">
                <h3>Reply</h3>

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

                <form action="<?= site_url("post/create") ?>" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="post_topic" value="<?= $topic['topic_id'] ?>">

                    <div class="form-group">
                        <textarea name="post_text"><?= old('post_text') ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit">Post</button>
                    </div>
                </form>
            </td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection('content') ?>