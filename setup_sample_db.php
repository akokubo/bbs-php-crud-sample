<?php
// サンプルのデータベースを初期化する

require_once('config.php');
require_once(LIB . 'database_handler.php');

// SQL文を定義
$DROP_QUERY = 'DROP TABLE IF EXISTS entries';

$CREATE_QUERY =<<<CREATE_QUERY
CREATE TABLE entries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR,
    author VARCHAR,
    date DATETIME,
    body TEXT
);
CREATE_QUERY;

$INSERT_QUERY = 'INSERT INTO entries (title, author, date, body) VALUES (:title, :author, :date, :body)';

// データベースを生成し、データを投入する
try {
    $dbh = DatabaseHandler::getInstance();
    $statement = $dbh->query($DROP_QUERY);
    $statement = $dbh->query($CREATE_QUERY);
    post("1つめの投稿", "ななしさん1号","2021-11-29 10:10:11", "これは1つめの投稿です。");
    post("2つめの投稿", "ななしさん2号","2021-11-30 00:00:11", "これは2つめの投稿です。");
    post("3つめの投稿", "ななしさん3号","2021-12-01 22:30:00", "これは3つめの投稿です。");

    $dbh = null;
    echo 'データベース生成成功';
}
catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br>";
    die();
}

// データ投入用関数
function post($title, $author, $date, $body) {
    global $INSERT_QUERY;
    global $dbh;
    
    $statement = $dbh->prepare($INSERT_QUERY);

    $statement->bindParam(':title', $title);
    $statement->bindParam(':author', $author);
    $statement->bindParam(':date', $date);
    $statement->bindParam(':body', $body);
    
    $statement->execute();
}
?>
