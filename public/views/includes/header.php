<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/public/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/public/img/favicon/favicon-16x16.png">
  <link href="<?php echo BASE_URL; ?>/public/css/style.css" rel="stylesheet">
  <script src="<?php echo BASE_URL; ?>/public/js/main.js" defer></script>
  <title><?php echo isset($page_title) ? 'forum - ' . $page_title : 'forum'; ?></title>
</head>
<body>
  <div class="header">
    <h1><a href="<?php echo BASE_URL; ?>">forum</a></h1>

    <ul>
      <?php if(isset($_SESSION['user'])): ?>
        <li><a href="<?php echo BASE_URL; ?>/all"><img src="<?php echo BASE_URL; ?>/public/img/all.svg" alt="All"></a></li>
        <li><img class="toggle-menu" src="<?php echo BASE_URL; ?>/public/img/menu.svg" alt="Toggle Menu"></li>

        <div class="menu">
          <ul>
            <a href="<?php echo BASE_URL; ?>/profile/<?php echo $_SESSION['user']; ?>"><li>Your Profile</li></a>
            <a href="<?php echo BASE_URL; ?>/update"><li>Update Profile</li></a>
            <a href="<?php echo BASE_URL; ?>/logout"><li>Log Out</li></a>
          </ul>
        </div>
      <?php else: ?>
        <li><a href="<?php echo BASE_URL; ?>/signup"><button>Sign Up</button></a></li>
        <li><a href="<?php echo BASE_URL; ?>/login"><button>Log In</button></a></li>
      <?php endif; ?>
    </ul>
  </div>