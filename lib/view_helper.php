<?php
// 表示に使う関数を定義

// HTMLで使われる特殊文字をHTMLの実体参照に変換
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// URLエンコーディングする
function u($str) {
    return urlencode($str);
}

// テキストデータをHTMLに変換する
function text_to_html($text) {
    $result = '<p>'.h($text).'</p>';
    $result = str_replace("\n", '<br>'."\n", $result);
    return $result;
}
?>
