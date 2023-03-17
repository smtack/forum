<?php
require_once '../src/init.php';

if($user->loggedIn())
{
  if($user_data->user_level === 0)
  {
    header('Location: ' . ADMIN_ROOT);
  }
  else
  {
    header('Location: ' . BASE_URL);
  }
}

if(isset($_POST['login']))
{
  if(empty($_POST['user_name']) || empty($_POST['user_password']))
  {
    $error = '<div class="message error">Enter your username and password</div>';
  }
  else
  {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_password' => $_POST['user_password']
    ];

    if($user->logIn($data))
    {
      if($user->user_level !== 0)
      {
        $error = '<div class="message error">You do not have permission to access this area</div>';
      }
      else
      {
        $_SESSION['user_name'] = $data['user_name'];
        $_SESSION['logged_in'] = true;

        header('Location: ' . ADMIN_ROOT);
      }
    }
    else
    {
      $error = '<div class="message error">Username or Password is incorrect</div>';
    }
  }
}

require ADMIN_VIEW_ROOT . '/login.php';