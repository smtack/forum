<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['user'])) {
  $user_data = $user->getUser($_SESSION['user']);
  $categories = $category->getUsersFollows($user_data->user_id);
}

if(isset($_GET['query']) && !empty($_GET['query'])) {
  if(!$category_data = $category->getCategory($_GET['query'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

$posts = $post->getPostsByCategory($_GET['query']);

$follow_data = $category->getFollowData($category_data->category_id);

$page_title = $category_data->category_name;

require VIEW_ROOT . '/category.php';