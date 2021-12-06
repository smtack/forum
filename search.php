<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['user'])) {
  $user_data = $user->getUser($_SESSION['user']);
  $categories = $category->getUsersFollows($user_data->user_id);
}

$keywords = isset($_POST['s']) ? escape($_POST['s']) : '';
$keywords = "%{$keywords}%";

$user_results = $user->searchUsers($keywords);
$post_results = $post->searchPosts($keywords);
$category_results = $category->searchCategories($keywords);

$page_title = "Search: " . str_replace('%', '', $keywords);

require VIEW_ROOT . '/search.php';