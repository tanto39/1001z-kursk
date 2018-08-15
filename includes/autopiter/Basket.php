<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.08.18
 * Time: 20:52
 */

namespace Enterkursk;


class Basket
{
    /**
     * @param $productId
     * @param $quantity
     * @param $catalog_id
     * @return string
     */
    public static function addToBasket ($productId, $quantity, $catalog_id)
    {
        $cookieArray = [];

        if (isset($_COOKIE['basket-1001']))
            $cookieArray = unserialize($_COOKIE['basket-1001']);

        $cookieArray[$productId] = [
            "id" => $productId,
            "quantity" => $quantity,
            "catalog_id" => $catalog_id
        ];

        setcookie ("basket-1001", serialize($cookieArray),time()+1200000, "/");

        return "Товар добавлен в корзину!";
    }

    /**
     * Delete item from basket
     * @param $productId
     */
    public static function deleteItemFromBasket ($productId)
    {
        $cookieArray = [];

        if (isset($_COOKIE['basket-1001']))
            $cookieArray = unserialize($_COOKIE['basket-1001']);

        unset($cookieArray[$productId]);
        setcookie ("basket-1001", serialize($cookieArray),time()+1200000, "/");
    }
}