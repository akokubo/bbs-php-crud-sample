<?php
require_once('config.php');
require_once('database_handler.php');
require_once('entry.php');

/**
 * Entry(投稿)のDAO(Data Access Object)クラス
 *
 * @author 小久保温
 * @version 1.0
 */
class EntryDao {
    // それぞれSQL文を定数で用意
    const INSERT_QUERY = 'INSERT INTO entries (title, author, date, body) VALUES (:title, :author, :date, :body)';
    const DELETE_QUERY = 'DELETE FROM entries WHERE id = :id';
    const UPDATE_QUERY = 'UPDATE entries SET title=:title, author=:author, date=:date, body=:body WHERE id=:id';
    const SELECT_ALL_QUERY = 'SELECT * FROM entries';
    const SELECT_BY_KEY_WITH_VALUE_QUERY = 'SELECT * FROM entries';
    const SELECT_BY_ID_QUERY = 'SELECT * FROM entries WHERE id = :id';

    private $dbh; // データベース接続

    // コンストラクタ
    public function __construct() {
        // データベースへ接続
        $this->dbh = DatabaseHandler::getInstance();
    }

    // Entryを新規保存する
    public function save(Entry $entry) {
        if (isset($entry)) {
            try {
                $statement = $this->dbh->prepare(self::INSERT_QUERY);
                $title = $entry->getTitle();
                $statement->bindParam(':title', $title);
                $author = $entry->getAuthor();
                $statement->bindParam(':author', $author);
                // 現在の日時
                $date = date("Y-m-d H:i:s");
                $statement->bindParam(':date', $date);
                $body = $entry->getBody();
                $statement->bindParam(':body', $body);
                $statement->execute();
		        return $this->dbh->lastInsertId();
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }
    
    // Entryの情報を更新する
    public function update(Entry $entry) {
        if (isset($entry)) {
            try {
                $statement = $this->dbh->prepare(self::UPDATE_QUERY);
                $id = $entry->getId();
                $statement->bindParam(':id', $id);
                $title = $entry->getTitle();
                $statement->bindParam(':title', $title);
                $author = $entry->getAuthor();
                $statement->bindParam(':author', $author);
                // 現在の日時
                $date = date("Y-m-d H:i:s");
                $statement->bindParam(':date', $date);
                $body = $entry->getBody();
                $statement->bindParam(':body', $body);
                $statement->execute();
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }

    // Entryを削除する
    public function destroy($id) {
        if (isset($id)) {
            try {
                $entry = $this->find($id);
                if (isset($entry)) {
                    $statement = $this->dbh->prepare(self::DELETE_QUERY);
                    $statement->bindParam(':id', $id);
                    $statement->execute();
                }
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }

    // Entryの一覧を作る
    public function findAll() {
        try {
            $entries = array();
            $statement = $this->dbh->query(self::SELECT_ALL_QUERY);
            $entries = $statement->fetchAll(PDO::FETCH_CLASS, 'Entry');
            return $entries;
        } catch (PDOException $e) {
            print "エラー!: " . $e->getMessage() . "<br>";
            die();
        }
    }

    // 指定したキーと値で検索した結果を返す
    public function findByKeyWithValue($key, $value) {
        if (isset($key) && isset($value)) {
            try {
                $entries = array();
                $statement = $this->dbh->prepare(self::SELECT_BY_KEY_WITH_VALUE_QUERY . ' WHERE ' . $key . ' = :value');
                $statement->bindParam(':value', $value);
                $statement->execute();
                $entries = $statement->fetchAll(PDO::FETCH_CLASS, 'Entry');
                return $entries;
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }

    // 指定したidの結果を返す
        public function find($id) {
        if (isset($id)) {
            try {
                $statement = $this->dbh->prepare(self::SELECT_BY_ID_QUERY);
                $statement->bindParam(':id', $id);
                $statement->setFetchMode(PDO::FETCH_CLASS, 'Entry', NULL);
                $statement->execute();
                $entry = $statement->fetch();
                return $entry;
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }
}
?>
