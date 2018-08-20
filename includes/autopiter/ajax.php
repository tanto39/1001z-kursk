<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/connect.php";
    //Статистика выдачи детали
    //http://service.autopiter.ru/price.asmx?op=GetDeliveryPercentStore
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        $idDetailStat = $_POST['idDetailStat'];
        header('Content-Type: application/json');
        switch($action) {
            case 'getStatistic':
                echo json_encode( (array)$clientAutopiter->GetDeliveryPercentStore(array("idDetail"=>1530055))->GetDeliveryPercentStoreResult );
                break;
            case 'getInfo':
                echo json_encode( (array)$clientAutopiter->GetInfo(array("idDetail"=>1530055))->GetInfoResult);
                break;
        }
    }
?>