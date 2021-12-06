<?php
// Check for a value in a multidimensional array

function findValue($array, $key, $value) {
  foreach($array as $item) {
    if(is_array($item) && findValue($item, $key, $value)) {
      return true;
    }

    if(isset($item[$key]) && $item[$key] == $value) {
      return true;
    }
  }

  return false;
}

// Sanitize Input

function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}