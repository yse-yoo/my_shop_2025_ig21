<?php

namespace App\Models;

use App\Models\Item;

class Cart
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
     * カートにアイテムを追加
     *
     * @param int $item_id 商品ID
     * @return void
     */
    public function addItem($item_id)
    {
        $item = new Item();
        $selectItem = $item->find($item_id);

        if ($selectItem) {
            // TODO: 商品があればセッションに登録
            // $_SESSION[APP_KEY]['cart_items'][$item_id];
        }
    }

    /**
     * カートにアイテム取得
     *
     * @return array
     */
    public function load()
    {
        // セッションから商品一覧取得
        return $_SESSION[APP_KEY]['cart_items'] ?? [];
    }

    /**
     * カートから削除
     *
     * @return bool
     */
    public function remove($item_id)
    {
        if (!empty($_SESSION[APP_KEY]['cart_items'][$item_id])) {
            // TODO: 商品があればセッションから削除
        }
    }
}
