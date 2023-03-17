<?php
require_once '../src/init.php';

if(!$user->loggedIn())
{
  header('Location: ' . ADMIN_ROOT . '/login');
}
else if($user_data->user_level !== 0)
{
  header('Location: ' . BASE_URL);
}

$user_id = isset($_GET['id']) ? escape($_GET['id']) : header('Location: ' . BASE_URL);

if($user->removeModerator($user_id))
{
  header('Location: ' . ADMIN_ROOT);
}
else
{
  header('Location: ' . ADMIN_ROOT);
}