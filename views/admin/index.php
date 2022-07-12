<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
      <div class="row">
        <h2 class = "hello__ad">Панель администратора</h2>
              <div class="row gutters-sm_ad">
                <div class="col-sm-2"><br><br>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pops">
                        <a href = "/admin/spektakl">Спектакли</a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pops">
                        <a href = "/admin/seans">Сеансы</a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pops">
                        <a href = "/admin/news">Новости</a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pops">
                        <a href = "/admin/actor">Актеры</a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pops">
                        <a href = "/admin/order">Заказы</a>
                      </li>
                    </ul>
                </div>
          <div class="col-sm-9 padding-right">
					    <div class="features_items_reps"><!--features_items-->
                    <h2 class="title_reps text-center">Последние спектакли</h2>
                    <?php foreach ($spektsLast as $s):?>
                        <a href = "spektakl/<?=$s['id']?>"><div class="col-sm-4">
                            <div class="product-image-wrapper_reps">
                                <div class="single-products_reps">
                                    <div class="productinfo_reps text-center">
                                        <img src="<?=Spektakl::getImageAfisha($s['id'])?>" alt=""/>
                                        <h2><?=$s['name']?></h2>
                                        <p class = "spektakl_opisanie">
                                            <?=$s['author']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                    <?php endforeach;?>         
                        <h2 class="title_reps text-center">Последние актеры</h2>
                        <?php foreach($persLast as $ps):?>
                        <a href=""><div class="col-sm-4">
                            <div class="product-image-wrapper_reps">
                                <div class="single-products_reps">
                                    <div class="productinfo_reps text-center">
                                        <img src="<?=Personal::getImageActor($ps['persid'])?>" alt=""/>
                                        <h2><?=$ps['name']?></h2>
                                        <p class = "spektakl_opisanie">
                                            <?=$ps['position']?>  
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div></a>   
                        <?php endforeach;?>
                        <h2 class="title_reps text-center">Последние отзывы</h2>
                        <div class="row all-comments" id = "cmt">
												<?php foreach($comments as $com):?>
													<div class="one-comment col-10 pipas<?php echo $com['comment_id']?>">
														<h4><?php echo $com['user_firstname'];?> <?php echo $com['user_surname'];?></h4><h6> к спектаклю <a href = "/spektakl/<?=$com['spektid']?>"><?=$com['spektname']?></a></h6>
														<span><i class="fa fa-calendar"></i><?php echo $com['date'];?></span>
														<span><i class="fa fa-clock-o"></i><?php echo $com['time'];?></span>
														<?php $user = User::getUserById($_SESSION['user']); if(User::getUserId()==$com['user_id']||$user['role']=='admin'):?>
														<div data-commentid = "<?php echo $com['comment_id']?>"  class="comdel"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash itops" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></div>		
														<?php endif;?>
														<div class="col-12 text">
															<?php echo $com['comment_text'];?>
														</div>
													</div>
												<?php endforeach;?>
						</div>     
                </div><!--features_items-->
          </div>  
        </div>
    </div>
</section>
<br><br>
<?php include ROOT . '/views/layouts/footer_admin.php'; ?>



          