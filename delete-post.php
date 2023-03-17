<?php
require_once 'src/init.php';

$post = new Post($db);

$post_id = isset($_GET['post_id']) ? escape($_GET['post_id']) : header('Location: ' . BASE_URL);

$post_data = $post->getPost($post_id);

if($user_data->user_level === 0 || $user_data->user_level === 1)
{
  if($post->deletePost($post_data->post_id))
  {
    header('Location: ' . BASE_URL . '/topic?topic_id=' . $post_data->post_topic);
  }
  else
  {
    header('Location: ' . BASE_URL . '/topic?topic_id=' . $post_data->post_topic);
  }
}
else
{
  if($post_data->post_by !== $user_data->user_id)
  {
    header('Location: ' . BASE_URL);
  }
  else
  { 
    if($post->deletePost($post_data->post_id))
    {
      header('Location: ' . BASE_URL . '/topic?topic_id=' . $post_data->post_topic);
    }
    else
    {
      header('Location: ' . BASE_URL . '/topic?topic_id=' . $post_data->post_topic);
    }
  }
}