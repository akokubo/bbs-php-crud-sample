<?php
require_once('database_config.php');
/**
 * データベース接続を管理するクラス
 *
 * @author 小久保温
 * @version 1.0
 */
class DatabaseHandler {
    // シングルトンパターンを使用
    private static $databaseHandler;

    // new でインスタンスを生成できないようにprivateにする
    private function __construct() {}

    // getInstance()でインスタンスを取得する
    public static function getInstance() {
        if (is_null(self::$databaseHandler)) {
            // まだインスタンスが存在していない場合
            try {
                // データベース接続を作る
                self::$databaseHandler
                    = new PDO(DATABASE_RESOURCE, DATABASE_USERNAME, DATABASE_PASSWORD);
            } catch (PDOException $e) {
                print "エラー!: " . $e->getMessage() . "<br>";
                die();
            }
        }

        // データベース接続を返す
        return self::$databaseHandler;
    }

}
?>
