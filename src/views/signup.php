<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<h2>Sign Up</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($error) ? $error : ""?>
  </div>
  <div class="form-group">
    <input type="text" name="user_name" placeholder="Username">
  </div>
  <div class="form-group">
    <input type="text" name="user_email" placeholder="Email">
  </div>
  <div class="form-group">
    <input type="password" name="user_password" placeholder="Password">
  </div>
  <div class="form-group">
    <input type="password" name="confirm_password" placeholder="Confirm Password">
  </div>
  <div class="form-group">
    <input type="submit" name="signup" value="Sign Up">
  </div>
  <div class="form-group">
    <p>Already have an account? <a href="<?=BASE_URL?>/login">Log In</a></p>
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>