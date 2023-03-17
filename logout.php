<?php
require_once 'src/init.php';

$user->logOut();

header('Location: ' . BASE_URL);