<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/connect.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/functions.php";
?>

<div id="wrapper">
    <h3>Информация</h3>
    <ul class="list-group">
        <li class="list-group-item">
            <h4>Данные расходной накладной</h4>
            <form action="" method="post">
                <input type="text" class="form-control" name="billNumber" style="display: inline-block;width: 320px;vertical-align: top;" />
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
            <?php if (isset($_POST["billNumber"])): ?>
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>Каталог</th>
                            <th>Номер детали</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Сумма</th>
                            <th>Количество</th>
                            <th>Баркод</th>
                            <th>Комментарий</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //Данные расходной накладной
                    //http://service.autopiter.ru/price.asmx?op=GetBill
                        $bills = $client->GetBill(array("billNumber"=>$_POST["billNumber"]))->GetBillResult->BillInfo;
                        //Проверка один элемент или несколько, если один то он возвращается объектом, а не массивом
                        if (count($bills) > 1) {
                            foreach ($bills as $item) {
                                informationSalesInvoice($item);
                            }
                        } else {
                            informationSalesInvoice($bills);
                        }
                    ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </li>
        <li class="list-group-item">
            <h4>Получение информации об отказанных в поставке позициях в пределах заданного периода</h4>
            <form action="" method="post">
                Дата с <input type="text" class="form-control dtStart" name="dtStart" style="display: inline-block;width: 120px;vertical-align: top;" />
                по <input type="text" class="form-control dtFinish" name="dtFinish" style="display: inline-block;width: 120px;vertical-align: top;" />
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
            <?php if ($_POST["dtStart"] && $_POST["dtFinish"]): ?>
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>Номер счёта</th>
                            <th>Каталог</th>
                            <th>Номер</th>
                            <th>Причина отказа</th>
                            <th>Количество в отказе</th>
                            <th>Дата заказа</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //Получение информации об отказанных в поставке позициях в пределах заданного периода.
                    //http://service.autopiter.ru/price.asmx?op=GetFailuresDelivery
                    $failures = $client->GetFailuresDelivery(array("dtStart"=>strtotime($_POST["dtStart"]), "dtFinish"=>strtotime($_POST["dtFinish"])))->GetFailuresDeliveryResult->RefusingDelivery;
                    //Проверка один элемент или несколько, если один то он возвращается объектом, а не массивом
                    if (count($failures) > 1) {
                        foreach ($failures as $item) {
                            informationFailures($item);
                        }
                    } else {
                        informationFailures($failures);
                    }
                    ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </li>
        <li class="list-group-item">
            <h4>Получение информации о позициях в счете по номеру счета</h4>
            <form action="" method="post">
                <input type="text" class="form-control" name="invoiceNumber" style="display: inline-block;width: 320px;vertical-align: top;" />
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
            <?php if ($_POST["invoiceNumber"]): ?>
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Регион</th>
                        <th>Каталог</th>
                        <th>Номер детали</th>
                        <th>Наименование</th>
                        <th>Коммент</th>
                        <th>Заказано/Выдано</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <th>Дата статуса</th>
                        <th>Доставка</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        //http://service.autopiter.ru/price.asmx?op=GetFullInvoiceOrder
                        $invoice = $client->GetFullInvoiceOrder(array("NumberInvoice"=>$_POST["invoiceNumber"]))->GetFullInvoiceOrderResult->OrderInformation;
                        echo "<td>".$invoice->OrderDate."</td>";
                        echo "<td>".$invoice->Region."</td>";
                        echo "<td>".$invoice->Catalog."</td>";
                        echo "<td>".$invoice->DetailNumber."</td>";
                        echo "<td>".$invoice->DetailName."</td>";
                        echo "<td>".$invoice->Comment."</td>";
                        echo "<td>".$invoice->OrderCount."/".$invoice->GetCount."</td>";
                        echo "<td>".(floor($invoice->Price))."</td>";
                        echo "<td>".$invoice->Status->Name."</td>";
                        echo "<td>".$invoice->StatusDate."</td>";
                        echo "<td>".$invoice->WaitingSpbDate."</td>";
                        ?>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </li>
        <li class="list-group-item">
            <h4>Получение информации о счетах за указанный промежуток даты</h4>
            <form action="" method="post">
                Дата с <input type="text" class="form-control dtStart" name="invoicesDtStart" style="display: inline-block;width: 120px;vertical-align: top;" />
                по <input type="text" class="form-control dtFinish" name="invoicesDtFinish" style="display: inline-block;width: 120px;vertical-align: top;" />
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
           <?php if (isset($_POST["invoicesDtStart"]) && isset($_POST["invoicesDtFinish"])): ?>
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                    <tr>
                        <th>id счёта</th>
                        <th>Дата отправки</th>
                        <th>Количество в отказе</th>
                        <th>Дата счёта</th>
                        <th>Валюта</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //http://service.autopiter.ru/price.asmx?op=GetInvoiceOrderByDateTime
                    $invoices = $client->GetInvoiceOrderByDateTime(array("dtFirst"=>strtotime($_POST["invoicesDtStart"]), "dtSecond"=>strtotime($_POST["invoicesDtFinish"])))->GetInvoiceOrderByDateTimeResult->Invoice;
                    //Проверка один элемент или несколько, если один то он возвращается объектом, а не массивом
                    if (count($invoices) > 1) {
                        foreach ($invoices as $item) {
                            informationInvoices($item);
                        }
                    } else {
                        informationInvoices($invoices);
                    }
                    ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </li>
        <li class="list-group-item">
            <h4>Получение информации о счете по номеру счета</h4>
            <form action="" method="post">
                <input type="text" class="form-control" name="invoiceNumberSingle" style="display: inline-block;width: 320px;vertical-align: top;" />
                <button type="submit" class="btn btn-primary">Найти</button>
            </form>
            <?php if (isset($_POST["invoiceNumberSingle"])): ?>
                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                    <thead>
                    <tr>
                        <th>id счёта</th>
                        <th>Дата отправки</th>
                        <th>Количество в отказе</th>
                        <th>Дата счёта</th>
                        <th>Валюта</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        //http://service.autopiter.ru/price.asmx?op=GetInvoiceOrderByNumberInvoice
                        $invoice = $client->GetInvoiceOrderByNumberInvoice(array("NumberInvoice"=>$_POST["invoiceNumberSingle"]))->GetInvoiceOrderByNumberInvoiceResult;
                        echo "<td>".$invoice->IdInvoice."</td>";
                        echo "<td>".$invoice->DateSend."</td>";
                        echo "<td>".$invoice->Quantity."</td>";
                        echo "<td>".$invoice->DateInvoice."</td>";
                        echo "<td>".$invoice->Currency."</td>";
                        echo "<td>".(floor($invoice->Summ))."</td>";
                        ?>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </li>
    </ul>
</div>
<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/ui/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.datepicker-ru.js"></script>
<script type="text/javascript">
    $(function(){
        $(".dtStart, .dtFinish").datepicker( $.datepicker.regional[ "ru" ] );
        $(".dtStart").datepicker({
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                $(this).closest('form').find('.dtFinish').datepicker( "option", "minDate", selectedDate );
            }
        });
        $(".dtFinish").datepicker({
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                $(this).closest('form').find('.dtStart').datepicker( "option", "minDate", selectedDate );
            }
        });
    });
</script>
