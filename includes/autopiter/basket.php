<?php
    require_once "connect.php";
    require_once "functions.php";
    //если существет post id элемента заказа и кол-во
    if (isset($_POST["id-item-order"]) && isset($_POST["basket-qty"])) {
        $client->UpdateQtyItemCart(array("id"=>$_POST["id-item-order"], "qty"=>$_POST["basket-qty"]));
    }
    //Если существует post id для удаления
    if (isset($_POST["id-item-order-delete"])) {
        $client->DeleteItemCart(array("id"=>$_POST["id-item-order-delete"]));
    }

    //Если редактировался комментарий
    if(isset($_POST["id-comment"])) {
        if(isset($_POST["commentAll"])){
            $commentAll = true;
        } else {
            $commentAll = false;
        }
        $client->SaveCommentForItemCart(array("id"=>$_POST["id-comment"], "comment"=>$_POST["item-comment"], "isAll"=>$commentAll));
    }

    //Очистка корзины
    //http://service.autopiter.ru/price.asmx?op=ClearBasket
    if (isset($_POST["clear-basket"])) {
        $client->ClearBasket();
    }

    //оформление заказа
    if (isset($_POST["make-order"])) {
        $order = $client->MakeOrderFromBasket()->MakeOrderFromBasketResult;
    }

    $cartItems = $client->GetBasket()->GetBasketResult->ItemCart;
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Веб-сервис Autopiter</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/common.css" rel="stylesheet" />
    </head>
    <body>
        <div id="wrapper">
            <h2>Пример работы веб-сервиса Автопитер на PHP</h2>
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
                                <th>Комментарий</th>
                                <th>Кол-во</th>
                                <th class="td-condensed">Цена</th>
                                <th>Сумма</th>
                                <th class="td-condensed"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resultCost = 0;
                            if (count($cartItems) > 1) {
                                foreach ($cartItems as $item) {
                                    cartTblRowCreate($item);
                                    $resultCost += $item->Cost * $item->Quantity;
                                }
                            } else {
                                cartTblRowCreate($cartItems);
                                $resultCost += $cartItems->Cost * $cartItems->Quantity;
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
                    <div class="basket-controls">
                        <form action="" method="post">
                            <input type="hidden" name="clear-basket" />
                            <button class="btn btn-default btn-lg" type="submit">Очистить корзину</button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="make-order" />
                            <button class="btn btn-success btn-lg" type="submit">Оформить заказ</button>
                        </form>
                    </div>
                <?php } ?>

                <?php
                    if (!isset($_POST["make-order"]) && count($cartItems) == 0){
                        echo "Ваша корзина пуста!";
                    }
                ?>

                <?php
                    if (isset($_POST["make-order"])) {
                        if (isset($order->NumberInvoice)) {
                            echo "Ваш заказ успешно оформлен! Номер счёта: ".$order->NumberInvoice. ".";
                        } else {
                            echo "Произошла ошибка оформления смотрите что получили в ответе.";
                        }
                    }
                ?>
            </div>
        </div>
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" action="" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" name="item-comment" rows="3"></textarea>
                        <div class="checkbox">
                            <label>
                                <input id="commentAll" type="checkbox" value="commentAll" name="commentAll" />
                                Добавить ко всем позициям в корзине
                            </label>
                        </div>
                        <input id="id-comment" name="id-comment" type="hidden" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $('.modal').on('show.bs.modal', function (e) {
                    var self = $(this),
                        btn = $(e.relatedTarget);
                    self.find('textarea').val(btn.text()).end().find('#id-comment').val(btn.attr('data-id'));
                });
            });
        </script>
    </body>
</html>