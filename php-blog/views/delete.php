<?php
include('../models/Blog.php');

$blog = new Blog;
$blog->delete($_POST['id']);

$http = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$url = $http . $_SERVER['HTTP_HOST'];
header('Location: '.$url,true,301);