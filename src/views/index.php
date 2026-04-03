<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<table border="1">
  <tr>
    <th>Category</th>
    <th>Last Topic</th>
  </tr>
  <?php if(!$categories): ?>
    <tr>
      <td colspan="2">
        <p class="error">No categories</p>
      </td>
    </tr>
  <?php endif; ?>
  <?php foreach($categories as $category): ?>
    <?php $last_topic = $topic->getLastTopic($category->category_id); ?>
    
    <tr>
      <td>
        <h2><a href="<?=BASE_URL?>/category?category_id=<?=escape($category->category_id)?>"><?=escape($category->category_name)?></a></h2>
        <p><?=escape($category->category_description)?></p>
      </td>
      <td>
        <?php if(!$last_topic): ?>
          <p>No topics</p>
        <?php else: ?>
          <p><a href="<?=BASE_URL?>/topic?topic_id=<?=escape($last_topic->topic_id)?>"><?=escape($last_topic->topic_subject)?></a> on <?=escape(date('l j F Y H:i:s', strtotime($last_topic->topic_date)))?></p>
        <?php endif; ?>

        <?php if(isset($user_data)): ?>
          <?php if($user_data->user_level === 0): ?>
            <div class="options">
              <ul>
                <li>Admin Options:</li>
                <li><a href="<?=ADMIN_ROOT?>/delete-category?category_id=<?=escape($category->category_id)?>">Delete</a></li>
              </ul>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>