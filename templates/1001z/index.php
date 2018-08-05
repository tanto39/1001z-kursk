<?php
 /**
 * Template for Joomla by Gutnev Andrey
 * @author     Gutnev Andrey
 * @copyright  Copyright (c) 2017
 * @license    GNU GPL
 */
 defined('_JEXEC') or die('Restricted access');
$mytitle = JFactory::getDocument()->getTitle();
 ?>
 <?php $uri = preg_replace("/\?.*/i",'', $_SERVER['REQUEST_URI']);
 
if ((!strpos($uri, 'administrator'))  && (strlen($uri)>1)) {
  if (rtrim($uri,'/')!=$uri) {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://'.$_SERVER['SERVER_NAME'].str_replace($uri, rtrim($uri,'/'), $_SERVER['REQUEST_URI']));
    exit();    
  }
}

// Include autopiter
 require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/head.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta content="telephone=no" name="format-detection">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
unset($this->_generator); 
  $this->setGenerator('Дизайн, верстка, натяжка на CMS Гутнев Андрей - enterkursk.ru');
?>

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
	<link href="/templates/1001z/css/style.css" rel="stylesheet" type="text/css">
	<link href="/templates/1001z/js/ui/jquery-ui.css" rel="stylesheet" type="text/css">
	<script defer src="/templates/1001z/js/jquery-3.1.1.min.js"></script>
	<script defer src="/templates/1001z/js/bootstrap.min.js"></script>
    <script defer src="/templates/1001z/js/ui/jquery-ui-1.10.4.custom.min.js"></script>
	<script defer src="/templates/1001z/js/scripts.js"></script>

	<!--[if IE]>
	<script src="/templates/1001z/js/iehtmlfix.js"></script>
	<![endif]-->
	<jdoc:include type="head" />
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-43331430-5', 'auto');
	  ga('send', 'pageview');

	</script>
</head>

<body>

<header class="header" id="header">

	<div class="container center-header">
		<div class="row header-flex">
			<div class="col-md-5 header-left">
				<div class="header-title">1001<span>Z</span>-kursk.ru</div>
				<div class="top-address"><i class="glyphicon glyphicon-tags"></i> г. Курск, просп. Победы, 50</div>
			</div>

			<div class="col-md-2 logo">
				<a href="<?php echo $uri != '/' ? '/' : '#'?>"><img src="images/logo.png" alt="1001 запчасть Курск" title="1001 запчасть Курск"></a>
			</div>

			<div class="col-md-5 header-right">
				<div class="top-tel-wrap">
					<div class="top-tel-box">
						<div class="top-tel">+7 (4712) 39-89-58</div>
						<div class="top-tel">+7 (950) 873-41-65</div>
					</div>
					<svg width="50" height="50" class="svg-tel hidden-sm hidden-xs" style="float: right; margin: 10px;" xmlns="http://www.w3.org/2000/svg">
						<g>
							<title>Телефон</title>
							<path stroke="null" id="svg_4" fill="#418443" d="m47.972827,38.415116l-7.373162,-7.373985c-1.468597,-1.462699 -3.900623,-1.418259 -5.420381,0.102049l-3.714631,3.713808c-0.234685,-0.129344 -0.477599,-0.264449 -0.732996,-0.407784c-2.34575,-1.29975 -5.556309,-3.081215 -8.934755,-6.462129c-3.388459,-3.388047 -5.171569,-6.603544 -6.475297,-8.950803c-0.137574,-0.248675 -0.269387,-0.488435 -0.399554,-0.716125l2.493063,-2.489359l1.225683,-1.227191c1.522091,-1.522502 1.564062,-3.953842 0.098894,-5.420793l-7.373162,-7.374808c-1.465168,-1.464894 -3.898291,-1.420453 -5.420381,0.102049l-2.07801,2.089943l0.056785,0.056374c-0.696785,0.889086 -1.279039,1.914512 -1.712335,3.020315c-0.399417,1.052584 -0.648092,2.057024 -0.7618,3.063521c-0.973578,8.071181 2.714717,15.447635 12.724276,25.457331c13.836251,13.835291 24.986453,12.790114 25.467481,12.73909c1.047646,-0.125229 2.051674,-0.37555 3.072025,-0.771813c1.096201,-0.428221 2.120941,-1.009652 3.009479,-1.704928l0.045401,0.040326l2.105168,-2.061413c1.518936,-1.522228 1.562691,-3.95439 0.098208,-5.423673l0.000001,-0.000002z"/>
						</g>
					</svg>
				</div>
				<a class="top-mail" href="mailto:kursk@1001z.ru"><i class="glyphicon glyphicon-envelope"></i>kursk-1001z@yandex.ru</a>
			</div>
		</div>
	</div>

</header><!-- .header-->

