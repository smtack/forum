<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<h2>Admin Log In</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=(isset($error) ? $error : "")?>
  </div>
  <div class="form-group">
    <input type="text" name="user_name" placeholder="Username">
  </div>
  <div class="form-group">
    <input type="password" name="user_password" placeholder="Password">
  </div>
  <div class="form-group">
    <input type="submit" name="login" value="Log In">
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>