<?php require_once VIEW_ROOT . '/includes/sidebar.php'; ?>

<div class="posts">
  <div class="heading">
    <h1 id="heading">Search: <?php echo isset($keywords) ? str_replace('%', '', $keywords) : ''; ?></h1>

    <ul>
      <li id="toggle-post-results"><a href="#">Posts</a></li>
      <li id="toggle-category-results"><a href="#">Categories</a></li>
      <li id="toggle-user-results"><a href="#">Users</a></li>
    </ul>
  </div>
  <div class="post-results">
    <?php if(!$post_results): ?>
      <h3 class="message">No posts found</h3>
    <?php else: ?>
      <?php foreach($post_results as $post_result): ?>
        <div class="post">
          <h3><a href="/post/<?php echo $post_result->post_id; ?>"><?php echo $post_result->post_title; ?></a></h3>
          <h6>By
            <?php if($post_result->user_username): ?>
              <a href="/profile/<?php echo $post_result->user_username; ?>"><?php echo $post_result->user_username; ?></a>
            <?php else: ?>
              [Deleted]
            <?php endif; ?>

            on <?php echo date('l j F Y H:i', strtotime($post_result->post_date)); ?>
          </h6>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="category-results">
    <?php if(!$category_results): ?>
      <h3 class="message">No categories found</h3>
    <?php else: ?>
      <?php foreach($category_results as $category_result): ?>
        <div class="post">
          <h3><a href="/category/<?php echo $category_result->category_id; ?>"><?php echo $category_result->category_name; ?></a></h3>
          <h6>By
            <?php if($category_result->user_username): ?>
              <a href="/profile/<?php echo $category_result->user_username; ?>"><?php echo $category_result->user_username; ?></a>
            <?php else: ?>
              [Deleted]
            <?php endif; ?>

            on <?php echo date('l j F Y H:i', strtotime($category_result->category_created)); ?>
          </h6>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="user-results">
    <?php if(!$user_results): ?>
      <h3 class="message">No users found</h3>
    <?php else: ?>
      <?php foreach($user_results as $user_result): ?>
        <div class="post">
          <h3><a href="/profile/<?php echo $user_result->user_username; ?>"><?php echo $user_result->user_username; ?></a></h3>
          <h6>Joined on <?php echo date('l j F Y H:i', strtotime($user_result->user_joined)); ?></h6>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>