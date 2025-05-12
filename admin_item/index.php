<?php
require_once '../app.php';

use App\Models\Item;

// TODO: 商品一覧取得
$items = [];
$item = new Item();
$items = $item->fetch();
?>

<!DOCTYPE html>
<html lang="ja">

<?php include_once COMPONENT_DIR . 'head.php'; ?>

<body class="bg-gray-50 text-gray-800">
    <?php include_once COMPONENT_DIR . 'admin_nav.php'; ?>

    <main class="max-w-6xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">商品一覧</h2>

        <div class="mb-4">
            <a href="admin_item/input.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                新規
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-4 py-2">操作</th>
                        <th class="px-4 py-2">コード</th>
                        <th class="px-4 py-2">商品名</th>
                        <th class="px-4 py-2">価格</th>
                        <th class="px-4 py-2">在庫数</th>
                        <th class="px-4 py-2">更新日</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                    <?php if ($items): ?>
                        <?php foreach ($items as $item): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    <a href="admin_item/edit.php?id=<?= $item['id'] ?>" class="text-blue-600 hover:underline text-sm">編集</a>
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($item['code']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
                                <td class="px-4 py-2">&yen;<?= number_format($item['price']) ?></td>
                                <td class="px-4 py-2"><?= $item['stock'] ?></td>
                                <td class="px-4 py-2"><?= $item['updated_at'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">商品が見つかりません</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>