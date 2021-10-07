<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="post">
    <h3><?php echo $post_data->post_title; ?></h3>
    <h6>By <a href="<?php echo BASE_URL; ?>/profile?user=<?php echo $post_data->user_username; ?>"><?php echo $post_data->user_username; ?></a> on <?php echo date('l j F Y H:i', strtotime($post_data->post_date)); ?></h6>
    <p><?php echo $post_data->post_text; ?></p>
  </div>
  
  <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
    <div class="submit-comment">
      <div class="form">
        <h2>Comment</h2>

        <form action="<?php $self; ?>" method="POST">
          <div class="form-group">
            <?php if(isset($error)): ?>
              <div class="error">
                <p><?php echo $error; ?></p>
              </div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <textarea name="comment_text" placeholder="Comment"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="create_comment" value="Comment">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="comments">
    <?php foreach($comments as $comment): ?>
      <div class="post">
        <h6>By <a href="<?php echo BASE_URL; ?>/profile?user=<?php echo $comment->user_username; ?>"><?php echo $comment->user_username; ?></a> on <?php echo date('l j F Y H:i', strtotime($comment->comment_date)); ?></h6>
        <p><?php echo $comment->comment_text; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>