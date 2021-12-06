<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="heading">
    <h2 id="heading"><?php echo $profile->user_username; ?>'s Posts</h2>
  </div>

  <?php foreach($users_posts as $post): ?>
    <div class="post">
      <h3><a href="<?php echo BASE_URL; ?>/post/<?php echo $post->post_id; ?>"><?php echo $post->post_title; ?></a></h3>
      <h5>in <a href="<?php echo BASE_URL; ?>/category/<?php echo $post->category_id; ?>"><?php echo $post->category_name; ?></a>
      <h6>By <?php echo $post->user_username; ?> on <?php echo date('l j F Y H:i', strtotime($post->post_date)); ?></h6>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>