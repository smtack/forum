<?php
require_once 'src/init.php';

if($user->loggedIn())
{
  header('Location: ' . BASE_URL);
}

if(isset($_POST['signup']))
{
  if(empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['user_password']) || empty($_POST['confirm_password']))
  {
    $error = '<div class="message error">Fill in all fields</div>';
  }
  else if($_POST['user_password'] !== $_POST['confirm_password'])
  {
    $error = '<div class="message error">Passwords do not match</div>';
  }
  else if($db->exists('users', 'user_name', $_POST['user_name']))
  {
    $error = '<div class="message error">This username has been taken</div>';
  }
  else if($db->exists('users', 'user_email', $_POST['user_email']))
  {
    $error = '<div class="message error">This email address is already in use</div>';
  }
  else
  {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_email' => escape($_POST['user_email']),
      'user_password' => password_hash($_POST['user_password'], PASSWORD_BCRYPT)
    ];

    if($user->signUp($data))
    {
      $_SESSION['user_name'] = $data['user_name'];
      $_SESSION['logged_in'] = true;

      header('Location: ' . BASE_URL);
    }
    else
    {
      $error = '<div class="message error">Unable to sign up</div>';
    }
  }
}

$page_title = "Sign Up";

require VIEW_ROOT . '/signup.php';