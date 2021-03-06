<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/connect.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/functions.php";

    //Добавляем позицию, если в post есть id детали
    //http://service.autopiter.ru/price.asmx?op=InsertToBasket
    if ($_POST["IdDetail"]) {
        $checkItem = false;
        $defaultQty = 0;
        $defaultId = 0;
        //Получаем все элементы корзины
        $cartItems = $clientAutopiter->GetBasket()->GetBasketResult;
        $innerItems = $cartItems->ItemCart;
        if (count($innerItems) > 0) {
            foreach ($innerItems as $cartItem) {
                if ($cartItem->IdArticleDetail == $_POST["IdDetail"]){
                    $checkItem = true;
                    $defaultQty = $cartItem->Quantity;
                    $defaultId = $cartItem->Id;
                }
            }
        } else {
            if ($cartItems->IdArticleDetail == $_POST["IdDetail"]){
                $checkItem = true;
                $defaultQty = $cartItems->Quantity;
                $defaultId = $cartItem->Id;
            }
        }
        //Если в корзине нет такого продукта, то добавляем его, иначе обновляем кол-во
        if ($checkItem == false) {
            $clientAutopiter->InsertToBasket(
                array("items"=> array(
                    array(
                        "Catalog"=>$_POST["NameOfCatalog"],
                        "Comment"=>"",
                        "Cost"=>$_POST["SalePrice"],
                        "Id"=>null,
                        "IdArticleDetail"=>$_POST["IdDetail"],
                        "Name"=>$_POST["NameRus"],
                        "Number"=>$_POST["Number"],
                        "Quantity"=>$_POST["quantity"]
                    )
                ))
            );
        } else {
            $clientAutopiter->UpdateQtyItemCart(array("id"=>$defaultId, "qty"=>$defaultQty+$_POST["quantity"]));
        }
    }
?>