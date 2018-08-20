<?php
//Документация по веб-сервису http://service.autopiter.ru/price.asmx

/*Если ваша версия выше php 5.0.1, то вы можете воспользрваться встроенным классом
SoapClient, иначе необходимо использовать библиотеку NuSoap или др. В данном случае используем
встроенные возможности php. http://php.net/manual/en/book.soap.php */

//при создании объекта по структуре сервиса указание "http://" в ссылке ОБЯЗАТЕЛЬНО!
$clientAutopiter = new SoapClient("http://service.autopiter.ru/price.asmx?WSDL");

//http://service.autopiter.ru/price.asmx?op=IsAuthorization
if (!($clientAutopiter->IsAuthorization()->IsAuthorizationResult)) {
    //http://service.autopiter.ru/price.asmx?op=Authorization
    //UserID - ваш клиентский id, Password - ваш пароль
    $clientAutopiter->Authorization(array("UserID"=>"138982", "Password"=>"1qaz2wsx", "Save"=> "true"));
}