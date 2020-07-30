<?php
    include("../lib/login.php");
    session_start();
    header('Content-Type: text/html; charset=UTF-8');
?>
<header>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" rel="stylesheet"/>
</header>
<body>
    <div class="container">
        <?php 
            if(isset($_SESSION['username'])){
        ?>
        <a href="/create">新規投稿</a>
        <form action="logout" method="post">
            <input type="hidden" name="token" value="<?= h(generate_token())?>"/>
            <button type="submit">ログアウト</button>
        </form>
        <?php
            }else{
        ?>
            <a href="/login">ログイン</a>
        <?php                
            }
        ?>
        <?php 
            include('../models/Blog.php');
            $blog = new Blog;
            $posts = $blog->read();
            foreach($posts as $post){ 
                if(!isset($_SESSION['username']) && boolval($post['private'])){
                   continue; 
                }
        ?>
        <form action="delete" method="post">
            <input type="hidden" name="id" value="<?php echo($post['id'])?>"/>
            <input type="hidden" name="title" value="<?php echo($post['title'])?>"/>
            <input type="hidden" name="content" value="<?php echo($post['content'])?>"/>
            <div class="box">
                <h2><?php echo($post['title']) ?></h2>
                <div><?= boolval($post['private']) ? "非公開" : "公開" ?></div>
                <article>
                    <?php echo($post['content']) ?>
                </article>
                <button type='submit'>投稿を削除する</button>
            </div>
        </form>
        <?php } ?>
    </div>
</body>