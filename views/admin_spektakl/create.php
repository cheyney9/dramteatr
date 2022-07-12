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
                    <li><a href="/admin/spektakl">Управление спектаклем</a></li>
                    <li class="active">Редактировать спектакль</li>
                </ol>
            </div>
            

            <div class="col-md-7 col-sm-offset-3">
                <h3>Добавить новый спектакль</h3>
            </div>
            <br/><br><br><br>

            <br/>
            <div class="col-md-7 col-sm-offset-3 asp">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Название спектакля</label>
                        <input type="text" name="name" placeholder="" value=""><br>

                        <label>Краткое описание</label>
                        <textarea rows = "4" name="short_descript"></textarea>
                        <br><br>
                        <label>Полное описание</label>
                        <textarea rows = "9" name="descript" placeholder="" value=""></textarea><br>
                        <br>
                        <label>Длительность</label>
                        <input type="number" name="length" placeholder="" value="">

                        <label>Автор</label>
                        <input type="text" name="author" placeholder="" value=""><br>

                        <label>Дата премьеры</label>
                        <input type = "date" name = "premier_date"><br>

                        <label>Фото афиши</label>
                        <input type="file" name="afisha_img" placeholder="" value=""><br>

                        <br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div><br><br>

        </div>
    </div>
</section><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

