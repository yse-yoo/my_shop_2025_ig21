<?php
// env.php を読み込み
require_once '../app.php';

use App\Models\Cart;

// item_id パラメータがあればカート追加
if (isset($_GET['item_id'])) {
    $cart = new Cart();
    $cart->addItem($_GET['item_id']);
}

// カートデータの取得
$cart = new Cart();
$cart_items = $cart->load();
?>

<!DOCTYPE html>
<html lang="ja">

<?php include_once COMPONENT_DIR . 'head.php'; ?>

<body class="bg-gray-100 text-gray-800">
    <?php include_once COMPONENT_DIR . 'nav.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-6">ショッピングカート</h2>

        <div class="mb-6 text-center">
            <a href="products/" class="text-blue-600 hover:underline">← 商品一覧に戻る</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php if ($cart_items) : ?>
                <?php foreach ($cart_items as $cart_item) : ?>
                    <div class="bg-white shadow-md rounded-xl p-4 flex flex-col justify-between">
                        <div>
                            <h5 class="text-xl font-semibold mb-2"><?= htmlspecialchars($cart_item['name']) ?></h5>
                            <p class="text-red-600 font-bold mb-3">&yen;<?= number_format($cart_item['price']) ?></p>
                        </div>
                        <div>
                            <a href="cart/remove.php?item_id=<?= $cart_item['id'] ?>" class="text-sm text-red-500 hover:underline">削除</a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <div class="mt-10 text-center">
            <?php if (!empty($cart_items)) : ?>
                <p class="mb-4">この内容で購入しますか？</p>
                <form action="" method="post">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                        購入
                    </button>
                </form>
            <?php else : ?>
                <p class="text-gray-500 mt-6">カートに商品がありません</p>
            <?php endif ?>
        </div>
    </main>
</body>

</html>
