<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h2>Create Topic</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($error) ? $error : ""?>
  </div>
  <div class="form-group">
    <input type="text" name="topic_subject" placeholder="Topic Subject">
  </div>
  <div class="form-group">
    <select name="topic_category">
      <?php foreach($categories as $category): ?>
        <option value="<?=escape($category->category_id)?>"><?=escape($category->category_name)?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <textarea name="post_content" placeholder="Post"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="create_topic" value="Create Topic">
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>