<!-- Miss of Miss　-->
<!-- テキストや画像を単純に表示するだけ　-->
<!-- cakephp_tw5/index12.php　と同じ -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>user timeline</title>
    <script src="//twemoji.maxcdn.com/twemoji.min.js"></script>
    <style type="text/css">
    	img.emoji {
			height: 1em;
			width: 1em;
			margin: 0 .05em 0 .1em;
			vertical-align: -0.1em;
		}
    </style>
</head>
<body>
      <a href=""><h1>Miss of Miss</h1></a>
<?php
      try {
    $dbh = new PDO('mysql:host=localhost;dbname=tweet1;charset=utf8', 'mypassword','myusername');
} catch(PDOException $e) {
    var_dump($e->getMessage());
    exit;
}

$sql = "select * from tweet_mm2 where
        (tw_txt not like '%@%')
            and
        (tw_img0 like 'http://pbs.twimg.com/media/%')
        order by tw_date desc";

$stmt = $dbh->query($sql);

function img_tag($src) {
    echo '<img src="' . $src . '">';
}

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $user) {
    echo "@" . $user{'tw_screen'} . "<br/>";
    echo $user{'tw_name'} . "<br/>";
    img_tag($user{'tw_prf'}); echo "<br/>";
    echo $user{'tw_date'} . "<br/>";
    echo $user{'tw_txt'} . "<br/>";

    for($i=0; $i<=3; $i++){
        if (!empty($user{'tw_img' . $i})) {
            img_tag($user{'tw_img' . $i} .':thumb');
            echo "<br>";
        }
    }
}
?>
<script>twemoji.parse(document.body);</script>
</body>
</html>
