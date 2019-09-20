<?php
$dirs = scandir(".");

foreach($dirs as $dir){
  if(strcmp($dir,".") != 0 && strcmp($dir,"..") != 0){ 
    print($dir." ");
  }
}