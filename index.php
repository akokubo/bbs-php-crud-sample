<?php
// 一覧表示画面用コントローラ

require_once('config.php');
require_once(LIB . 'view_helper.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// すべてのEntryを取り出す
$entry_dao = new EntryDao();
$entries = $entry_dao->findAll();

// index.htmlを表示
include(TMPL . 'index.html');
?>
