<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/includes/autopiter/Basket.php";

if (isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $productId = htmlspecialchars(trim(stripcslashes(strip_tags($_POST["productId"]))));
    $quantity = htmlspecialchars(trim(stripcslashes(strip_tags($_POST["quantity"]))));
    $quantity = htmlspecialchars(trim(stripcslashes(strip_tags($_POST["quantity"]))));
    $catalog_id = htmlspecialchars(trim(stripcslashes(strip_tags($_POST["catalog_id"]))));

    $addResult = \Enterkursk\Basket::addToBasket($productId, $quantity, $catalog_id);

    echo $addResult;
}

if (isset($_POST["deleteProductId"])) {
    $deleteProductId = htmlspecialchars(trim(stripcslashes(strip_tags($_POST["deleteProductId"]))));
    \Enterkursk\Basket::deleteItemFromBasket($deleteProductId);
}