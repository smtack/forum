<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h2>Update Profile</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($message) ? $message : ""?>
  </div>
  <div class="form-group">
    <input type="text" name="user_name" value="<?=escape($user_data->user_name)?>" disabled="disabled">
  </div>
  <div class="form-group">
    <input type="text" name="user_email" value="<?=escape($user_data->user_email)?>">
  </div>
  <div class="form-group">
    <input type="submit" name="update" value="Update">
  </div>
</form>

<h3>Update Profile Picture</h3>

<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($picture_message) ? $picture_message : ""?>
  </div>
  <div class="form-group">
    <input type="file" name="profile-picture">
  </div>
  <div class="form-group">
    <input type="submit" name="update-profile-picture" value="Update Profile Picture">
  </div>
</form>

<h3>Change Password</h3>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($password_message) ? $password_message : ""?>
  </div>
  <div class="form-group">
    <input type="password" name="current_password" placeholder="Current Password">
  </div>
  <div class="form-group">
    <input type="password" name="new_password" placeholder="New Password">
  </div>
  <div class="form-group">
    <input type="password" name="confirm_new_password" placeholder="Confirm New Password">
  </div>
  <div class="form-group">
    <input type="submit" name="change_password" value="Change Password">
  </div>
</form>

<h3>Delete Account</h3>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <?=isset($delete_message) ? $delete_message : ""?>
  </div>
  <div class="form-group">
    <input type="submit" name="delete" value="Delete Account">
  </div>
</form>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>