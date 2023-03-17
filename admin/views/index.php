<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <h1><a href="<?=BASE_URL?>">Forum</a></h1>
  <h2><a href="<?=ADMIN_ROOT?>">Admin Panel</a></h2>

  <?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

  <table border="1">
    <tr>
      <th>Options</th>
    </tr>
    <tr>
      <td>
        <p><a href="<?=ADMIN_ROOT?>/users">Users List</a></p>
      </td>
    </tr>
    <tr>
      <td>
        <p><a href="<?=ADMIN_ROOT?>/create-category">Create Category</a></p>
      </td>
    </tr>
  </table>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>