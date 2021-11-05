<?php
// 詳細表示画面用コントローラ

require_once('config.php');
require_once(LIB . 'view_helper.php');
require_once(LIB . 'entry.php');
require_once(LIB . 'entry_dao.php');

// 前の画面から渡されたidに対応したEntryを取得
$entry_dao = new EntryDao();
$entry = $entry_dao->find($_GET['id']);

// show.htmlを表示
include(TMPL . 'show.html');
?>
