<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?=$pers['name']?></title>
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
        <style type="text/css">
            img {
            max-width: 100%;
            max-height: 500px;
            height:100%;
            }

            h1 {
            font-size: 50px;
            margin-top: 30px;
            margin-bottom: 20px;
            }

            h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            }

            p {
            font-size: 18px;
            }
        </style>
	</head><!--/head-->
	<body>
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
									<?php if(AdminBase::isAdmin()):?><li><a href="/admin"><a href="/admin"><i class="fa fa-edit"></i> Админпанель</a></li><?php endif;?>
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
                                            <li><a href="/user/login/" class = ""><i class="fa fa-user"></i> Вход</a></li>
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
									<li><a href="/afisha/<?=$cur_month?>" class = "men" style="font-weight:700;font-size:20px;">Афиша</a></li> 
									<li><a href="/thenews/page-1" class = "men" style="font-weight:700;font-size:20px;">Новости</a></li> 
									<li><a href="/repertoir" class = "men" style="font-weight:700;font-size:20px;">Репертуар</a></li>
									<li><a href="/truppa" class = "active men" style="font-weight:700;font-size:20px;">Труппа</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1><?=$pers['name']?></h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <p><?=$pers['description']?></p>
      </div>
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <img src="<?=Personal::getImageActor($pers['pers_id'])?>">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Участие в спектаклях</h2>
        <?php foreach($roles as $p):?>
            <a href="/spektakl/<?php echo $p['spektid'];?>"><div class="col-sm-4">
                            <div class="product-image-wrapper_rep_fact">
                                <div class="single-products_rep_fact">
                                    <div class="productinfo_rep_fact text-center">
                                        <img src="<?=Spektakl::getImageAfisha($p['spektid'])?>" alt="" />
                                        <h2><?=$p['nam']?></h2>
                                        <p class = "spektakl_opisanie">
                                            <?=$p['dolz']?>, РОЛЬ: <?=$p['rol']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
            </div></a>        
        <?php endforeach;?>
      </div>
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
								<li><a href="/catalog">Афиша</a></li>
								<li><a href="#">Контакты</a></li>
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

