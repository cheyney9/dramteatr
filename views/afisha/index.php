<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Афиша</title>
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
<section>
<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="left-sidebar">
							<h2>Месяц</h2>
							<div class= "lsd">
								<?php if($m==$cur_month):?>
								<a href="/afisha/<?=$cur_month?>" class="btn btn-default add-to-cart2"><?php echo Seans::formatMonth($cur_month)?></a><br>
								<a href="/afisha/<?=$next_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($next_month)?></a><br>
								<a href="/afisha/<?=$next_next_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($next_next_month)?></a>
								<?php elseif($m==$next_month):?>
								<a href="/afisha/<?=$cur_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($cur_month)?></a><br>
								<a href="/afisha/<?=$next_month?>" class="btn btn-default add-to-cart2"><?php echo Seans::formatMonth($next_month)?></a><br>
								<a href="/afisha/<?=$next_next_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($next_next_month)?></a>
								<?php else:?>
								<a href="/afisha/<?=$cur_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($cur_month)?></a><br>
								<a href="/afisha/<?=$next_month?>" class="btn btn-default add-to-cart1"><?php echo Seans::formatMonth($next_month)?></a><br>
								<a href="/afisha/<?=$next_next_month?>" class="btn btn-default add-to-cart2"><?php echo Seans::formatMonth($next_next_month)?></a>
								<?php endif;?>
							</div>
						</div>
					</div>
					
					<div class="col-sm-9 padding-right">
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Расписание постановок</h2>
							<div class="col-sm-12">
								<?php foreach($nearestSpekts as $ns):?>
								<div class="product-image-wrapper">
									<div class="single-products">
											<div class="productinfo">
												<div class = "col-sm-4 time">
													<h2><?php echo $ns['date'];?></h2>
													<p><?php echo $ns['time'];?></p>
												</div>
												<div class = "col-sm-4 text-bil-name">
													<h2><a href = "/spektakl/<?php echo $ns['spektId']?>" class = "spekt_name_bil"><?php echo $ns['spekt_name'];?></a></h2>
													<p><?php echo $ns['short_descript'];?></p>
												</div>
												<div class = "col-sm-4 levbort">
													<a href="/seans/<?php echo $ns['id']?>"class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Билеты</a>
												</div>
											</div>
									</div>
								</div>
								<div class="container adaptive_wrapper">
									<div class="row">
										<div class="col-xs-6 date">
											<h2><?php echo $ns['date'];?></h2>
										</div>
										<div class="col-xs-6 adaptive_time">
											<p><?php echo $ns['time'];?></p>
										</div>
										<div class = "col-xs-12 adaptive_spekt_name">
											<h2><a href = "/spektakl/<?php echo $ns['spektId']?>" class = "spekt_name_bil"><?php echo $ns['spekt_name'];?></a></h2>
											<p><?php echo $ns['short_descript'];?></p>
										</div>
										<div class = "col-xs-12 adaptive_tickets">
											<a href="/seans/<?php echo $ns['id']?>"class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Билеты</a>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							
						</div><!--/category-tab-->
					</div>
				</div>
			</div>
		</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>