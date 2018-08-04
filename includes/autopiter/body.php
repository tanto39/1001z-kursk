<?php
    require_once "connect.php";
    require_once "functions.php";

    //Добавляем позицию, если в post есть id детали
    //http://service.autopiter.ru/price.asmx?op=InsertToBasket
    if ($_POST["IdDetail"]) {
        $checkItem = false;
        $defaultQty = 0;
        $defaultId = 0;
        //Получаем все элементы корзины
        $cartItems = $client->GetBasket()->GetBasketResult;
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
            $client->InsertToBasket(
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
            $client->UpdateQtyItemCart(array("id"=>$defaultId, "qty"=>$defaultQty+$_POST["quantity"]));
        }
    }
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
            <h2>Пример работы веб-сервиса Автопитер на PHP <span class="pull-right"><a href="information.php">Информация</a></span></h2>
            <form id="search-number" action="" method="get" name="form1">
                <div class="form-group">
                    <?php
                    $isCartExist = $client->GetBasket()->GetBasketResult;
                    if (isset($isCartExist->ItemCart) || $isCartExist -> stdClass) {
                        echo "<div class='pull-right'>У вас в корзине есть товары. <a href='basket.php'>Перейти в корзину</a></div>";
                    }
                    ?>
                    <input type="text" class="form-control" id="SearchNumber" placeholder="Введите номер или название детали" name="searchStr" value="<?= trim($_GET['searchStr'])?>" />
                    <button class="btn btn-primary" type="submit">Поиск</button>
                </div>
            </form>
            <?php
                $str = trim($_GET['searchStr']);
                $idDetail = $_GET['idDetail'];
                if ($str != "" && !$idDetail): ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Фирма</th>
                                <th>Номер</th>
                                <th>Наименование запчасти</th>
                                <th class="t-ac">Найти</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Получаем каталоги из сервиса
                            // http://service.autopiter.ru/price.asmx?op=FindCatalog
                            $result = $client->FindCatalog (array("ShortNumberDetail"=>$str));
                            $items = $result->FindCatalogResult->SearchedTheCatalog;
                            //Проверка один элемент или несколько, если один то он возвращается объектом, а не массивом
                            if (count($items) > 1) {
                                foreach ($items as $item) {
                                    catalogTblRowCreate($item, $str);
                                }
                            } else {
                                if (count($items) != 0) {
                                    catalogTblRowCreate($items, $str);
                                } else {
                                    echo "<tr><td colspan='4'><h3 style='margin:0;'>Ничего не найдено!</h3></td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <?php
                    //Получаем по id все детали
                    //http://service.autopiter.ru/price.asmx?op=GetPriceId
                    if ($str != "" && $idDetail != ""): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Фирма</th>
                                    <th>Номер</th>
                                    <th>Наименование запчасти</th>
                                    <th>Наличие</th>
                                    <th>Цена</th>
                                    <th class="td-condensed">Срок поставки, дней</th>
                                    <th class="td-condensed">Выдача</th>
                                    <th class="td-condensed">Инф-ия</th>
                                    <th>Заказ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result2 = $client->GetPriceId(array("ID"=>$idDetail, "FormatCurrency" => 'РУБ', "SearchCross"=>0,"IdArticleDetail"=>null));
                                    $items = $result2->GetPriceIdResult->BasePriceForClient;
                                    if (count($items) > 1) {
                                        foreach ($items as $item) {
                                            detailsTblRowCreate($item);
                                        }
                                    } else {
                                        if (count($items) != 0) {
                                            detailsTblRowCreate($items);
                                        } else {
                                            echo "<tr><td colspan='4'><h3 style='margin:0;'>Ничего не найдено!</h3></td></tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                <?php endif; ?>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            //Javascript функция получения статистики по детали
            function getStatistic(e, id, action) {
                var self = $(e);
                self.on("mouseleave", function(){
                    $(this).popover('destroy').unbind("mouseleave");
                });
                if (self.attr('data-content') == undefined) {
                    $.ajax({
                        url: "ajax.php",
                        data: {
                            action: action,
                            idDetailStat: id
                        },
                        type: 'post',
                        success: function(output) {
                            var str = "";
                            if (action === 'getStatistic') {
                                for (var i = 0, len = output.StatStore.length; i < len; i++) {
                                    str += "<span class='vl'><span class='l-vl'>Срок, дней:</span>" + output.StatStore[i].Day + "<span class='r-vl'>Доставлено, %: </span>"+ output.StatStore[i].PercentInDay + "</span>";
                                }
                            } else {
                                str += "<span class='vl'><b>Время, когда будет отправлен заказ поставщику</b>: "+output.DateOrdering+"</span>";
                                str += "<span class='vl'><b>Дата последнего обновления прайса</b>: "+output.DateLastUpdated+"</span><br/>";
                                str += "<span class='vlb'><b>Мин. сумма клиентских заказов</b>: "+output.MinSummOrdering +"</b></span><br/>";
                                str += "<span class='vlb'><b>Условия работы</b>: "+output.Condition +"</b></span>";
                                str += "<span class='vlb'><b>Дополнительные условия</b>: "+output.ExtraCondition  +"</b></span><br/>";
                                str += "<span class='vlb'><b>Габаритная деталь</b>: "+output.IsBig  +"</b></span>";
                                str += "<span class='vlb'><b>Процент отказов</b>: "+output.PercentageRefusal  +"</b></span>";
                            }

                            self.popover({
                                html: true
                            }).attr("data-content", str).popover('show');
                        }
                    });
                } else {
                    self.popover({
                        html: true
                    }).popover('show');
                }
            }
        </script>
    </body>
</html>