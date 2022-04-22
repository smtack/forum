<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="post">
    <h3><?php echo $post_data->post_title; ?></h3>
    <h6>By
      <?php if($post_data->user_username): ?>
        <a href="/profile/<?php echo $post_data->user_username; ?>"><?php echo $post_data->user_username; ?></a>
      <?php else: ?>
        [Deleted]
      <?php endif; ?>

      on <?php echo date('l j F Y H:i', strtotime($post_data->post_date)); ?>
    </h6>
    <p><?php echo $post_data->post_text; ?></p>
  </div>
  
  <?php if($user): ?>
    <div class="submit-comment">
      <div class="form">
        <h2>Comment</h2>

        <form action="/comment/<?php echo $post_data->post_id; ?>" method="POST">
          <div class="form-group">
            <?php error('form_error'); ?>
          </div>
          <div class="form-group">
            <textarea name="comment_text" placeholder="Comment"></textarea>
          </div>
          <div class="form-group">
            <input type="hidden" name="token" value="<?php echo generate('token'); ?>">
            <input type="submit" name="create_comment" value="Comment">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="comments">
    <?php foreach($comments as $comment): ?>
      <div class="post">
        <h6>By
          <?php if($comment->user_username): ?>
            <a href="/profile/<?php echo $comment->user_username; ?>"><?php echo $comment->user_username; ?></a>
          <?php else: ?>
            [Deleted]
          <?php endif; ?>

          on <?php echo date('l j F Y H:i', strtotime($comment->comment_date)); ?>
        </h6>
        
        <p><?php echo $comment->comment_text; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>