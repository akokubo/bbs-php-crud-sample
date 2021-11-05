<?php
// Entryデータを更新用コントローラ

require_once('config.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// 前の画面から渡されたデータからEntryオブジェクトを作る
$entry = new Entry(array(
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'date' => $_POST['date'],
    'body' => $_POST['body']));

// Entryオブジェクトでデータベースを更新する
$entry_dao = new EntryDao();
$entry_dao->update($entry);

// index.phpに移動する
header('Location: index.php');
?>
