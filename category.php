<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_data = $user->getUser();
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
  if(!$category_data = $category->getCategory($_GET['id'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

$categories = $category->getCategories();
$posts = $post->getPostsByCategory($_GET['id']);

$page_title = $category_data->category_name;

require VIEW_ROOT . '/category.php';