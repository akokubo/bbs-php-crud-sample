<?php
// Entryオブジェクトの編集画面表示用コントローラ

require_once('config.php');
require_once(LIB . 'view_helper.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// 前の画面から渡されたidに対応するEntryオブジェクトを呼び出す
$entry_dao = new EntryDao();
$entry = $entry_dao->find($_GET['id']);

// edit.htmlを表示する
include(TMPL . 'edit.html');
?>
