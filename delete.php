<?php
// Entryオブジェクトの削除確認画面用コントローラ

require_once('config.php');
require_once(LIB . 'view_helper.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// 前の画面から渡されたidからEntryオブジェクトを作る
$entry_dao = new EntryDao();
$entry = $entry_dao->find($_GET['id']);

// delete.htmlを表示
include(TMPL . 'delete.html');
?>
