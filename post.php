<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_data = $user->getUser();
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
  if(!$post_data = $post->getPost($_GET['id'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

$categories = $category->getCategories();
$comments = $post->getComments($_GET['id']);

if(isset($_POST['create_comment'])) {
  if(!empty($_POST['comment_text'])) {
    $post->comment_post = $post_data->post_id;
    $post->comment_by = $user_data->user_id;

    if($post->createComment()) {
      header('Location: ' . BASE_URL . '/post?id=' . $post_data->post_id);
    } else {
      $error = "Unable to post comment";
    }
  } else {
    $error = "Enter a comment";
  }
}

$page_title = $post_data->post_title;

require VIEW_ROOT . '/post.php';