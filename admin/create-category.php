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

if(isset($_POST['create_category']))
{
  if(empty($_POST['category_name']) || empty($_POST['category_description']))
  {
    $error = '<div class="message error">Fill in both fields</div>';
  }
  else
  {
    $category = new Category($db);

    $data = [
      'category_name' => escape($_POST['category_name']),
      'category_description' => escape($_POST['category_description'])
    ];

    if($category->createCategory($data))
    {
      header('Location: ' . BASE_URL);
    }
    else
    {
      $error = '<div class="message error">Unable to create category</div>';
    }
  }
}

require ADMIN_VIEW_ROOT . '/create-category.php';