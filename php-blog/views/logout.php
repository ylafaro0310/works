<?php
include('../lib/login.php');

required_logined_session();
if(!validate_token(filter_input(INPUT_POST,'token'))){
    //http_response_code(400);
    header('Content-Type: text/plain; charset=UTF-8', true, 400);
    exit('トークンが無効です。');
}
setcookie(session_name(),'',1);
session_destroy();
header('Location: /');