<div class="topmenu-wrap">
	<div class="container navbar navbar-default topmenu">
		<nav class="col-sm-8">
			<!-- Toggle menu for mobile display -->
			<div class="navbar-header">
				<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<!-- default menu -->
			<div id="navbarCollapse" class="collapse navbar-collapse">
				<jdoc:include type="modules" name="topmenu"/>
			</div>
		</nav>

		<div class="col-sm-4 search-wrap">
			<jdoc:include type="modules" name="search" style="xhtml"/>
		</div>
	</div>



</div>

<!-- Карусель -->
<section id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
	<!-- Индикаторы для карусели -->
	<ol class="carousel-indicators">
		<!-- Перейти к 0 слайду карусели с помощью соответствующего индекса data-slide-to="0" -->
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<!-- Перейти к 1 слайду карусели с помощью соответствующего индекса data-slide-to="1" -->
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<!-- Перейти к 2 слайду карусели с помощью соответствующего индекса data-slide-to="2" -->
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<!-- Слайды карусели -->
	<div class="carousel-inner">
		<!-- Слайды создаются с помощью контейнера с классом item, внутри которого помещается содержимое слайда -->
		<div class="active item">
			<div class="container carousel-item-center center-block">
					<div class="col-sm-5 col-md-4">
						<img class="carousel-img" src="images/kachestvo1.jpg" alt="Официальные поставщики" title="Официальные поставщики">
					</div>

					<div class="col-sm-7 col-md-8 carousel-desc">
						<h2>Официальные поставщики.</h2>
						<div class="carousel-caption">
							<p>Долговечность, надежность и износостойкость деталей. <br/> Оптовые цены.</p>
						</div>
					</div>
			</div>
		</div>
		<!-- Слайд №2 -->
		<div class="item item-1">
			<div class="container carousel-item-center center-block">
				<div class="col-sm-5 col-md-4">
					<img class="carousel-img" src="images/kachestvo2.jpg" alt="Широкий диапазон запчастей" title="Широкий диапазон запчастей">
				</div>

				<div class="col-sm-7 col-md-8 carousel-desc">
					<h2>Широкий диапазон запчастей.</h2>
					<div class="carousel-caption">
						<p>У нас найдется запчасть на любой автомобиль. <br/> Более 20000 позиций на складе.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Слайд №3 -->
		<div class="item item-2">
			<div class="container carousel-item-center center-block">
				<div class="col-sm-5 col-md-4">
					<img class="carousel-img" src="images/kachestvo3.jpg" alt="Настоящие профессионалы" title="Настоящие профессионалы">
				</div>

				<div class="col-sm-7 col-md-8 carousel-desc">
					<h2>Настоящие профессионалы.</h2>
					<div class="carousel-caption">
						<p>Проведем подробную консультацию по выбору запчасти для вашего авто.</p>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- Навигация для карусели -->
	<!-- Кнопка, осуществляющая переход на предыдущий слайд с помощью атрибута data-slide="prev" -->
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<!-- Кнопка, осуществляющая переход на следующий слайд с помощью атрибута data-slide="next" -->
	<a class="carousel-control right" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</section>

