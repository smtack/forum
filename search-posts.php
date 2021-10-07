<?php
require_once 'src/init.php';

$user = new User($db);
$category = new Category($db);
$post = new Post($db);

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $user_data = $user->getUser();
}

$categories = $category->getCategories();

$keywords = isset($_GET['s']) ? $_GET['s'] : '';
$keywords = "%{$keywords}%";
$keywords = htmlentities($keywords);

$results = $post->searchPosts($keywords);

$page_title = "Search: " . str_replace('%', '', $keywords);

require VIEW_ROOT . '/search-posts.php';