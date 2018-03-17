<?php
if (isset($_POST['name'])) {$name = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['name']))));}
if (isset($_POST['phone'])) {$phone = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['phone']))));}
if (isset($_POST['marka'])) {$marka = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['marka']))));} else {$marka = "не указана";}
if (isset($_POST['vin'])) {$vin = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['vin']))));} else {$vin = "не указан";}
if (isset($_POST['mess'])) {$mess = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['mess']))));} else {$mess = "не указана";}
if (isset($_POST['capcha'])) {$capcha = htmlspecialchars(trim(stripcslashes(strip_tags($_POST['capcha']))));}

if ($capcha != 4) {echo "<p>Вы ввели неправильное число - 2+2=4. Попробуйте еще раз!</p>";}
else
{
    if (empty($name) || empty($phone))
    {
        echo "<p>Пожалуйста, заполните поля имя и телефон.</p>";
    }
    else
    {
        $to = "kursk-1001z@yandex.ru"; /*Укажите ваш адрес электоронной почты*/
        $headers = "Content-type: text/plain; charset = utf-8";
        $subject = "Сообщение с вашего сайта";
        $message = "Имя: $name \nТелефон: $phone \nМарка автомобиля: $marka \nVIN: $vin \nДеталь, год выпуска: $vin";
        $send = mail ($to, $subject, $message, $headers);

        if ($send == 'true')
        {
            echo "<p>Спасибо за отправку вашего сообщения! Мы вам обязательно перезвоним!</p>";
        }
        else
        {
            echo "<p>Сообщение не отправлено! Попробуйте еще раз!</p>";
        }
    }
}

