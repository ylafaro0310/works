<?php
    include("../lib/login.php");
    include("../models/User.php");
    required_unlogined_session();

    $user = new User;
    $username = filter_input(INPUT_POST,'username');
    $password = filter_input(INPUT_POST,'password');
    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(
            //validate_token(filter_input(INPUT_POST,'token')) &&
            $user->validate_password($username,$password)
        ){
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            header('Location: /');
            exit;
        }
        http_response_code(403);
    }
    header('Content-Type: text/html; charset=UTF-8');
?>
<header>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" rel="stylesheet"/>
</header>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="field">
                <div class="control">
                    <label class="label">ユーザ名</label>
                    <input class="input" name="username" type="text"/>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <label class="label">パスワード</label>
                    <input class="input" name="password" type="password"/>
                </div>
            </div>
            <input type="hidden" name="token" value="<?= h(generate_token())?>"/>
            <button type="submit">ログイン</button>
        </form>
    </div>
</body>