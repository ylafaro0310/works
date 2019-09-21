<?php
// Exclude script name
$args = array_slice($argv,1);

// Exclude options
$target_dirs = array_filter($args,function($value){
  return !preg_match('/^-/',$value);
});

// Get options
$options = getopt("a");

$is_multiple_dirs = count($target_dirs) > 1 ? true : false;
foreach($target_dirs as $key => $target_dir){
  // Print target_dir name if it has multiple dirs
  if($is_multiple_dirs){
    if($key > 0){
      printf("\n\n");
    }
    printf($target_dir.":\n");
  }

  $scan_dirs = scandir($target_dir);  
  // If 'a' is specified, it exclude dirs beginning with '.'.
  if(!array_key_exists('a',$options)){
    $scan_dirs = array_filter($scan_dirs,function($value){
      return !preg_match('/^\.[^.]*/',$value);
    });
  }
  
  // Print result of scandir
  foreach($scan_dirs as $dir){
    printf($dir.' ');
  }
}
