<?php
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
        $value = [
            "username" => $_POST["username"],
            "password" => $_POST["password"],
        ];
        include("../models/User.php");
        $blog = new User;
        $blog->create($value);

        header('Location: /',true,301);
        exit;
    }
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
            <div class="field">
                <div class="control">
                    <label class="label">パスワード(確認用)</label>
                    <input class="input" type="password"/>
                </div>
            </div>
            <button type="submit">作成</button>
        </form>
    </div>
</body>