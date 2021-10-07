<div class="sidebar">
  <?php if(isset($user_data)): ?>
    <p>Welcome <a href="<?php echo BASE_URL; ?>/profile?user=<?php echo $user_data->user_username; ?>"><?php echo $user_data->user_username; ?></a></p>

    <a href="<?php echo BASE_URL; ?>/create-category"><button>Create Category</button></a>
    <a href="<?php echo BASE_URL; ?>/create-post"><button>Create Post</button></a>
  <?php endif; ?>

  <div class="form">
    <form action="<?php echo BASE_URL; ?>/search-users" method="GET">
      <div class="form-group">
        <input type="text" name="s" placeholder="Search Users">
      </div>
      <div class="form-group">
        <input type="submit" value="Search Users">
      </div>
    </form>
  </div>

  <div class="form">
    <form action="<?php echo BASE_URL; ?>/search-posts" method="GET">
      <div class="form-group">
        <input type="text" name="s" placeholder="Search Posts">
      </div>
      <div class="form-group">
        <input type="submit" value="Search Posts">
      </div>
    </form>
  </div>
  
  <?php if(isset($category_data)): ?>
    <div class="category-info">
      <h1><?php echo $category_data->category_name; ?></h1>
      <p><?php echo $category_data->category_description; ?></p>
    </div>
  <?php endif; ?>

  <?php if(isset($profile)): ?>
    <div class="category-info">
      <h1><?php echo $profile->user_username; ?>'s Profile</h1>
    </div>
  <?php endif; ?>

  <h2>Categories</h2>

  <ul>    
    <?php foreach($categories as $category): ?>
      <a href="<?php echo BASE_URL ; ?>/category?id=<?php echo $category->category_id; ?>"><li><?php echo $category->category_name; ?></li></a>
    <?php endforeach; ?>
  </ul>
</div>