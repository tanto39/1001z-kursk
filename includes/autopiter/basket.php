<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/connect.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/functions.php";

    $cartItems = [];

    if (isset($_COOKIE['basket-1001']))
        $cartItems = unserialize($_COOKIE['basket-1001']);

?>

<div id="wrapper">
    <div>
        <h3>Корзина</h3>
        <?php
        if (count($cartItems) > 0) { ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Фирма</th>
                        <th>Номер</th>
                        <th>Наименование запчасти</th>
                        <th>Кол-во</th>
                        <th class="td-condensed">Цена</th>
                        <th>Сумма</th>
                        <th class="td-condensed"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resultCost = 0;

                    foreach ($cartItems as $cartItem) {
                        $result = $clientAutopiter->GetPriceId(array("ID"=> $cartItem['catalog_id'], "FormatCurrency" => 'РУБ', "SearchCross"=>0,"IdArticleDetail"=>$cartItem['id']));
                        $items = $result->GetPriceIdResult->BasePriceForClient;

                        if (count($items) > 1) {
                            cartTblRowCreate($items[0], $cartItem['quantity']);
                            $resultCost += ($items[0]->SalePrice*1.23)->SalePrice*$cartItem['quantity'];
                        } else if (count($items) != 0) {
                            cartTblRowCreate($items, $cartItem['quantity']);
                            $resultCost += ($items->SalePrice*1.23)*$cartItem['quantity'];
                        }
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td>Итого:</td>
                        <td><?=$resultCost ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="form-basket">
                <form method="post" action="/order.php" id="basket-form">
                    <div class="form-zakaz">
                        <input class="form-name form-control" type="text" placeholder="Введите имя" required name="name" size="16" />
                        <input class="form-phone form-control" type="tel" placeholder="8**********" required pattern="(\+?\d[- .]*){7,13}" title="Международный, государственный или местный телефонный номер" name="phone" size="16" />
                        <input class="form-mail form-control" type="email" placeholder="email@email.ru" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" name="email" size="16" />
                        <input type="hidden" name="items" value='<?=base64_encode($_COOKIE['basket-1001'])?>'/>
                        <input type="hidden" name="price" value="<?=$resultCost?>"/>
                        <div class="form-input form-pd"><label class="label-inline">Даю согласие на обработку <a href="#" target="_blank" rel="noopener noreferrer">персональных данных</a>:</label><input class="checkbox-inline" type="checkbox" required="" name="pd" /></div>
                        <label>Защита от спама: введите сумму 2+2:</label><input class="form-control form-capcha" type="number" required name="capcha"/>
                    </div>
                </form>
            </div>

            <div class="basket-controls flex">
                <button class="btn btn-default btn-lg clearbasket" type="submit">Очистить корзину</button>
                <input class="btn btn-success btn-lg" type="submit" form="basket-form" value="Оформить заказ">
            </div>

        <?php } else {
            echo "<p class='text-center'>Корзина пуста!</p>";
        }?>


    </div>
</div>

