<div class="sidebar">
  <?php if(isset($user_data)): ?>
    <p>Welcome <a href="<?php echo BASE_URL; ?>/profile/<?php echo $user_data->user_username; ?>"><?php echo $user_data->user_username; ?></a></p>
  <?php else: ?>
    <p>Welcome to forum. <a href="<?php echo BASE_URL; ?>/signup">Sign Up</a> or <a href="<?php echo BASE_URL; ?>/login">Login</a>.</p>
  <?php endif; ?>

  <div class="form">
    <form action="<?php echo BASE_URL; ?>/search" method="POST">
      <div class="form-group search">
        <input type="text" name="s" placeholder="Search">
        <input type="image" src="<?php echo BASE_URL; ?>/public/img/search.svg" alt="Search">
      </div>
    </form>
  </div>

  <?php if(isset($user_data)): ?>
    <a href="<?php echo BASE_URL; ?>/create-category"><button>Create Category</button></a>
    <a href="<?php echo BASE_URL; ?>/create-post"><button>Create Post</button></a>
  <?php endif; ?>
  
  <?php if(isset($category_data)): ?>
    <div class="category-info">
      <h1><?php echo $category_data->category_name; ?></h1>
      <p><?php echo $category_data->category_description; ?></p>

      <?php if(isset($user_data)): ?>
        <?php if(!findValue($follow_data, 'user_following', $user_data->user_id)): ?>
          <a href="<?php echo BASE_URL; ?>/follow/<?php echo $category_data->category_id; ?>"><button>Follow</button></a>
        <?php else: ?>
          <a href="<?php echo BASE_URL; ?>/unfollow/<?php echo $category_data->category_id; ?>"><button>Unfollow</button></a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if(isset($profile)): ?>
    <div class="category-info">
      <h1><?php echo $profile->user_username; ?>'s Profile</h1>
    </div>
  <?php endif; ?>

  <?php if(isset($user_data)): ?>
    <h2>Your Categories</h2>

    <ul>    
      <?php foreach($categories as $category): ?>
        <a href="<?php echo BASE_URL ; ?>/category/<?php echo $category->category_id; ?>"><li><?php echo $category->category_name; ?></li></a>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <a href="<?php echo BASE_URL; ?>/categories"><button>All Categories</button></a>
</div>