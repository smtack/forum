<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_GET['user']) && !empty($_GET['user'])) {
  if(!$profile = $user->getProfile($_GET['user'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_data = $user->getUser();
}

$categories = $category->getCategories();

$users_posts = $post->getUsersPosts($profile->user_id);

$page_title = $profile->user_username . "'s Profile";

require VIEW_ROOT . '/profile.php';