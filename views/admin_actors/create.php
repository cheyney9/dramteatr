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
                    <li><a href="/admin/actor">Управление сотрудниками</a></li>
                    <li class="active">Добавить сотрудника</li>
                </ol>
            </div>


            <div class="col-md-5 col-sm-offset-4">
                <h3>Добавить сотрудника</h3>
            </div><br><br>

            <br/>

            <div class="col-md-5 col-sm-offset-4 asp">
                <div class="login-form labaa">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Введите фамилию и имя сотрудника</label>
                        <input type = "text" name = "name">

                        <label>Выберите должность</label>
                        <select name="position_id">
                                    <option value="<?php echo $positionsList[0]['id']; ?>">
                                        <?php echo $positionsList[0]['pos_name']; ?>
                                    </option>
                                    <option value="<?php echo $positionsList[1]['id']; ?>">
                                        <?php echo $positionsList[1]['pos_name']; ?>
                                    </option>
                        </select>
<br><br>
<label>Краткая информация</label>
                        <textarea rows = "10" name="text_pers"></textarea><br><br>

                        <label>Фото сотрудника</label>
                        <input type="file" name="actor_img" placeholder="" value="">

                        <br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section><br><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

