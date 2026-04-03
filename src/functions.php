<?php

// Sanitise database output

function escape($string) {
  return htmlentities($string, ENT_IGNORE, 'UTF-8');
}