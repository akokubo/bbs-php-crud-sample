<?php
// Entryオブジェクトの保存用コントローラ

require_once('config.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// CSRF対策用トークンの確認
session_start();
$token = filter_input(INPUT_POST, 'token');
if (empty($_SESSION['token']) || !hash_equals(@$_SESSION['token'], $token)) {
    die('正規の画面からご利用ください');
}

// 前の画面から送られた値から、Entryオブジェクトを作る
$entry = new Entry(array(
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'body' => $_POST['body']));

// Entryオブジェクトを保存する
$entry_dao = new EntryDao();
$entry_id = $entry_dao->save($entry);

// index.phpに飛ぶ
header('Location: index.php');
?>
