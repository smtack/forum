<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_GET['query']) && !empty($_GET['query'])) {
  if(!$profile = $user->getUser($_GET['query'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

if(isset($_SESSION['user'])) {
  $user_data = $user->getUser($_SESSION['user']);
  $categories = $category->getUsersFollows($user_data->user_id);
}

$users_posts = $post->getUsersPosts($profile->user_id);

$page_title = $profile->user_username . "'s Profile";

require VIEW_ROOT . '/profile.php';