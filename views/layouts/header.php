<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Главная</title>
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
			

