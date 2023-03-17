<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>
<h2><a href="<?=ADMIN_ROOT?>">Admin Panel</a></h2>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h3>Users</h3>

<table border="1">
  <tr>
    <th>User Info</th>
  </tr>
  <?php if(!$users): ?>
    <tr>
      <td colspan="3">
        <p class="error">No Users</p>
      </td>
    </tr>
  <?php else: ?>
    <?php foreach($users as $user): ?>
      <tr>
        <td>
          <h2><a href="<?=BASE_URL?>/profile?id=<?=escape($user->user_id)?>"><?=escape($user->user_name)?></a></h2>
          <p>Email: <?=escape($user->user_email)?></p>
          <p>Joined: <?=escape(date('l j F Y H:i:s', strtotime($user->user_joined)))?></p>

          <div class="options">
            <ul>
              <li>Admin Options:</li>

              <?php if($user->user_level !== 0): ?>
                <?php if($user->user_level == 2): ?>
                  <li><a href="<?=ADMIN_ROOT?>/add-moderator?id=<?=escape($user->user_id)?>">Make Moderator</a></li>
                <?php elseif($user->user_level == 1): ?>
                  <li><a href="<?=ADMIN_ROOT?>/remove-moderator?id=<?=escape($user->user_id)?>">Remove Moderator</a></li>
                <?php endif; ?>
              <?php endif; ?>

              <li><a href="<?=ADMIN_ROOT?>/delete-user?id=<?=escape($user->user_id)?>">Delete</a></li>
            </ul>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>