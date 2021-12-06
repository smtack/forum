<?php
require_once 'src/init.php';

if(!isset($_SESSION['user'])) {
  header('Location: ' . BASE_URL);
}

$user = new User($db);

$user_data = $user->getUser($_SESSION['user']);

if(isset($_POST['create_category'])) {
  if(!empty($_POST['category_name'])) {
    $category = new Category($db);

    $new_category = [
      'category_name' => escape($_POST['category_name']),
      'category_description' => escape($_POST['category_description']),
      'category_by' => $user_data->user_id
    ];

    if($category->createCategory($new_category)) {
      header('Location: ' . BASE_URL);
    } else {
      $error = "Unable to create category";
    }
  } else {
    $error = "Enter a category name";
  }
}

$page_title = "Create Category";

require VIEW_ROOT . '/create-category.php';