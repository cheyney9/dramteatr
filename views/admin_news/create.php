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
                                background-color: #ede7e7;
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

                                .bnt{
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
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Создать новость</li>
                </ol>
            </div>

            <div class="col-md-5 col-sm-offset-4">
                <h3>Добавить новость</h3>
            </div><br><br>


            <div class="col-md-5 col-sm-offset-4 asp">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Заголовок новости</label>
                        <input type="text" name="name" placeholder="" value="">

                        <label>Текст новости</label>
                        <textarea rows = "10" name="text_news"></textarea><br><br>

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
