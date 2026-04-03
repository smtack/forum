<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<h2>Search</h2>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
  <div class="form-group">
    <input type="text" name="s" placeholder="Search">
  </div>
  <div class="form-group">
    <input type="submit" placeholder="Search" value="Search">
  </div>
</form>

<?php if(isset($_GET['s'])): ?>
  <table border="1">
    <tr>
      <th>Topic</th>
      <th>Created at</th>
    </tr>
    <?php if(!isset($results) || !$results): ?>
      <tr>
        <td colspan="3">
          <p class="error">No Results</p>
        </td>
      </tr>
    <?php else: ?>
      <?php foreach($results as $result): ?>
        <tr>
          <td>
            <h2><a href="<?=BASE_URL?>/topic?topic_id=<?=escape($result->topic_id)?>"><?=escape($result->topic_subject)?></a></h2>
            <p><?=escape($result->category_name)?></p>
          </td>
          <td>
            <p><?=escape(date('l j F Y H:i:s', strtotime($result->topic_date)))?></p>

            <?php if(isset($user_data)): ?>
              <?php if($user_data->user_level === 0 || $user_data->user_level === 1): ?>
                <div class="options">
                  <ul>
                    <li>Admin Options:</li>
                    <li><a href="<?=BASE_URL?>/delete-topic?topic_id=<?=escape($result->topic_id)?>">Delete</a></li>
                  </ul>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
<?php endif; ?>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>