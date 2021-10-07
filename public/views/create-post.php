<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="form">
  <h2>Create Post</h2>

  <form action="<?php $self; ?>" method="POST">
    <div class="form-group">
      <?php if(isset($error)): ?>
        <div class="error">
          <p><?php echo $error; ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <select name="post_category">
        <?php foreach($categories as $category): ?>
          <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="post_title" placeholder="Post Title">
    </div>
    <div class="form-group">
      <textarea name="post_text" placeholder="Post Text"></textarea>
    </div>
    <div class="form-group">
      <input type="submit" name="create_post" value="Create Post">
    </div>
  </form>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>