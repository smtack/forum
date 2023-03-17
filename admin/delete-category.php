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

$category = new Category($db);

$id = isset($_GET['category_id']) ? escape($_GET['category_id']) : header('Location: ' . BASE_URL);

if($category->deleteCategory($id))
{
  header('Location: ' . BASE_URL);
}
else
{
  header('Location: ' . BASE_URL);
}