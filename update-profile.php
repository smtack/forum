<?php
require_once 'src/init.php';

if(!$user->loggedIn())
{
  header('Location: ' . BASE_URL);
}

if(isset($_POST['update']))
{
  if(empty($_POST['user_email']))
  {
    $message = '<div class="message error">Fill in the email field</div>';
  }
  else if($db->exists('users', 'user_email', $_POST['user_email']) && $_POST['user_email'] !== $user_data->user_email)
  {
    $message = '<div class="message error">This email address is already in use</div>';
  }
  else
  {
    $data = [
      'user_id' => $user_data->user_id,
      'user_email' => escape($_POST['user_email'])
    ];

    if($user->updateUser($data))
    {
      $message = '<div class="message notice">Your profile has been updated</div>';
    }
    else
    {
      $message = '<div class="message error">Unable to update profile</div>';
    }
  }
}

if(isset($_POST['update-profile-picture']))
{
  if(empty($_FILES['profile-picture']['name']))
  {
    $picture_message = '<div class="message error">Select an image to upload</div>';
  }
  else
  {
    $target_dir = "uploads/profile-pictures/";
    $file_name = basename($_FILES['profile-picture']['name']);
    $path = $target_dir . $file_name;
    $file_type = pathinfo($path, PATHINFO_EXTENSION);
    $allow_types = array('jpg', 'png', 'PNG');

    if(!in_array($file_type, $allow_types))
    {
      $picture_message = '<div class="message error">This file type is not allowed</div>';
    }
    else
    {
      if(!move_uploaded_file($_FILES['profile-picture']['tmp_name'], $path))
      {
        $picture_message = '<div class="message error">Unable to upload profile picture</div>';
      }
      else
      {
        $data = [
          'user_id' => $user_data->user_id,
          'user_profile_picture' => escape($file_name)
        ];

        if($user->uploadProfilePicture($data))
        {
          $picture_message = '<div class="message notice">Profile picture uploaded</div>';
        }
        else
        {
          $picture_message = '<div class="message error">Unable to upload profile picture</div>';
        }
      }
    }
  }
}

if(isset($_POST['change_password']))
{
  if(empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password']))
  {
    $password_message = '<div class="message error">Fill in all fields</div>';
  }
  else if(!password_verify($_POST['current_password'], $user_data->user_password))
  {
    $password_message = '<div class="message error">Enter your current password correctly</div>';
  }
  else if($_POST['new_password'] !== $_POST['confirm_new_password'])
  {
    $password_message = '<div class="message error">Passwords must match</div>';
  }
  else
  {
    $data = [
      'user_id' => $user_data->user_id,
      'new_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)
    ];

    if($user->changePassword($data))
    {
      $password_message = '<div class="message notice">Your password has been changed</div>';
    }
    else
    {
      $password_message = '<div class="message error">Could not change password</div>';
    }
  }
}

if(isset($_POST['delete']))
{
  if($user->deleteUser($user_data->user_id))
  {
    $user->logOut();

    header('Location: ' . BASE_URL);
  }
  else
  {
    $delete_message = '<div class="message error">Unable to delete profile</div>';
  }
}

$page_title = "Update Profile";

require VIEW_ROOT . '/update-profile.php';