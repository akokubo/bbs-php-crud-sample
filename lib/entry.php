<?php
require_once('config.php');
/**
 * Entry(投稿)クラス
 *
 * @author 小久保温
 * @version 1.0
 */
class Entry {
    private $id; // ID
    private $title; // 題名
    private $author; // 投稿者
    private $date; // 投稿日時
    private $body; // 本文

    // コンストラクタ
    public function __construct() {
        $num = func_num_args();
        if ($num == 1) {
            $arg = func_get_arg(0);
            if (is_array($arg)) {
                if (array_key_exists('id', $arg)) {
                    $this->setId($arg["id"]);
                }
                $this->setTitle($arg["title"]);
                $this->setAuthor($arg["author"]);
                if (array_key_exists('date', $arg)) {
                    $this->setDate($arg["date"]);
                }
                $this->setBody($arg["body"]);
            }
        }
    }

    // Entryを文字列化して使用する場合のコード
    public function __toString() {
        $str = "id: ".$this->id."\n".
            "title: ".$this->title."\n".
            "author: ".$this->author."\n".
            "date: ".$this->date."\n".
            "body: ".$this->body;
        return $str;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }

    public function getBody() {
        return $this->body;
    }
    public function setBody($body) {
        $this->body = $body;
    }
}
?>
