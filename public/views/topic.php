<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<table border="1">
  <tr>
    <th colspan="2"><?=escape($topic_data->topic_subject)?></th>
  </tr>
  <?php foreach($posts as $post): ?>
    <tr>
      <td class="user-info">
        <h4><a href="profile?id=<?=escape($post->user_id)?>"><?=escape($post->user_name)?></a></h4>

        <?php if($post->user_profile_picture): ?>
          <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($post->user_profile_picture)?>" alt="<?=escape($post->user_profile_picture)?>">
        <?php endif; ?>
        
        <p><?=escape(date('l jS F Y H:i:s', strtotime($post->post_date)))?></p>
      </td>
      <td>
        <div class="post">
          <p><?=escape($post->post_content)?></p>
        </div>

        <?php if(isset($user_data) && $user_data->user_id === $post->post_by): ?>
          <div class="options">
            <ul>
              <li><a href="<?=BASE_URL?>/edit-post?post_id=<?=escape($post->post_id)?>">Edit</a></li>
              <li><a href="<?=BASE_URL?>/delete-post?post_id=<?=escape($post->post_id)?>">Delete</a></li>
            </ul>
          </div>
        <?php endif; ?>

        <?php if(isset($user_data)): ?>
          <?php if($user_data->user_level === 0 || $user_data->user_level === 1): ?>
            <div class="options">
              <ul>
                <li>Admin Options:</li>
                <li><a href="<?=BASE_URL?>/delete-post?post_id=<?=escape($post->post_id)?>">Delete</a></li>
              </ul>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if($_SESSION): ?>
    <tr>
      <td colspan="3">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <?=isset($error) ? $error : ""?>
          </div>
          <div class="form-group">
            <textarea name="post_content"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="post" value="Reply">
          </div>
        </form>
      </td>
    </tr>
  <?php endif; ?>
</table>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>