<?php
// Sanitize database input and output

function escape($io) {
  return htmlentities($io, ENT_IGNORE, 'UTF-8');
}