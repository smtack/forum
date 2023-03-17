<?php
require_once 'src/init.php';

$post = new Post($db);

$post_id = isset($_GET['post_id']) ? escape($_GET['post_id']) : header('Location: ' . BASE_URL);

if(!$post_data = $post->getPost($post_id))
{
  header('Location: ' . BASE_URL);
}
else if($post_data->post_by != $user_data->user_id)
{
  header('Location: ' . BASE_URL);
}

if(isset($_POST['edit_post']))
{
  if(empty($_POST['post_content']))
  {
    $error = '<div class="message error">Enter some text</div>';
  }
  else
  {
    $data = [
      'post_content' => escape($_POST['post_content']),
      'post_id' => $post_data->post_id
    ];

    if($post->updatePost($data))
    {
      header('Location: ' . BASE_URL . '/topic?topic_id=' . $post_data->post_topic);
    }
    else
    {
      $error = '<div class="message error">Unable to update post</div>';
    }
  }
}

require VIEW_ROOT . '/edit-post.php';