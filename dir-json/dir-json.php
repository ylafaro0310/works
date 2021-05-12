<?php
// Scan current dir or specified dir
function scanDirectory($pathname){
  if(!is_dir($pathname) || basename($pathname) === "." || basename($pathname) === ".."){
    return basename($pathname);
  }

  $dirs = scandir($pathname);
  //var_dump($dirs);
  $result = [];
  foreach($dirs as $dir){
    $scanned_dir = scanDirectory($pathname . "/" . $dir);
    if(is_string($scanned_dir)){
      $result[$scanned_dir] = null;
    }else{
      $result[$dir] = $scanned_dir;
    }
  }
  return $result;
}

$json = json_encode(scanDirectory(realpath(".")),JSON_PRETTY_PRINT);
file_put_contents("directories.json",$json);
