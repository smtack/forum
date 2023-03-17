<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="category-description">
  <h3>Topics in <?=escape($category_data->category_name)?></h3>
  <p><?=escape($category_data->category_description)?></p>
</div>

<table border="1">
  <tr>
    <th>Topic</th>
    <th>Created at</th>
  </tr>
  <?php if(!$topics): ?>
    <tr>
      <td colspan="3">
        <p class="error">No topics</p>
      </td>
    </tr>
  <?php else: ?>
    <?php foreach($topics as $topic): ?>
      <tr>
        <td>
          <h2><a href="<?=BASE_URL?>/topic?topic_id=<?=escape($topic->topic_id)?>"><?=escape($topic->topic_subject)?></a></h2>
        </td>
        <td width="200px">
          <p><?=escape(date('l j F Y H:i:s', strtotime($topic->topic_date)))?></p>

          <?php if(isset($user_data)): ?>
            <?php if($user_data->user_level === 0 || $user_data->user_level === 1): ?>
              <div class="options">
                <ul>
                  <li>Admin Options:</li>
                  <li><a href="<?=BASE_URL?>/delete-topic?topic_id=<?=escape($topic->topic_id)?>">Delete</a></li>
                </ul>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>