<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <?php foreach($results as $result): ?>
    <div class="post">
      <h3><a href="<?php echo BASE_URL; ?>/post?id=<?php echo $result->post_id; ?>"><?php echo $result->post_title; ?></a></h3>
      <h6>By <a href="<?php echo BASE_URL; ?>/profile?user=<?php echo $result->user_username; ?>"><?php echo $result->user_username; ?></a> on <?php echo date('l j F Y H:i', strtotime($result->post_date)); ?></h6>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>