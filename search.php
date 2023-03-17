<?php
require_once 'src/init.php';

if(isset($_GET['s']))
{
  $topic = new Topic($db);

  $keywords = isset($_GET['s']) ? escape($_GET['s']) : "";

  $keywords = "%{$keywords}%";
  
  $results = $topic->searchTopics($keywords);
}

require VIEW_ROOT . '/search.php';