<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Оформление заказа</title>
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
									<li><a href="/thenews" class = "men" style="font-weight:700;font-size:20px;">Новости</a></li> 
									<li><a href="/repertoir" class = "men" style="font-weight:700;font-size:20px;">Репертуар</a></li>
                  <li><a href="/truppa" class = "men" style="font-weight:700;font-size:20px;">Коллектив</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

<section id="form"><!--form-->
		<div class="container">
                <?php if(isset($_SESSION['seansid'])):?>
                <?php if(!$result):?>
                    <div class="row">  
                        <h2 class="title_osob">Спектакль "<?php echo $seans_det['spekt_name'];?>"</h2>
                        <div class = "col-sm-4">
                            <h3 class = "cont_tel bila"><?=$seans_det['date'];?>, <?=$seans_det['time'];?>, <?=$seans_det['hall_name']?></h3>
                        </div>
                    </div>
                    <div class="row">
				<div class="col-sm-4">
					<div class="login-form"><!--login form-->
						<h2 class="oforma">Ваши данные для заказа</h2>
						<form action="#" method = "POST">
							<input name = "mail" type="text" placeholder="Email" value = "<?=$user['email']?>"/>
							<input name = "phone" type="phone" placeholder="Телефон" value = "<?=$user['phone_number']?>"/>
                            <input name = "name" type="text" placeholder="Имя" value = "<?=$user['firstname']?>"/>
							<button name = "submit" type="submit" class="btn btn-default logbtn">Оформить</button>
						</form>
					</div>
          <?php if (isset($_SESSION['eror'])): ?>
                    <div class="alert alert-danger errora" id = "errors">
                        <?php echo $_SESSION['eror'];?>
                        <?php unset($_SESSION['eror']);?>
                    </div>
                <?php endif; ?>
				</div>

                <div class="col-sm-8 snp">
                <div class="col-md-8">
              <div class="cart mb-2">
                <div class="card-body">
                <?php foreach($seat_data as $s):?>
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class = "mb-0 caba"><?php echo $s['sname']?>, <?php echo $s['ryad']?> ряд<br> <?php echo $s['number_in_row']?> место</h5>
                    </div>
                    <div class="col-sm-5">
                      <h4 class="dengi"><?php echo $s['price']?> рублей<h5>
                    </div>
                  </div>
                  <hr class= "hhr">
                <?php endforeach;?>
                <div class="row">
                    <div class="col-sm-6">
                      <h4 class = "mb-0 caba">ИТОГО:</h5>
                    </div>
                    <div class="col-sm-5">
                      <h4 class="dengi"><?php echo $sum?> рублей<h5>
                    </div>
                  </div>
              </div>
            </div>
				    </div>
                <?php else:?>
                  <?php unset($_SESSION['seansid']);?>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h3 class="display-4 ban">Спасибо за заказ!</h3>
                            <p class="lead ban">Мы отправим билеты на указанный Вами адрес электронной почты.</p>
                            <a href="/" class="btn btn-default add-to-cart"></i>На главную</a>
                        </div>
                    </div>
                <?php endif;?>
                <?php else:?>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h3 class="display-4 ban">Вы ничего не выбрали</h3>
                            <p class="lead ban">Пройдите на <a href = "/repertoir">страницу репертуара</a>, чтобы выбрать спектакль и заказать билет.</p>
                        </div>
                    </div>
                <?php endif;?>
			</div>
		</div>
	</section><!--/form-->

<?php include ROOT . '/views/layouts/footer.php'; ?>