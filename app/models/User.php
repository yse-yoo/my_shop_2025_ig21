<?php

namespace App\Models;

use PDO;
use PDOException;
use Database;
use File;

class User
{
    /**
     * コンストラクタ
     *
     * インスタンス生成時にプロパティ等の初期化が必要であれば行います。
     */
    public function __construct()
    {
        // 必要に応じた初期化処理を実装
    }

    /**
     * ユーザデータを取得
     *
     * @param int $id ユーザID
     * @return array|null ユーザデータの連想配列、もしくは該当するユーザがなければ null
     */
    public function find(int $id)
    {
        try {
            $pdo = Database::getInstance();
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * ユーザデータを取得
     *
     * @param string $account_name ユーザのアカウント名
     * @return array|null ユーザデータの連想配列、もしくは該当するユーザがなければ null
     */
    public function findForExists($posts)
    {
        try {
            $email = $posts['email'];
            $pdo = Database::getInstance();
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * ユーザデータをDBに登録する
     *
     * @param array $data 登録するユーザデータ
     * @return mixed 登録成功時はユーザID、失敗時は null
     */
    public function insert($data)
    {
        try {
            // パスワードのハッシュ化
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $pdo = Database::getInstance();
            $sql = "INSERT INTO users (name, email, password) 
                    VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute($data);
            if ($result) {
                return $pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return;
    }

    /**
     * ユーザ認証
     *
     * @param string $eamil ユーザのアカウント名
     * @param string $password 入力されたパスワード
     * @return mixed 認証成功時はユーザデータの連想配列、失敗時はnull
     */
    public function auth($email, $password)
    {
        // DB接続
        $pdo = Database::getInstance();
        // SQL作成: emailでユーザを検索
        $sql = "SELECT * FROM users WHERE email = :email";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return;
    }

}
