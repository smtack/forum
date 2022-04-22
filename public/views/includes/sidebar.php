<div class="sidebar">
  <h1><a href="/index">forum</a></h1>

  <?php if($user): ?>
    <div class="user-info">
      <p>Welcome <a href="/profile/<?php echo $user->user_username; ?>"><?php echo $user->user_username; ?></a></p>
      
      <img class="toggle-menu" src="/Resource/public/img/menu.svg" alt="Toggle Menu">
    </div>
  <?php else: ?>
    <p>Welcome to forum. <a href="/signup">Sign Up</a> or <a href="/login">Login</a>.</p>
  <?php endif; ?>

  <div class="menu">
    <ul>
      <a href="/profile/<?php echo $user->user_username; ?>"><li>Your Profile</li></a>
      <a href="/update"><li>Update Profile</li></a>
      <a href="/logout"><li>Log Out</li></a>
    </ul>
  </div>

  <div class="form">
    <form action="/search" method="POST">
      <div class="form-group search">
        <input type="text" name="s" placeholder="Search">
      </div>
    </form>
  </div>

  <?php if($user): ?>
    <a href="/create-category"><button>Create Category</button></a>
    <a href="/new-post"><button>New Post</button></a>
  <?php endif; ?>
  
  <?php if(isset($category_data)): ?>
    <div class="category-info">
      <h2><?php echo $category_data->category_name; ?></h2>
      <p><?php echo $category_data->category_description; ?></p>

      <?php if($user): ?>
        <?php if(!findValue($follow_data, 'user_following', $user->user_id)): ?>
          <a href="/follow/<?php echo $category_data->category_id; ?>"><button>Follow</button></a>
        <?php else: ?>
          <a href="/unfollow/<?php echo $category_data->category_id; ?>"><button>Unfollow</button></a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if(isset($profile)): ?>
    <div class="category-info">
      <h1><?php echo $profile->user_username; ?>'s Profile</h1>
    </div>
  <?php endif; ?>

  <?php if($user): ?>
    <h2>Your Categories</h2>

    <ul>    
      <?php foreach($categories as $category): ?>
        <a href="/category/<?php echo $category->category_id; ?>"><li><?php echo $category->category_name; ?></li></a>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <a href="/categories"><button>All Categories</button></a>
  <a href="/all"><button>All Posts</button></a>

  <div class="footer">
    <p>&copy; <?=date('Y')?> forum</p>
  </div>
</div>