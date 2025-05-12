<?php
// env.php を読み込み
require_once '../app.php';

use App\Models\Item;

// TODO: id を取得
$id = 0;

$item = new Item();
$selectItem = $item->find($id);

// 商品が選択されていない場合は、商品一覧にリダイレクト
if (!$selectItem) {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="ja">

<?php include_once COMPONENT_DIR . 'head.php'; ?>

<body class="bg-gray-50 text-gray-800">
    <?php include_once COMPONENT_DIR . 'admin_nav.php'; ?>

    <main class="max-w-xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold mb-6 text-center">商品編集</h2>

        <form action="admin_item/update.php" method="post" class="space-y-6 bg-white p-6 rounded-lg shadow">
            <input type="hidden" name="id" value="<?= @$selectItem['id'] ?>">

            <!-- 商品コード -->
            <div>
                <label for="code" class="block text-sm font-medium mb-1">商品コード</label>
                <input id="code" type="text" name="code" value="<?= @$selectItem['code'] ?>"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <?php if (!empty($errors['code'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['code'] ?></p>
                <?php endif ?>
            </div>

            <!-- 商品名 -->
            <div>
                <label for="name" class="block text-sm font-medium mb-1">商品名</label>
                <input id="name" type="text" name="name" value="<?= @$selectItem['name'] ?>"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <?php if (!empty($errors['name'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['name'] ?></p>
                <?php endif ?>
            </div>

            <!-- 価格 -->
            <div>
                <label for="price" class="block text-sm font-medium mb-1">価格</label>
                <input id="price" type="text" name="price" value="<?= @$selectItem['price'] ?>"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <?php if (!empty($errors['price'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['price'] ?></p>
                <?php endif ?>
            </div>

            <!-- 在庫 -->
            <div>
                <label for="stock" class="block text-sm font-medium mb-1">在庫</label>
                <input id="stock" type="text" name="stock" value="<?= @$selectItem['stock'] ?>"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <?php if (!empty($errors['stock'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['stock'] ?></p>
                <?php endif ?>
            </div>

            <!-- ボタン -->
            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
                    更新
                </button>
                <a href="admin_item/" class="text-blue-600 hover:underline text-sm">← 戻る</a>
            </div>
        </form>

        <!-- 削除ボタン -->
        <form action="admin_item/delete.php" method="post" class="mt-6 text-center">
            <input type="hidden" name="id" value="<?= $selectItem['id'] ?>">
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg text-sm"
                onclick="return confirm('削除してよいですか？')">
                削除
            </button>
        </form>
    </main>
</body>

</html>