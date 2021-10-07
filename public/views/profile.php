<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <?php foreach($users_posts as $post): ?>
    <div class="post">
      <h3><a href="<?php echo BASE_URL; ?>/post?id=<?php echo $post->post_id; ?>"><?php echo $post->post_title; ?></a></h3>
      <h6>By <?php echo $post->user_username; ?> on <?php echo date('l j F Y H:i', strtotime($post->post_date)); ?></h6>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>