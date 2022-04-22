<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="heading">
    <h2 id="heading"><?php echo $profile_data->user_username; ?>'s Posts</h2>
  </div>

  <?php if(!$posts): ?>
    <h3 class="message"><?=$profile_data->user_username; ?> hasn't made a post yet.</h3>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <div class="post">
        <h3><a href="/post/<?php echo $post->post_id; ?>"><?php echo $post->post_title; ?></a></h3>
        <h5>in <a href="/category/<?php echo $post->category_id; ?>"><?php echo $post->category_name; ?></a>
        <h6>By <?php echo $post->user_username; ?> on <?php echo date('l j F Y H:i', strtotime($post->post_date)); ?></h6>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>