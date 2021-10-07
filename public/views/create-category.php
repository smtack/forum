<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="form">
  <h2>Create Category</h2>

  <form action="<?php $self; ?>" method="POST">
    <div class="form-group">
      <?php if(isset($error)): ?>
        <div class="error">
          <p><?php echo $error; ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <input type="text" name="category_name" placeholder="Category Name">
    </div>
    <div class="form-group">
      <textarea name="category_description" placeholder="Category Description"></textarea>
    </div>
    <div class="form-group">
      <input type="submit" name="create_category" value="Create Category">
    </div>
  </form>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>