<?php
// Entryオブジェクトの削除用コントローラ

require_once('config.php');
require_once(LIB . 'entry_dao.php');

$destroy = $_POST['destroy'];
if (isset($_POST['id']) && $destroy == '削除') {
    // 前の画面からidが渡され、削除ボタンが押された場合

    // idに対応したEntryを削除する
    $entry_dao = new EntryDao();
    $entry_dao->destroy($_POST['id']);
}

// index.phpに飛ぶ
header('Location: index.php');
?>
