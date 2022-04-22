<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="heading">
    <h2 id="heading">All Categories</h2>
  </div>

  <?php foreach($categories_list as $category): ?>
    <div class="post">
      <h3><a href="/category/<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></a></h3>
      <h6>By
        <?php if($category->user_username): ?>
          <a href="/profile/<?php echo $category->user_username; ?>"><?php echo $category->user_username; ?></a>
        <?php else: ?>
          [Deleted]
        <?php endif; ?>

        on <?php echo date('l j F Y H:i', strtotime($category->category_created)); ?>
      </h6>
    </div>
  <?php endforeach; ?>
</div>