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

require ADMIN_VIEW_ROOT . '/index.php';