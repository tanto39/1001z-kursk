
<div id="wrapper">
    <form id="search-number" method="get" name="form1">
        <div class="form-group flex autopiter-top-block">
            <div class="autopiter-search flex-50">
                <div class="autopiter-title">Поиск запчасти по номеру детали</div>
                <input type="text" class="form-control" id="SearchNumber" placeholder="Введите номер детали" name="searchStr" value="<?= trim($_GET['searchStr'])?>" />
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
            <div class="flex-50">
                <a class="catalog-link-all" href="https://www.parts-catalogs.com/#/catalogs" target="_blank">Узнать номер детали</a>
                <a class="catalog-link-all basket-button" href="/basket">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span>Перейти в корзину</span>
                </a>
            </div>
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
                    $result = $clientAutopiter->FindCatalog (array("ShortNumberDetail"=>$str));
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
                            $result2 = $clientAutopiter->GetPriceId(array("ID"=>$idDetail, "FormatCurrency" => 'РУБ', "SearchCross"=>0,"IdArticleDetail"=>null));
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

                <div id="modal-info" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <div class="modal-body">
                                <div class="body-info"></div>
                                <a href="/basket">Перейти в корзину</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endif; ?>
</div>
