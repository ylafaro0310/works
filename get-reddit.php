<?php
$url = 'https://www.reddit.com/r/programming/';
$html = file_get_contents($url);
$html = mb_convert_encoding($html,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$dom = new DOMDocument();
libxml_use_internal_errors( true );
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXpath($dom);
$titles_node = $xpath->query("//div[contains(@class,'rpBJOHq2PR60pnwJlUyP0')]/div/div/div/div/article/div/div/div/a/div/h3");
$users_node = $xpath->query("//div[contains(@class,'rpBJOHq2PR60pnwJlUyP0')]/div/div/div/div/article/div/div/div/div/div/a");

$titles = [];
foreach($titles_node as $node){
    $titles[] = $node->nodeValue;
}
$users = [];
foreach($users_node as $node){
    $users[] = $node->nodeValue;
}

