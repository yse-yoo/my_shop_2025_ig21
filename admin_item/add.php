<?php 
// app.php を読み込み
require_once '../app.php';

use App\Models\Item;

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// サニタイズ
$posts = sanitize($_POST);

// データベースに接続
$item = new Item();
// TODO: バリデーション
$errors = $item->validate($posts);

// TODO: 商品コードの重複チェック
$findItem = $item->findByCode($posts['code']);
if ($findItem) {
    $errors['code'] = 'この商品コードはすでに使用されています。';
}

if (!empty($errors)) {
    // TODO: エラーがある場合は、エラーメッセージをセッションに保存
    $_SESSION[APP_KEY]['errors'] = $errors;

    // item セッションに保存
    $_SESSION[APP_KEY]['item'] = $posts;

    header('Location: ./input.php');
    exit;
}

$item->insert($posts);

// 成功の場合は、一覧画面にリダイレクト
header('Location: ./');
?>