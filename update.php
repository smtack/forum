<?php
require_once 'src/init.php';

if($_SESSION['logged_in'] !== true) {
  header('Location: ' . BASE_URL);
}

$user = new User($db);

$user_data = $user->getUser();

if(isset($_POST['update'])) {
  if(!empty($_POST['user_email'])) {
    if($user->updateUser($user_data->user_id)) {
      header("Location: " . BASE_URL);
    } else {
      $error = "Unable to update profile";
    }
  } else {
    $error = "Fill in all fields";
  }
}

if(isset($_POST['change_password'])) {
  if(!empty($_POST['confirm_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])) {
    if(password_verify($_POST['confirm_password'], $user_data->user_password)) {
      if($_POST['new_password'] === $_POST['confirm_new_password']) {
        if($user->changePassword($user_data->user_id)) {
          header("Location: " . BASE_URL);
        } else {
          $password_error = "Unable to change password";
        }
      } else {
        $password_error = "Passwords must match";
      }
    } else {
      $password_error = "Enter current password correctly";
    }
  } else {
    $password_error = "Fill in all fields";
  }
}

if(isset($_POST['delete_profile'])) {
  if($user->deleteProfile($user_data->user_id)) {
    $user->logOut();
    
    header("Location: " . BASE_URL);
  } else {
    $delete_error = "Unable to delete profile";
  }
}

$page_title = "Update Profile";

require VIEW_ROOT . '/update.php';