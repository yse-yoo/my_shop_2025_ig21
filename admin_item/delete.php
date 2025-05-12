<?php 
require_once '../app.php';

use App\Models\Item;

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$id = sanitize($_POST['id']);
$item = new Item();
$item->delete($id);

// 成功の場合は、一覧画面にリダイレクト
header('Location: ./');
?>