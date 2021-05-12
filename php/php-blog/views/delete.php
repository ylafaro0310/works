<?php
include('../models/Blog.php');

$blog = new Blog;
$blog->delete($_POST['id']);

header('Location: /',true,301);