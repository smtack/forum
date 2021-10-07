<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_data = $user->getUser();
}

$categories = $category->getCategories();

$posts = $post->getPosts();

require VIEW_ROOT . '/index.php';