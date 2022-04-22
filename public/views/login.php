<div class="header">
  <h1><a href="/index">forum</a></h1>
</div>

<div class="form">
  <h2>Log In</h2>
  
  <form action="/authenticate" method="POST">
    <div class="form-group">
      <?php error('form_error'); ?>
    </div>
    <div class="form-group">
      <input type="text" name="user_username" placeholder="Username">
    </div>
    <div class="form-group">
      <input type="password" name="user_password" placeholder="Password">
    </div>
    <div class="form-group">
      <input type="hidden" name="token" value="<?php echo generate('token'); ?>">
      <input type="submit" name="login" value="Log In">
    </div>
    <div class="form-group">
      <p>Don't have an account? <a href="/signup">Sign Up</a></p>
    </div>
  </form>
</div>

<div class="page-footer">
  <p>&copy; <?=date('Y')?> forum</p>
</div>