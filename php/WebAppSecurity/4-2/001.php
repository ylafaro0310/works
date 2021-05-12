<?php

function getParam(){
    $pattern = '/\A[[:^cntrl:]]{1,20}\z/';
    $val = isset($_GET['param']) ? $_GET['param'] : '';
    // Check characters encoding
    if(!mb_check_encoding($val, 'Shift-JIS')){
        die('Invalid characters encoding');
    }
    // Convert characters encoding
    $val = mb_convert_encoding($val, 'UTF-8', 'Shift-JIS');

    // validation
    if(preg_match($pattern,$val) == 0){
        die('Invalid params');
    }

    return $val;
}

$param = getParam();
?>
<body>
    param=<?php echo htmlspecialchars($param, ENT_NOQUOTES, 'UTF-8'); ?>
</body>