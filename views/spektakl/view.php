<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?=$spekt['name'];?></title>
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
									<li><a href="/afisha/<?=$cur_month?>" class = "men" style="font-weight:700;font-size:20px;">Афиша</a></li> 
									<li><a href="/thenews/page-1" class = "men" style="font-weight:700;font-size:20px;">Новости</a></li> 
									<li><a href="/repertoir" class = "active men" style="font-weight:700;font-size:20px;">Репертуар</a></li>
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
						<h2>Новости театра</h2>
							<div class="panel-group category-products" id="accordian"><!--category-productsr-->
								<div class="panel panel-default">
									<?php foreach($sb as $s):?>
									<div class="panel-heading">
										<h4 class="panel-title"><a href="/newsingle/<?php echo $s['id']?>"><?php echo $s['name'];?></a></h4>
									</div>
									<?php endforeach;?>
								</div>
							</div><!--/category-products-->
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
						<h2 class="title">Спектакль "<?=$spekt['name'];?>"</h2>
                        <div class="product-details"><!--product-details-->
                            <div class="row">                                
                                <div class="col-sm-8">
                                    <p class = "revaz"><?=$spekt['descript'];?></p>
									<!--<img src="<?=Spektakl::getImageAfisha($spektId)?>" class="responsive" alt="" />-->
                                </div>
								<div class="col-sm-4">
									<p class = "cont1">Автор<br><a class = "ihone1"><?=$spekt['author'];?></a></p>
									<p class = "cont1">Режиссер<br><a href = "/pers/<?=$director['persid']?>" class = "spektpershref"><?=$director['name'];?></a></p>
									<p class = "cont1">Жанр<br><a class = "ihone1"><?=$spekt['short_descript'];?></a></p>
									<p class = "cont1">Длительность<br><a class = "ihone1"><?=$spekt['length'];?> минут</a></p>
									<p class = "cont1">Дата премьеры<br><a class = "ihone1"><?=Seans::dateFormat($spekt['premier_date']);?></a></p>
								</div>
                            </div>
							<div class="row actors">
								<div class = "col-sm-8">
									<p class = "cont1">В ролях</p>
									<ul class="nav nav-pills nav-stacked">
										<?php foreach($persList as $ps):?>
											<?php if($ps['posid']==2):?>
												<li class="ihone1 act"><a class = "spektpershref"href = "/pers/<?=$ps['persid']?>"><?php echo $ps['name'];?></a> - &nbsp;&nbsp;<?php echo $ps['role_spekt'];?></li><br>
											<?php endif;?>
										<?php endforeach;?>
									</ul>
								</div>
								<div class = "col-sm-4">
									<p class = "cont1">Ближайшие представления</p>
									<ul class="nav nav-pills nav-stacked kokpik">
										<?php foreach($nearest as $ns):?>
										<li class="ihone1 act"><?=$ns['date']?> в <?=$ns['time']?></li><a href="/seans/<?=$ns['seans_id']?>" class="btn btn-default add-to-cart11">Билеты</a><hr>
										<?php endforeach;?>
									</ul>
								</div>
							</div>
							<div class="row">
								<!--features_items-->
							</div>
						</div><!--/product-details-->

                    </div>
					<div class="col-sm-12">
									<h2 class="title_rep text-center">Галерея</h2>
									<?php $paths = Spektakl::getGallery($spekt['spekt_id']) ?>
									<?php foreach($paths as $p):?>
									<a href="<?=$p?>" data-lightbox ="images" data-titlev="Ревизор"><div class="col-sm-4">
										<div class="product-image-wrapper_rep_i">
											<div class="single-products_rep_i">
												<div class="productinfo_rep_i text-center">
													<img src="<?=$p?>" alt="" />
												</div>
											</div>
										</div>
									</div></a>   
									<?php endforeach;?>                
                				</div>
								<div class="col-sm-7 comments">
									<?php if(User::userAuth()):?>
										
									<h3 class= "title">Оставить комментарий</h3><br>
									<form class = "cmts" data-spekt="<?=$spektId?>">
										<input type="hidden" class = "sid" name="spekt_id" value="<?=$spektId?>">
										<input type="hidden" class = "uid"  name="user_id" value="<?=User::getUserId();?>">
										<div class="mb-3">
											<label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label><br>
											<textarea name="comment" class="form-control comm" id="exampleFormControlTextarea1" rows="6"></textarea>
										</div>
										<div class="col-12">
											<button type="button" class="btn btn-primary"  id = "commentform" >Отправить</button>
										</div>
									</form><br>
									<?php else: ?>
										<br><br>
										<div class="jumbotron jumbotron-fluid">
											<div class="container">
												<h5 class="display-4 ban">Чтобы оставить отзыв, вам необходимо <a href = "/user/login">авторизоваться</a>.</h5>
											</div>
										</div>
									<?php endif;?>
											<?php if(count($commList)<1):?>
												<h3 class="col-10 ac">к спектаклю "<?php echo $spekt['name'];?>" пока нет отзывов.</h3>
											<?php else:?>
												<h3 class="col-10 ac">Отзывы к спектаклю "<?php echo $spekt['name'];?>"</h3>
												<?php endif;?>
										<div class="row all-comments" id = "cmt">
												<?php foreach($commList as $com):?>
													<div class="one-comment col-10 pipas<?php echo $com['comment_id']?>">
														<h4><?php echo $com['user_firstname'];?> <?php echo $com['user_surname'];?></h4>
														<span><i class="fa fa-calendar"></i><?php echo $com['date'];?></span>
														<span><i class="fa fa-clock-o"></i><?php echo $com['time'];?></span>
														<?php if(User::getUserId()==$com['user_id'] || AdminBase::isAdmin()):?>
														<div data-commentid = "<?php echo $com['comment_id']?>"  class="comdel"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash itops" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></div>		
														<?php endif;?>
														<div class="col-12 text">
															<?php echo $com['comment_text'];?>
														</div>
													</div>
												<?php endforeach;?>
										</div>
								</div>

                </div>
            </div>
        </section>
		<script>
  </script>
<?php include ROOT . '/views/layouts/footer.php'; ?>