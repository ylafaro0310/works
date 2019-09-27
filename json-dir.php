<?php

$json_path = $argv[count($argv)-1];
$json_file = file_get_contents($json_path);
$json = json_decode($json_file,true);

$options = getopt("o:");
if(array_key_exists("o",$options)){
    $output_path = rtrim($options["o"],"/");
}else{
    $output_path = ".";
}

var_dump($output_path);