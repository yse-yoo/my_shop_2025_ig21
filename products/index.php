<?php
require_once '../app.php';

use App\Models\Item;

$item = new Item();
$items = $item->fetch();
?>

<!DOCTYPE html>
<html lang="ja">

<?php include_once COMPONENT_DIR . 'head.php'; ?>

<body class="bg-gray-100 text-gray-800">
    <?php include_once COMPONENT_DIR . 'nav.php'; ?>

    <main class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-center mb-6">商品一覧</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php if ($items) : ?>
                <?php foreach ($items as $item) : ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                        <div class="p-4 flex-1">
                            <h5 class="text-xl font-semibold mb-2"><?= htmlspecialchars($item['name']) ?></h5>
                            <p class="text-gray-600 mb-4">&yen;<?= number_format($item['price']) ?></p>
                            <a href="cart/?item_id=<?= $item['id'] ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                カートに入れる
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p class="col-span-3 text-center text-gray-500">商品が見つかりませんでした。</p>
            <?php endif ?>
        </div>
    </main>
</body>

</html>