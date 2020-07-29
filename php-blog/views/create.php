<?php
    if(!empty($_POST["title"]) && !empty($_POST["content"])){
        $value = [
            "title" => $_POST["title"],
            "content" => $_POST["content"],
        ];
        include("../models/Blog.php");
        $blog = new Blog;
        $blog->create($value);

        $http = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $url = $http . $_SERVER['HTTP_HOST'];
        header('Location: '.$url,true,301);
    }
?>
<header>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" rel="stylesheet"/>
</header>
<body>
    <div class="container">
        <form action="create" method="post">
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
            <button type="submit">作成</button>
        </form>
    </div>
</body>