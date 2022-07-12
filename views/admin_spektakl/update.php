<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<style>
    p{
        font-weight: bold;
        text-transform: uppercase;
        padding-top: 15px;
    }
                            input{
                                width:  200px;
                                height: 45px;
                                padding: 5px 10px 5px 10px;
                                border:1px solid #999;
                                font-size:16px;
                                font-family: Tahoma;
                            }
                            .asp{
                                background-color: rgb(240, 240, 240);
                                padding: 15px;
                                border-radius:5px;
                            }
                            h3{
                                text-align: center;
                                text-transform: uppercase;
                            }
                            label{
                                text-transform: uppercase;
                            }
                            input[type="text"], input[type="number"], input[type="date"], textarea {
                                background-color : #fff;
                                font-size:16px;
                                color:black;
                                }
                                input{
                                    background-color:#fff;
                                }

                                .btn{
                                    background-color: #400;
                                }
                            .bnt:hover{
                                background-color: #000;
                            }
                            @media (max-width: 600px) {
                                .asp{
                                    margin:10px;
                                }
                            }
</style>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/spektakl">Управление спектаклями</a></li>
                    <li class="active">Редактировать спектакль</li>
                </ol>
            </div>

            <div class="col-md-7 col-sm-offset-3">
                <h3>Редактировать спектакль "<?php echo $spekt['name'];?>"</h3>
            </div>
            <br/><br><br><br>

            <div class="col-md-7 col-sm-offset-3 asp">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <label>Название спектакля</label>
                        <input type="text" name="name" placeholder="" value="<?php echo $spekt['name'];?>"><br>

                        <label>Краткое описание</label>
                        <textarea rows = "4" name="short_descript" value=""><?php echo $spekt['short_descript'];?></textarea>
                        <br><br>
                        <label>Полное описание</label>
                        <textarea rows = "14" name="descript" placeholder="" value=""><?=$spekt['descript'];?></textarea>
                        <br><br>
                        <label>Длительность</label>
                        <input type="text" name="length" placeholder="" value="<?=$spekt['length'];?>">
<br>
                        <label>Автор</label>
                        <input type="text" name="author" placeholder="" value="<?=$spekt['author'];?>"><br>

                        <label>Дата премьеры</label>
                        <input type = "date" name = "premier_date" value="<?=$spekt['premier_date'];?>"><br>

                        <label>Фото афиши</label>
                        <img src="<?php echo Spektakl::getImageAfisha($spekt['spekt_id']); ?>" width="200" alt="" />
                        <input type="file" name="afisha_img" placeholder="" value="<?php echo $spekt['afisha_img']; ?>"><br>

                    
                        <br>

                        <input type="submit" name="submit" class="btn btn-default bnt" value="Сохранить">

                        <br/><br/>
                        
                    </form>
                </div>
            </div>
<br><br>
        </div>
    </div>
</section><br><br>
    <div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom_ad">
        <div class="container">
            <div class="row">
            <p class="pull-left">Copyright © 2021</p>
                <p class="pull-right">coffeprod.com</p>
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
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>
</html>