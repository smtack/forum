<?php
require_once 'src/init.php';

if(!$user->loggedIn())
{
  header('Location: ' . BASE_URL . '/login');
}
else if($user_data->user_level !== 0 || $user_data !== 1)
{
  header('Location: ' . BASE_URL);
}

$topic = new Topic($db);

$topic_id = isset($_GET['topic_id']) ? escape($_GET['topic_id']) : header('Location: ' . BASE_URL);

if($topic->deleteTopic($topic_id))
{
  header('Location: ' . BASE_URL);
}
else
{
  header('Location: ' . BASE_URL);
}