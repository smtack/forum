<?php
require_once 'src/init.php';

if($user->loggedIn())
{
  header('Location: ' . BASE_URL);
}

if(isset($_POST['login']))
{
  if(empty($_POST['user_name']) || empty($_POST['user_password']))
  {
    $error = '<div class="message error">Fill in both fields</div>';
  }
  else
  {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_password' => $_POST['user_password']
    ];

    if($user->logIn($data))
    {
      $_SESSION['user_name'] = $data['user_name'];
      $_SESSION['logged_in'] = true;
  
      header('Location: ' . BASE_URL);
    }
    else
    {
      $error = '<div class="message error">Username or Password Incorrect</div>';
    }
  }
}

$page_title = "Log In";

require VIEW_ROOT . '/login.php';