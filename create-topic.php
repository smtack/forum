<?php
require_once 'src/init.php';

if(!$user->loggedIn())
{
  header('Location: ' . BASE_URL);
}

$category = new Category($db);

$categories = $category->getCategories();

if(isset($_POST['create_topic']))
{
  if(empty($_POST['topic_subject']) || empty($_POST['post_content']))
  {
    $error = '<div class="message error">Enter a subject and a post</div>';
  }
  else
  {
    $topic = new Topic($db);

    $post = new Post($db);

    $data = [
      'topic_subject' => escape($_POST['topic_subject']),
      'topic_category' => escape($_POST['topic_category']),
      'topic_by' => $user_data->user_id
    ];
    
    if($topic->createTopic($data))
    {
      $data = [
        'post_content' => escape($_POST['post_content']),
        'post_topic' => $db->pdo->lastInsertId(),
        'post_by' => $user_data->user_id
      ];

      if($post->createPost($data))
      {
        header('Location: ' . BASE_URL);
      }
      else
      {
        $error = '<div class="message error">Unable to make post</div>';
      }
    }
    else
    {
      $error = '<div class="message error">Unable to create topic</div>';
    }
  }
}

$page_title = "Create Topic";

require VIEW_ROOT . '/create-topic.php';