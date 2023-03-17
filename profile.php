<?php
require_once 'src/init.php';

$topic = new Topic($db);

if(!$profile_data = $user->getUser(escape($_GET['id'])))
{
  header('Location: ' . BASE_URL);
}

$users_topics = $topic->getUsersTopics($profile_data->user_id);

$page_title = $profile_data->user_name . 's Profile';

require VIEW_ROOT . '/profile.php';