<!--wrapper-->
<div class="wrapper container">

    <aside class="row autopiter">
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"]."/includes/autopiter/body.php";
        ?>
    </aside>

	<div class="row">
		<div class="col-sm-8 col-md-9 col-sm-push-4 col-md-push-3 main">
			<div class="content-page">
				<jdoc:include type="message" />
				<jdoc:include type="modules" name="bread" style="xhtml"/>
				<jdoc:include type="component" />

				<!--модалка-->
				<button class="order-button center-block" data-target="#modal-zakaz" data-toggle="modal">Заказать обратный звонок</button>

				<div class="form-zakaz">
					<h4>Получить информацию о нужной детали</h4>
					<form action="mail.php" method="post" class="row">
						<div class="col-sm-6">
							<label>
								Ваше имя:
								<input class="form-name form-control" type="text" placeholder="Введите имя" required name="name" size="16" />
							</label>
							<label>
								Ваш телефон:
								<input class="form-phone form-control" type="tel" placeholder="7 (920) 7513346" required pattern="(\+?\d[- .]*){7,13}" title="Международный, государственный или местный телефонный номер" name="phone" size="16" />
							</label>
						</div>

						<div class="col-sm-6">
							<label>
								Марка автомобиля:
								<input class="form-name form-control" type="text" placeholder="ВАЗ 2114" required name="marka" size="16" />
							</label>
							<label>
								VIN автомобиля:
								<input class="form-name form-control" type="text" placeholder="4USBT53544LT26841" name="vin" size="16" />
							</label>
						</div>
						<div class="col-sm-12">
							<label>
								Название детали, год выпуска:
								<textarea name="mess" class="form-massage" cols="23" rows="4" placeholder="Масляный фильтр, 2010 год"></textarea>
							</label>
						</div>

						<div class="col-sm-12">
							<div class="form-input form-pd"><label>Даю согласие на обработку <a href="#" target="_blank" rel="noopener noreferrer">персональных данных</a>:<input class="checkbox-inline" type="checkbox" required="" name="pd" /></label></div>
							<label>Защита от спама: введите сумму 2+2:</label><input class="form-control form-capcha" type="number" required name="capcha"/>
							<input class="btn form-submit" type="submit" name="submit" value="Заказать звонок специалиста" />
						</div>
					</form>
					<div class='message-form'><p>Загрузка...</p></div>
				</div>
			</div>
		</div>

		<aside class="col-sm-4 col-md-3 col-sm-pull-8 col-md-pull-9 left-side">
			<!--модалка-->
			<button class="order-button" data-target="#modal-zakaz" data-toggle="modal">Заказать звонок</button>

            <!--отзывы-->
            <a class="reviews-link" href="/otzyvy">Отзывы</a>
			
			<!--кредит тинькофф-->
            <a class="reviews-link" href="/tinkoff-credit">Кредит от <br />"Тинькофф Банк"</a>
			
			<!--кредит почта банк-->
            <a class="pb-link" href="/pochta-bank">
				<img src="/images/pb.jpg" alt="Кредит от Почта Банк" title="Кредит от Почта Банк"/>
			</a>

			<!--кнопки соцсетей-->
			<div class="socbuttons-block text-center">
				<div class="soc-title">Поделиться с друзьями:</div>
				<div class="socbuttons">
					<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="//yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter"></div>
				</div>
			</div>

			<nav class="leftmenu">
				<jdoc:include type="modules" name="left" style="xhtml"/>
			</nav>

		</aside>
	</div>

	<div class="row yandex-map">
		<div class="map-load">Загрузка карты...</div>
		<script async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A100249c8068b20ec1e61a2c4b872ec8d0435b289fd03e5d52bb3f19e3bcce5a3&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=false"></script>	</div>
</div>
<!--wrapper-->

	<footer class="footer" id="footer">
		<div class="container">
			<div class="row contact" itemscope itemtype="http://schema.org/LocalBusiness" >
				<div class="col-sm-6 footer-block">
					<div class="fn org" itemprop="name">&copy; 2017. <span class="category">Магазин автозапчастей </span>"1001 Запчасть". </div>
						<div itemprop="address">г. Курск, просп. Победы, 50</div>
						<div class="tel" itemprop="telephone">+7 4712 39-89-58</div>
						<div class="tel" itemprop="telephone">+7 (950) 873-41-65</div>
						<div class="email" itemprop="email">kursk-1001z@yandex.ru</div>
				</div>
				<div class="col-sm-2 footer-block"></div>
				<div class="col-sm-4 footer-block">
					<div>Время работы:</div>
					<div>пн-пт - <span class="workhours" itemprop="openingHours"> 08:30 - 19:00</span></div>
					<div>сб - <span class="workhours" itemprop="openingHours"> 08:30 - 14:00</span></div>
					<div>Перерыв - <span> 14:00 - 15:00</span></div>
					<div class="metrica">
						<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=45779661&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/45779661/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="45779661" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45779661 = new Ya.Metrika({
                    id:45779661,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45779661" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
					</div>
					<div class="enterkursk">Сайт разработан <a target="_blank" href="https://enterkursk.ru">EnterKursk.ru</a></div>
				</div>
			</div>	
		</div>
	</footer>
	
	<div class="scroll hidden-xs"><i class="glyphicon glyphicon-chevron-up" aria-hidden="true"></i></div>
	
	<!--модалка-->
	<div id="modal-zakaz" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<button class="close" type="button" data-dismiss="modal">×</button>

				<div class="modal-body">
					<div class="form-zakaz">
						<form action="mail.php" method="post">
							<label>
								Ваше имя:
								<input class="form-name form-control" type="text" placeholder="Введите имя" required name="name" size="16" />
							</label>
							<label>
								Ваш телефон:
								<input class="form-phone form-control" type="tel" placeholder="7 (920) 7513346" required pattern="(\+?\d[- .]*){7,13}" title="Международный, государственный или местный телефонный номер" name="phone" size="16" />
							</label>
							<div class="form-input form-pd"><label>Даю согласие на обработку <a href="#" target="_blank" rel="noopener noreferrer">персональных данных</a>:<input class="checkbox-inline" type="checkbox" required="" name="pd" /></label></div>
							<label>Защита от спама: введите сумму 2+2:</label><input class="form-control form-capcha" type="number" required name="capcha"/>
							<input class="btn form-submit" type="submit" name="submit" value="Отправить сообщение" />
						</form>
						<div class='message-form'><p>Загрузка...</p></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--модалка-->

    <!-- Modal gallery -->
    <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
        <div class="slides"></div>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close" style="top: 40px; color: #fff;">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

</body>
</html>