<?php
$url = 'https://www.reddit.com/r/programming/';
$html = file_get_contents($url);
$html = mb_convert_encoding($html,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$dom = new DOMDocument();
@$dom->loadHTML($html);

$xpath = new DOMXpath($dom);
$articles_node = $xpath->query("//div[contains(@class,'rpBJOHq2PR60pnwJlUyP0')]/div/div/div/div/article/div");
$articles = [];
foreach($articles_node as $node){
    $titles_node = $xpath->query("./div/div/a/div/h3",$node);
    $article['title'] = $titles_node->item(0)->nodeValue;
    $users_node = $xpath->query("./div/div/div/div/a",$node);
    $article['user'] = $users_node->item(0)->nodeValue;    
    $articles[] = $article;
}

$article_json = json_encode($articles,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

//var_dump($article_json);
file_put_contents('reddit_articles.json',$article_json);
