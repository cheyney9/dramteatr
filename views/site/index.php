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
									<li><a href="/" class="active men" style="font-weight:700; font-size:20px;">Главная</a></li>
									<li><a href="/afisha/<?=$cur_month?>" class = "men" style="font-weight:700;font-size:20px;">Афиша</a></li> 
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
<section id="slider"><!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider-carousel" class="carousel slide sh" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#slider-carousel" data-slide-to="1"></li>
								<li data-target="#slider-carousel" data-slide-to="2"></li>
							</ol>
							
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-6">
										<h1><a href = "/spektakl/<?php echo $slider[0]['id'];?>" class = "spekt"><?php echo $slider[0]['name'];?></a></h1>
										<h2><?=$slider[0]['author']?></h2>
										<p> </p>
										<a href="/spektakl/<?=$slider[0]['id'];?>" class="btn btn-default add-to-cart">Подробнее</a>
									</div>
									<div class="col-sm-5">
										<img src="<?=Spektakl::getImageAfisha($slider[0]['id']);?>" class="girl img-responsive" alt="" />
									</div>
								</div>
								<div class="item">
									<div class="col-sm-6">
										<h1><a href = "/spektakl/<?php echo $slider[1]['id'];?>" class = "spekt"><?php echo $slider[1]['name'];?></a></h1>
										<h2><?=$slider[1]['author']?></h2>
										<p> </p>
										<a href="/spektakl/<?=$slider[1]['id'];?>" class="btn btn-default add-to-cart">Подробнее</a>
									</div>
									<div class="col-sm-5">
										<img src="<?=Spektakl::getImageAfisha($slider[1]['id']);?>" class="girl img-responsive" alt="" />
									</div>
								</div>
								
								<div class="item">
									<div class="col-sm-6">
										<h1><a href = "/spektakl/<?php echo $slider[2]['id'];?>" class = "spekt"><?php echo $slider[2]['name'];?></a></h1>
										<h2><?=$slider[2]['author']?></h2>
										<p> </p>
										<a href="/spektakl/<?=$slider[2]['id'];?>" class="btn btn-default add-to-cart">Подробнее</a>
									</div>
									<div class="col-sm-5">
										<img src="<?=Spektakl::getImageAfisha($slider[2]['id']);?>" class="girl img-responsive" alt="" />
									</div>
								</div>
								
							</div>
							
							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
						
					</div>
				</div>
			</div>
		</section><!--/slider-->
		
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
						<div class="features_items"><!--features_items-->
							<h2 class="title text-center">Ближайшие спектакли</h2>
							<div class="col-sm-12">
								<?php foreach($nerSeans as $ns):?>
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
								<?php endforeach;?>
							</div>
							
						</div><!--/category-tab-->
					</div>
				</div>
			</div>
		</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>