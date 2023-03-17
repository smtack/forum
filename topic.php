<?php
require_once 'src/init.php';

$topic = new Topic($db);

$post = new Post($db);

$topic_id = isset($_GET['topic_id']) ? escape($_GET['topic_id']) : header('Location: ' . BASE_URL);

if(!$topic_data = $topic->getTopic($topic_id)) {
  header('Location: ' . BASE_URL);
}

if(isset($_POST['post']))
{
  if(empty($_POST['post_content']))
  {
    $error = '<div class="message error">Enter a post</div>';
  }
  else
  {
    $data = [
      'post_content' => escape($_POST['post_content']),
      'post_topic' => $topic_data->topic_id,
      'post_by' => $user_data->user_id
    ];

    if(!$post->createPost($data))
    {
      $error = '<div class="message error">Unable to make post</div>';
    }
  }
}

$posts = $post->getPosts($topic_id);

$page_title = $topic_data->topic_subject;

require VIEW_ROOT .'/topic.php';