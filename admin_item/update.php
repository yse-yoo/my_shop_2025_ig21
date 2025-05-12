<?php 
// env.php を読み込み
require_once '../app.php';

use App\Models\Item;

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$posts = sanitize($_POST);

$item = new Item();
$item->update($posts['id'], $posts);

header("Location: edit.php?id={$posts['id']}");
?>