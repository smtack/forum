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
  if(!$post_data = $post->getPost($_GET['query'])) {
    header('Location: ' . BASE_URL);
  }
} else {
  header('Location: ' . BASE_URL);
}

$comments = $post->getComments($_GET['query']);

if(isset($_POST['create_comment'])) {
  if(!empty($_POST['comment_text'])) {
    $comment = [
      'comment_text' => escape($_POST['comment_text']),
      'comment_post' => $post_data->post_id,
      'comment_by' => $user_data->user_id
    ];

    if($post->createComment($comment)) {
      header('Location: ' . BASE_URL . '/post/' . $post_data->post_id);
    } else {
      $error = "Unable to post comment";
    }
  } else {
    $error = "Enter a comment";
  }
}

$page_title = $post_data->post_title;

require VIEW_ROOT . '/post.php';