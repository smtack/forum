<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <?php foreach($results as $result): ?>
    <div class="post">
      <h3><a href="<?php echo BASE_URL; ?>/profile?user=<?php echo $result->user_username; ?>"><?php echo $result->user_username; ?></a></h3>
      <h6>Joined on <?php echo date('l j F Y H:i', strtotime($result->user_joined)); ?></h6>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>