<?php

function isValidIP(string $str): bool
{
  if (strlen($str) == 0) {
    return false;
  }
  
  $parts = explode(".", $str);
  
  if (count($parts) !== 4) {
    return false;
  }
  
  foreach ($parts as $part) {
    
    if (strlen($part) > 1 && $part[0] === "0" || $part[0] === " ") {
    return false;
    }
    
    if (str_ends_with($part, " ")) {
      return false;
    }
    
    if (!is_numeric($part)) {
      return false;
    }
    
    $num = intval($part);
    
    if ($num < 0 || $num > 255) {
      return false;
    }
  }
    

  
  return true;
}