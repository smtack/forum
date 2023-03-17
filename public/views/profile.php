<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<h1><a href="<?=BASE_URL?>">Forum</a></h1>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="info">
  <?php if($profile_data->user_profile_picture): ?>
    <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($profile_data->user_profile_picture)?>" alt="<?=escape($profile_data->user_profile_picture)?>">
  <?php endif; ?>

  <h2><?=escape($profile_data->user_name)?></h2>
  <p>Joined <?=escape(date('l j F Y', strtotime($profile_data->user_joined)))?></p>

  <?php if($profile_data->user_level == 0): ?>
    <p>Admin</p>
  <?php elseif($profile_data->user_level == 1): ?>
    <p>Moderator</p>
  <?php endif; ?>
</div>
<div class="topics">
  <h2><?=escape($profile_data->user_name)?>'s Topics</h2>

  <table border="1">
    <tr>
      <th>Topic</th>
      <th>Created at</th>
    </tr>

    <?php if(!$users_topics): ?>
      <tr>
        <td colspan="3">
          <p class="error"><?=escape($profile_data->user_name)?> hasn't made a topic yet.</p>
        </td>
      </tr>
    <?php else: ?>
      <?php foreach($users_topics as $users_topic): ?>
        <tr>
          <td>
            <h2><a href="topic?topic_id=<?=escape($users_topic->topic_id)?>"><?=escape($users_topic->topic_subject)?></a></h2>
            <p>in <a href="category?category_id=<?=escape($users_topic->category_id)?>"><?=escape($users_topic->category_name)?></a></p>
          </td>
          <td>
            <p><?=escape(date('l j F Y H:i:s', strtotime($users_topic->topic_date)))?></p>

            <?php if(isset($user_data) && $user_data->user_id === $users_topic->topic_by): ?>
              <div class="options">
                <ul>
                  <li><a href="<?=BASE_URL?>/delete-topic?topic_id=<?=escape($users_topic->topic_id)?>">Delete</a></li>
                </ul>
              </div>
            <?php endif; ?>

            <?php if(isset($user_data)): ?>
              <?php if($user_data->user_level === 0 || $user_data->user_level === 1): ?>
                <div class="options">
                  <ul>
                    <li>Admin Options:</li>
                    <li><a href="<?=BASE_URL?>/delete-topic?topic_id=<?=escape($users_topic->topic_id)?>">Delete</a></li>
                  </ul>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>