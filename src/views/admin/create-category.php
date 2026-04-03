<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>
<h2><a href="<?=ADMIN_ROOT?>">Admin Panel</a></h2>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h3>Create Category</h3>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=(isset($error) ? $error : "") ?>
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