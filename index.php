<?php
/**
 * Created by IntelliJ IDEA.
 * User: yusuke
 * Date: 2019-06-19
 * Time: 15:14
 */
//header('Content-Type: text/plain; charset=UTF-8');

define("URL_TOPSTORIES", "https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty");
define("URL_ITEM_BASE", "https://hacker-news.firebaseio.com/v0/item/");

$ids = json_decode(file_get_contents(URL_TOPSTORIES));
$ids_top_10 = array_slice($ids, 0, 10);

function mapper($val) {
    $data = file_get_contents(URL_ITEM_BASE . (string)$val . '.json');
    return json_decode($data);
}

$new_ary = array_map("mapper", $ids_top_10);

?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>hknews</title>
    <base target="_blank">
    <style>
        body{
            background: gray;
        }
        .card{
            background: white;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
    <div class="cards">
        <?php foreach($new_ary as $key => $data): ?>
        <div class="card">
            <div class="title">
                <a href="<?= $data->url ?>"><?= $data->title ?></a>
            </div>
            <div class="score">SCORE: <?= $data->score ?></div>
            <div class="comment">COMMENT: <?= $data->descendants?></div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
