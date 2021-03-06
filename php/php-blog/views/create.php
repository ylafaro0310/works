<?php
    include("../lib/login.php");
    required_logined_session();

    if(!empty($_POST["title"]) && !empty($_POST["content"])){
        $value = [
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "private" => isset($_POST["private"]) ? $_POST['private'] : "0",
        ];
        include("../models/Blog.php");
        $blog = new Blog;
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
        <h2 class="subtitle">新規投稿画面</h2>
        <form action="" method="post">
            <div class="field">
                <div class="control">
                    <label class="label">タイトル</label>
                    <input class="input" name="title" type="text"/>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <label class="label">本文</label>
                    <textarea class="textarea" name="content"></textarea>
                </div>
            </div>
            <div>
                <label class="checkbox">
                    <input type="checkbox" name="private" value="1"/>
                    非公開にする
                </label>
            </div>
            <button class="button" type="submit">投稿する</button>
        </form>
    </div>
</body>