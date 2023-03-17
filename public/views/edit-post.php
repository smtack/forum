<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h2>Edit Post</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($error) ? $error : ""?>
  </div>
  <div class="form-group">
    <textarea name="post_content" placeholder="Post"><?=escape($post_data->post_content)?></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="edit_post" value="Edit Post">
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>