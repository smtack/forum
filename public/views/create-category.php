<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<h2>Create Category</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($error) ? $error : ""?>
  </div>
  <div class="form-group">
    <input type="text" name="category_name" placeholder="Category Name">
  </div>
  <div class="form-group">
    <textarea name="category_description" placeholder="Category Description"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="create_category" value="Create Category">
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>