<div class="navbar">
  <?php if($user->loggedIn()): ?>
    <p id="user">Hello <a href="<?=BASE_URL?>/profile?id=<?=escape($user_data->user_id)?>"><?=escape($user_data->user_name)?></a></p>
    
    <ul>
      <li><a href="<?=BASE_URL?>/search">Search</a></li>
      <li><a href="<?=BASE_URL?>/create-topic">Create Topic</a></li>
      <li><a href="<?=BASE_URL?>/update-profile">Update Profile</li>
      <li><a href="<?=BASE_URL?>/logout">Log Out</a></li>
    </ul>
  <?php else: ?>
    <ul>
      <li><a href="<?=BASE_URL?>/search">Search</li>
      <li><a href="<?=BASE_URL?>/signup">Sign Up</a> or <a href="<?=BASE_URL?>/login">Log In</a></li>
    </ul>
  <?php endif; ?>
</div>