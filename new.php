<?php
// 新規投稿画面用コントローラ

require_once('config.php');
require_once(LIB . 'view_helper.php');

// CSRF対策用トークンの用意
session_start();
if (empty($_SESSION['token'])) {
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
} else {
    $token = $_SESSION['token'];
}

// new.htmlを表示
include(TMPL . 'new.html');
?>
