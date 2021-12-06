<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);

if(isset($_SESSION['user'])) {
  $user_data = $user->getUser($_SESSION['user']);
  $categories = $category->getUsersFollows($user_data->user_id);
}

$categories_list = $category->getCategories();

require VIEW_ROOT . '/categories.php';