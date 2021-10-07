<?php
require_once 'src/init.php';

if($_SESSION['logged_in'] !== true) {
  header('Location: ' . BASE_URL);
}

$user = new User($db);
$category = new Category($db);

$user_data = $user->getUser();
$categories = $category->getCategories();

if(isset($_POST['create_post'])) {
  if(!empty($_POST['post_title'])) {
    $post = new Post($db);

    $post->post_by = $user_data->user_id;

    if($post->createPost()) {
      header('Location: ' . BASE_URL);
    } else {
      $error = "Unable to create post";
    }
  } else {
    $error = "Enter a post title";
  }
}

$page_title = "Create Post";

require VIEW_ROOT . '/create-post.php';