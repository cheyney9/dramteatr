<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<style>
                            input {
                                width:  200px;
                                height: 35px;
                                padding: 5px 10px 5px 10px;
                                border:1px solid #999;
                                font-size:18px;
                                font-family: Tahoma;
                            }
                            .asp{
                                background-color: rgb(248, 243, 243);
                                padding: 12px;
                                border-radius:5px;
                                background-color: #ede7e7;
                            }
                            h3{
                                text-align: center;
                                text-transform: uppercase;
                            }
                            label{
                                text-transform: uppercase;
                            }
                            textarea{
                                font-size:16px;
                                background:#fff;
                            }
                            @media (max-width: 600px) {
                                .asp{
                                    margin:10px;
                                }
                            }
                            .btn{
                                    background-color: #400;
                                }
                            .bnt:hover{
                                background-color: #000;
                            }
                        </style>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Создать новость</li>
                </ol>
            </div>


            <div class="col-md-7 col-sm-offset-3">
                <h3>Изменить новость</h3>
            </div><br><br>
            <br/>

            <div class="col-md-7 col-sm-offset-3 asp">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Заголовок новости</label>
                        <input type="text" name="name" placeholder="" value="<?=$news['name']?>">

                        <label>Текст новости</label>
                        <textarea rows = "15" name="text_news"><?=$news['text_news']?></textarea><br><br>

                        <label>Фото афиши</label>
                        <input type="file" name="news_img" placeholder="" value="">

                    
                        <br>

                        <input type="submit" name="submit" class="btn btn-default bnt" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section><br><br><br>

