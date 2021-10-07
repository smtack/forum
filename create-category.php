<?php
require_once 'src/init.php';

if($_SESSION['logged_in'] !== true) {
  header('Location: ' . BASE_URL);
}

$user = new User($db);

$user_data = $user->getUser();

if(isset($_POST['create_category'])) {
  if(!empty($_POST['category_name'])) {
    $category = new Category($db);

    $category->category_by = $user_data->user_id;

    if($category->createCategory()) {
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