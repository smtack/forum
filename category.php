<?php
require_once 'src/init.php';

$id = isset($_GET['category_id']) ? escape($_GET['category_id']) : header('Location: ' . BASE_URL);

$category = new Category($db);

$topic = new Topic($db);

if(!$category_data = $category->getCategory($id))
{
  header('Location: ' . BASE_URL);
}

$topics = $topic->getTopics($category_data->category_id);

$page_title = $category_data->category_name;

require VIEW_ROOT . '/category.php';