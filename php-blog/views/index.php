<header>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" rel="stylesheet"/>
</header>
<body>
    <div class="container">
        <a href="/create">新規投稿</a>
        <?php 
            include('../models/Blog.php');
            $blog = new Blog;
            $posts = $blog->read();
            foreach($posts as $post){ 
        ?>
        <form action="delete" method="post">
            <input type="hidden" name="id" value="<?php echo($post['id'])?>"/>
            <input type="hidden" name="title" value="<?php echo($post['title'])?>"/>
            <input type="hidden" name="content" value="<?php echo($post['content'])?>"/>
            <div class="box">
                <h2><?php echo($post['title']) ?></h2>
                <article>
                    <?php echo($post['content']) ?>
                </article>
                <button type='submit'>投稿を削除する</button>
            </div>
        </form>
        <?php } ?>
    </div>
</body>