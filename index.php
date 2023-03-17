<?php
require_once 'src/init.php';

$category = new Category($db);

$categories = $category->getCategories();

$topic = new Topic($db);

require VIEW_ROOT . '/index.php';