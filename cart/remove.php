<?php
require_once '../app.php';

use App\Models\Cart;

if (!empty($_GET['item_id'])) {
    $cart = new Cart();
    $cart->remove($_GET['item_id']);
}

// リダイレクト
header('Location: ./');