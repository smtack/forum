<?php flash('user_message'); ?>
<?php flash('post_message'); ?>

<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <?php if(!$posts): ?>
    <h3 class="message">Follow some categories to get started</h3>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <div class="post">
        <h3><a href="/post/<?php echo $post->post_id; ?>"><?php echo $post->post_title; ?></a></h3>
        <h5>in <a href="/category/<?php echo $post->category_id; ?>"><?php echo $post->category_name; ?></a>
        <h6>By
        <?php if($post->user_username): ?>
          <a href="/profile/<?php echo $post->user_username; ?>"><?php echo $post->user_username; ?></a>
        <?php else: ?>
          [Deleted]
        <?php endif; ?>

        on <?php echo date('l j F Y H:i', strtotime($post->post_date)); ?>
      </h6>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>