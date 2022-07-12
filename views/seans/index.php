<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $seans_details['spekt_name'];?></title>
		<link href="/template/css/bootstrap.min.css" rel="stylesheet">
		<link href="/template/css/font-awesome.min.css" rel="stylesheet">
		<link href="/template/css/prettyPhoto.css" rel="stylesheet">
		<link href="/template/css/price-range.css" rel="stylesheet">
		<link href="/template/css/animate.css" rel="stylesheet">
		<link href="/template/css/main.css" rel="stylesheet">
		<link href="/template/css/lightbox.css" rel="stylesheet">
		<link href="/template/css/responsive.css" rel="stylesheet">
		<link href="/examples/vendors/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->       
		<link rel="shortcut icon" href="images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	</head><!--/head-->

	<body class = "neadapt">
		<header id="header"><!--header-->
			<div class="header_top"><!--header_top-->
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="contactinfo">
								<ul class="nav nav-pills">
									<li><a href="#"><i class="fa fa-phone"></i> +7 919 346 11 88</a></li>
									<li><a href="#"><i class="fa fa-envelope"></i> amir.galeev.00@gmail.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="social-icons pull-right">
								<ul class="nav navbar-nav">
									<li><a href="#"><i class="fa fa-vk"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<?php if(AdminBase::isAdmin()):?><li><a href="/admin"><a href="/admin"><i class="fa fa-edit"></i>Панель администратора</a></li><?php endif;?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header_top-->
			
			<div class="header-middle"><!--header-middle-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo pull-left">
								<a href="/"><img src="/template/images/home/logo.png" alt="" height="50px"><span class = "logoname">Магнитогорский театр драмы</span></a>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="shop-menu pull-right">
								<ul class="nav navbar-nav">
                                <?php if (User::isGuest()): ?>                                        
                                            <li><a href="/user/login/" class = ""><i class="fa fa-lock"></i> Вход</a></li>
                                            <li><a href="/user/register/"><i class="fa fa-lock"></i> Регистрация</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> <?=User::getName($_SESSION['user'])?></a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                <?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-middle-->
			
			<div class="header-bottom"><!--header-bottom-->
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<?php
								$d = date("Y-m-d");
								list($day, $month, $year) = explode("-", $d);
								$cur_month = $month;
							?>
							<div class="mainmenu pull-left">
								<ul class="nav navbar-nav collapse navbar-collapse">
									<li><a href="/" class="men" style="font-weight:700; font-size:20px;">Главная</a></li>
									<li><a href="/afisha/<?=$cur_month?>" class = "active men" style="font-weight:700;font-size:20px;">Афиша</a></li> 
									<li><a href="/thenews/page-1" class = "men" style="font-weight:700;font-size:20px;">Новости</a></li> 
									<li><a href="/repertoir" class = "men" style="font-weight:700;font-size:20px;">Репертуар</a></li>
									<li><a href="/truppa" class = "men" style="font-weight:700;font-size:20px;">Коллектив</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->
		<div class="preloader" id = "preloader">
				<div id="fountainG">
							<div id="fountainG_1" class="fountainG"></div>
							<div id="fountainG_2" class="fountainG"></div>
							<div id="fountainG_3" class="fountainG"></div>
							<div id="fountainG_4" class="fountainG"></div>
							<div id="fountainG_5" class="fountainG"></div>
							<div id="fountainG_6" class="fountainG"></div>
							<div id="fountainG_7" class="fountainG"></div>
							<div id="fountainG_8" class="fountainG"></div>
				</div>
			</div>
		<div class = "container">
				<div class="row">  
							<h2 class="title_osob" data-seansID = "<?=$seansId;?>"><a href = "/spektakl/<?=$seans_details['spektId'];?>">Спектакль "<?php echo $seans_details['spekt_name'];?>"</a></h2>
							<div class = "col-sm-4">
								<h3 class = "cont_tel bila"><?=$seans_details['date'];?>, <?=$seans_details['time'];?>, <?=$seans_details['hall_name']?></h3>
							</div>
				</div>
				<div class="row">
					<div class = "col-sm-10">
						<div onmousedown='return false' class='cinemaHall zal1'>
							<div class = "nomerRow">РЯД</div>
							<div class = "scena"></div>
							<?php echo Hall::renderHall($seans_details['hall_id'], $seans_details['id'])?>
							<div class="knikpa">
								<div class="seat1">2000 р.</div>
								<div class="seat2">1500 р.</div>
								<div class="seat3">1000 р.</div>
								<div class="seat4">Бронь</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 tkt">
					</div>
					<div class="pad"></div>
				</div>
		</div>
		<footer id="footer"><!--Footer-->
			<div class="footer-widget  kika">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<div class="single-widget">
								<h2>Навигация</h2>
								<ul class="nav nav-pills nav-stacked">
								<li><a href="/">Главная страница</a><li>
								<li><a href="/afisha/<?=$cur_month?>">Афиша</a></li>
								<li><a href="#">Новости</a></li>
								<li><a href="#">Персонал</a></li>
								<li><a href="#">Репертуар</a></li>
								<li><a href="#">Авторизация</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="single-widget">
								<h2>Контакты</h2>
								<ul class="nav nav-pills nav-stacked">
								<p class = "cont ">Телефон администрации театра<br> <a href = "#" class = "hone">+7 (919) 346 11 88</a></p>
								<p class = "cont">Email театра<br> <a href = "#" class = "hone">amir.galeev.00@gmail.com</a></p>
								<p class = "cont">Адрес театра<br> <a class = "ihone">455005, Челябинская область,<br> пр. Карла Маркса 76</a></p>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="single-widget">
								<h2>Мы в социальных сетях</h2>
								<ul class="nav nav-pills nav-stacked">
								<p class = "cont"><a href = "#" class = "hone">Instagram</a></p>
								<p class = "cont"><a href = "#" class = "hone">Вконтакте</a></p>
								<p class = "cont"><a href = "#" class = "hone">Google+</a></p>
								<p class = "cont"><a href = "#" class = "hone">Telegram</a></p>
								<p class = "cont"><a href = "#" class = "hone">Twitter</a></p>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © 2022 theteater.com. All rights reserved.</p>
					</div>
				</div>
			</div>
			
		</footer><!--/Footer-->
		<script src="/template/js/jquery.js"></script>
		<script src="/template/js/jquery.cycle2.min.js"></script>
		<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
		<script src="/template/js/bootstrap.min.js"></script>
		<script src="/template/js/jquery.scrollUp.min.js"></script>
		<script src="/template/js/price-range.js"></script>
		<script src="/template/js/jquery.prettyPhoto.js"></script>
		<script src="/template/js/main.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
		<script src="/template/js/lightbox-plus-jquery.js"></script>
		<script>
			lightbox.option({
				'showImageNumber': false,
				'wrapAround': true
			})
		</script>

</body>
</html>


