<?php

$PATH = $_SERVER['PATH_INFO'];
if(empty($PATH)){
    $PATH = $_SERVER['REQUEST_URI'];
    $PATH = preg_replace('/^\//','',$PATH);
}
$rules = [
    ['GET', '/', 'index'],
    ['GET', '/create', 'create'],
    ['GET', '/login', 'login'],
    ['GET', '/register', 'register'],
];

function parseRules($rule){
    $return = [];
    foreach($rule as $value){
        $return[$value[0]] = [ $value[1] => $value[2]];
    }
    return $return;
}

if(empty($PATH)){
    include("../views/index.php");
}else{
    include("../views/${PATH}.php");
}
