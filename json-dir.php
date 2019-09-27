<?php

$json_path = $argv[count($argv)-1];
$json_file = file_get_contents($json_path);
$json = json_decode($json_file,true);

$options = getopt("o:");
if(array_key_exists("o",$options)){
    $output_path = rtrim($options["o"],"/");
}else{
    $output_path = getcwd();
}

jsonToDir($output_path,$json);

function jsonToDir($output_path,$json){
    foreach($json as $key => $value){
        $pathname = $output_path . "/" . $key;
        if($value){
            mkdir($pathname,0777,true);
            jsonToDir($pathname,$value);
        }else{
            touch($pathname);
        }
    }
}