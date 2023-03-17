<?php
require_once "config.php";
require_once "functions.php";

spl_autoload_register(function($class) {
  include_once 'classes/' . $class . '.php';
});

ini_set("display_errors", "on");

$db = new Database();

session_start();

$user = new User($db);

if($user->loggedIn())
{
  $user_data = $user->getUser($_SESSION['user_name']);
}