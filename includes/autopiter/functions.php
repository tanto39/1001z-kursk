<?php

//Функци рендеринга таблицы поиска каталога
//$item - объект или массив объектов
//$searchCat - искомый номер для генерации ссылки
function catalogTblRowCreate($item, $searchCat) {
    echo "<tr>";
    echo "<td>" . $item->Name . "</td>";
    echo "<td>" . $item->ShortNumber . "</td>";
    echo "<td>" . $item->NameDetail . "</td>";
    echo "<td class='t-ac'>
            <a class='search-link' href='/?searchStr=" . $searchCat ."&idDetail=" . $item->id . "'>
                <span class='glyphicon glyphicon-search'></span>
            </a>
        </td>";
    echo "</tr>";
}

//Функци рендеринга таблицы поиска деталей
//$item - объект или массив объектов
function detailsTblRowCreate($item) {
    echo "<tr>";
    echo "<td>" . $item->NameOfCatalog . "</td>";
    echo "<td>" . $item->ShotNumber . "</td>";
    echo "<td>" . $item->NameRus . "</td>";
    echo "<td class='ofAval'>" .(($item->NumberOfAvailable)? $item->NumberOfAvailable: '<span class="glyphicon glyphicon-ok"></span>'). "</td>";
    echo "<td>" . round($item->SalePrice*1.23) . "</td>";
    echo "<td>" . $item->NumberOfDaysSupply . "</td>";
    echo "<td class='cell-stat'><span class='glyphicon glyphicon-tasks' onclick='getStatistic(this, ".$item->IdDetail.", \"getStatistic\")' data-container='body' data-toggle='popover' data-placement='left' title='Посмотреть статистику'></span></td>";
    echo "<td class='cell-info'><span class='glyphicon glyphicon-info-sign' onclick='getStatistic(this, ".$item->IdDetail.", \"getInfo\")' data-container='body' data-toggle='popover' data-placement='left' title='Посмотреть информацию'></span></td>";
    echo "<td class='td-order nowrap'>
            <form method='POST' action=''>
            <input type='text' class='form-control col-xs-2 quantity' value='".(($item->MinNumberOfSales)? $item->MinNumberOfSales: '1')."' name='quantity' />
            <button data-target=\"#modal-info\" data-toggle=\"modal\" class='glyphicon glyphicon-shopping-cart addtobasket' data-number='".$item->IdDetail."' data-catalog_id='".$item->ID."'></button>
            <input type='hidden' value='".$item->IdDetail."' name='IdDetail' />
            <input type='hidden' value='".$item->NameOfCatalog."' name='NameOfCatalog' />
            <input type='hidden' value='".$item->SalePrice."' name='SalePrice' />
            <input type='hidden' value='".$item->DeliveryDate."' name='DeliveryDate' />
            <input type='hidden' value='".$item->NameRus."' name='NameRus' />
            <input type='hidden' value='".$item->Number."' name='Number' />
            <input type='hidden' value='".$item->ID."' name='ID' />
            </form>
        </td>";
    echo "</tr>";
}

//Функци рендеринга таблицы в корзине
function cartTblRowCreate($item, $quantity) {
    $newPrice = round($item->SalePrice*1.23);
    echo "<tr>";
    echo "<td>" . $item->NameOfCatalog . "</td>";
    echo "<td>" . $item->Number . "</td>";
    echo "<td>" . $item->NameRus . "</td>";
    echo "<td>
            <form action='' method='post'>
                <input class='basket-qty' type='text' value='" . $quantity . "' name='basket-qty' />
                <input type='hidden' value='".$item->Id."' name='id-item-order' />
            </form>
        </td>";
    echo "<td>" . $newPrice . "</td>";
    echo "<td>". $newPrice*$quantity . "</td>";
    echo "<td>
            <form action='' method='post'>
                <button type='submit' data-product_id='" . $item->IdDetail . "' class='glyphicon glyphicon-remove delete-item-basket'></button>
            </form>
        </td>";
    echo "</tr>";
}

//Функция рендеринга таблицы для отправки письма о заказе
function orderTblRowCreate($item, $quantity) {
    $newPrice = round($item->SalePrice*1.23);
    $result = "";
    $result .= "<tr>";
    $result .= "<td>" . $item->NameOfCatalog . "</td>";
    $result .= "<td>" . $item->Number . "</td>";
    $result .= "<td>" . $item->NameRus . "</td>";
    $result .= "<td>" . $quantity . "</td>";
    $result .= "<td>" . $newPrice . "</td>";
    $result .= "<td>". $newPrice*$quantity . "</td>";
    $result .= "</tr>";

    return $result;
}

//Функция рендеринга расходных накладных
function informationSalesInvoice($item) {
    echo "<tr>";
    echo "<td>" . $item->CatalogB . "</td>";
    echo "<td>" . $item->ArticleB . "</td>";
    echo "<td>" . $item->NameB . "</td>";
    echo "<td>" . $item->CostB . "</td>";
    echo "<td>" . $item->SummaB . "</td>";
    echo "<td>" . $item->QuantityB . "</td>";
    echo "<td>" . $item->BarCodeI . "</td>";
    echo "<td>" . $item->CommentI . "</td>";
    echo "</tr>";
}

function informationFailures($item) {
    echo "<tr>";
    echo "<td>" . $item->NumberInvoice . "</td>";
    echo "<td>" . $item->NameOfCatalog . "</td>";
    echo "<td>" . $item->Number . "</td>";
    echo "<td>" . $item->ReasonForFailure . "</td>";
    echo "<td>" . $item->Quantity . "</td>";
    echo "<td>" . $item->DateTimeOrder . "</td>";
    echo "</tr>";
}

function informationInvoices($item) {
    echo "<tr>";
    echo "<td>" . $item->IdInvoice . "</td>";
    echo "<td>" . $item->DateSend . "</td>";
    echo "<td>" . $item->Quantity . "</td>";
    echo "<td>" . $item->DateInvoice . "</td>";
    echo "<td>" . $item->Currency . "</td>";
    echo "<td>" . (floor($item->Summ)) . "</td>";
    echo "</tr>";
}