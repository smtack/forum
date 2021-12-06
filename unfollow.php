<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);

if(!isset($_SESSION['user'])) {
  header('Location: ' . BASE_URL);
} else {
  $user_data = $user->getUser($_SESSION['user']);
}

if($id = isset($_GET['query']) ? escape($_GET['query']) : null) {
  if($category->unfollowCategory($user_data->user_id, $id)) {
    header('Location: ' . BASE_URL . '/category/' . $id);
  }
} else {
  header('Location: ' . BASE_URL);
}