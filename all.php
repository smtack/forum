<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['user'])) {
  $user_data = $user->getUser($_SESSION['user']);
  $categories = $category->getUsersFollows($user_data->user_id);
}

$posts = $post->getPosts();

require VIEW_ROOT . '/all.php';