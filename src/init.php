<?php
require_once "config.php";
require_once "functions.php";

spl_autoload_register(function($class) {
  include_once 'classes/' . $class . '.php';
});

ini_set("display_errors", "on");
ini_set("display_startup_errors", "on");
ini_set("log_errors", "on");

error_reporting(E_ALL);

$db = new Database();

session_start();

$user = new User($db);

if($user->loggedIn())
{
  $user_data = $user->getUser($_SESSION['user_name']);
}