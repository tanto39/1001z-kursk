<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/connect.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/functions.php";

if (!isset($_POST['sendorder'])) {
    echo "<div class='alert alert-success' style='margin-top: 20px;'>Добавьте товар в корзину для оформления заказа! </br><a href='/'>Перейти на главную</a></div>";
}
else {

    if (isset($_POST['name'])) {$name = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['name']))));}
    if (isset($_POST['phone'])) {$phone = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['phone']))));}
    if (isset($_POST['email'])) {$email = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['email']))));} else {$email="";}
    if (isset($_POST['items'])) {$postItems = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['items']))));} else {$postItems="";}
    if (isset($_POST['price'])) {$price = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['price']))));}
    if (isset($_POST['capcha'])) {$capcha = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['capcha']))));} else {$capcha = 0;}

    $cartItems = [];

    if ($capcha != 4) {echo "<div class='alert alert-success' style='margin-top: 20px;'>Вы ввели неправильное число - 2+2=4. Попробуйте еще раз!</div>";}
    else
    {
        if (empty($name) || empty($phone) || empty($email)) {
            echo "<div class='alert alert-success' style='margin-top: 20px;'>Пожалуйста, заполните поля имя, телефон, электронная почта.</div>";
        }
        elseif (empty($price) || empty($postItems)) {
            echo "<p>Пустой заказ!</p>";
        }
        else {
            $numOrder = rand(1000000, 2000000)."-".time();
            $cartItems = unserialize(base64_decode($postItems));
            $message = "Имя: $name </br>Телефон: $phone </br>Электронная почта: $email </br>Номер заказа: $numOrder</br>Сумма заказа $price руб.</br></br>Состав заказа:";

            if (count($cartItems) > 0) {
                $message .= '<table class="table table-bordered table-hover" border="1">
                <thead>
                <tr>
                    <th>Фирма</th>
                    <th>Номер</th>
                    <th>Наименование запчасти</th>
                    <th>Кол-во</th>
                    <th class="td-condensed">Цена</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>';

                foreach ($cartItems as $cartItem) {
                    $result = $clientAutopiter->GetPriceId(array("ID" => $cartItem['catalog_id'], "FormatCurrency" => 'РУБ', "SearchCross" => 0, "IdArticleDetail" => $cartItem['id']));
                    $items = $result->GetPriceIdResult->BasePriceForClient;

                    if (count($items) > 1) {
                        $message .= orderTblRowCreate($items[0], $cartItem['quantity']);
                    } else if (count($items) != 0) {
                        $message .= orderTblRowCreate($items, $cartItem['quantity']);
                    }
                }

                $message .= '</tbody></table>';
            }

            $toShop = "kursk-1001z@yandex.ru"; /*Укажите ваш адрес электоронной почты kursk-1001z@yandex.ru*/
            $headers = "Content-type: text/html; charset = utf-8";
            $subject = "Заказ ".$numOrder;
            $send = mail ($toShop, $subject, $message, $headers);
            $send2 = mail ($email, $subject, $message, $headers);


            if(isset($_COOKIE['basket-1001']))
                setcookie("basket-1001","",time()-3600,"/");

            if ($send == 'true')
            {
                if(isset($_COOKIE['basket-1001']))
                    setcookie("basket-1001","",time()-3600,"/");

                echo "<div class='alert alert-success' style='margin-top: 20px;'>Спасибо за отправку вашего сообщения! Мы вам обязательно перезвоним! Номер вашего заказа $numOrder </br><a href='/'>Перейти на главную</a></div>";
            }
            else
            {
                echo "<div class='alert alert-success' style='margin-top: 20px;'>Сообщение не отправлено! Попробуйте еще раз! </br><a href='/'>Перейти на главную</a></div>";
            }
        }
    }

}

