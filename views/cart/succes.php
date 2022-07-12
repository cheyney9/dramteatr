<?php include ROOT . '/views/layouts/header.php'; ?>
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
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h3 class="display-4 ban">Спасибо за заказ!</h3>
                            <p class="lead ban">Мы отправим билеты на указанный Вами адрес электронной почты.</p>
                            <a href="/" class="btn btn-default add-to-cart"></i>На главную</a>
                        </div>
                    </div>
			</div>
		</div>
	</section><!--/form-->

<?php include ROOT . '/views/layouts/footer.php'; ?>