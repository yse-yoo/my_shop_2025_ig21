<?php

namespace App\Models;

use PDO;
use PDOException;
use Database;

class Item
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
     * 商品情報のバリデーション
     *
     * @param array $posts 入力された商品情報
     * @return array エラーメッセージの配列
     */
    public function validate($posts)
    {
        $errors = [];
        if (empty($posts['code'])) {
            $errors['code'] = '商品コードは必須です。';
        }
        if (empty($posts['name'])) {
            $errors['name'] = '商品名は必須です。';
        }
        if (empty($posts['price'])) {
            $errors['price'] = '価格は必須です。';
        } elseif (!is_numeric($posts['price'])) {
            $errors['price'] = '価格は数値で入力してください。';
        }
        if (empty($posts['stock'])) {
            $errors['stock'] = '在庫数は必須です。';
        } elseif (!is_numeric($posts['stock'])) {
            $errors['stock'] = '在庫数は数値で入力してください。';
        }
        return $errors;
    }

    /**
     * 商品取得
     *
     * @return array|null
     */
    public function find($id)
    {
        $pdo = Database::getInstance();
        // TODO: SQL: id で検索
        $sql = "SELECT * FROM items WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $values = $stmt->fetch(PDO::FETCH_ASSOC);
        return $values;
    }

    /**
     * 商品取得
     *
     * @return array|null
     */
    public function fetch($limit = 20)
    {
        $pdo = Database::getInstance();
        //  SQL: 一覧取得(LIIMIT)
        $sql = "SELECT * FROM items ORDER BY id DESC LIMIT :limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['limit' => $limit]);
        $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $values;
    }

    /**
     * アイテムの追加
     *
     * @param array $posts
     * @return bool 成功した場合は true、失敗した場合は false
     */
    public function insert($posts)
    {
        try {
            $pdo = Database::getInstance();
            // TODO: SQL: 商品コード、商品名、価格、在庫数を登録
            $sql = "INSERT INTO items (code, name, price, stock) VALUES (:code, :name, :price, :stock)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute($posts);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * 商品情報の更新
     *
     * @param int $id 商品ID
     * @param array $fields 更新するフィールド（'code', 'name', 'price', 'stock' を含む）
     * @return bool 成功した場合は true、失敗した場合は false
     */
    public function update($id, $posts)
    {
        try {
            $pdo = Database::getInstance();

            // TODO: SQL: 商品コード、商品名、価格、在庫数を更新
            $sql = "";

            $stmt = $pdo->prepare($sql);

            // 更新データ + ID
            $posts['id'] = $id;

            return $stmt->execute($posts);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


    /**
     * 商品情報削除
     *
     * @param int $id
     * @return bool 成功した場合は true、失敗した場合は false
     */
    public function delete($id)
    {
        try {
            $pdo = Database::getInstance();
            // TODO: SQL: idを指定して削除
            $sql = "";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
