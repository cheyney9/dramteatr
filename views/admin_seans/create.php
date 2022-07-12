<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/seans">Управление сеансом</a></li>
                    <li class="active">Создать сеанс</li>
                </ol>
            </div>


            <h3 class = "title">Добавить новый сеанс</h3>


            <div class = "col-lg-4 col-sm-offset-4">
                    <?php if (isset($_SESSION['error_seans_add'])): ?>
                        <div class = "alert alert-danger errora">
                            <?php echo $_SESSION['error_seans_add'];?>
                            <?php unset($_SESSION['error_seans_add']);?>
                        </div>
                    <?php endif; ?>
    </div><br><br>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4 col-sm-offset-4 asp">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Выберите спектакль</label>
                        <select name="spekt_id" class = "form-control form-control-lg">
                                <?php foreach ($spektsList as $spekt): ?>
                                    <option value="<?php echo $spekt['id']; ?>">
                                        <?php echo $spekt['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select><br>

                        <label>Выберите зал</label>
                        <select name="hall_id" class = "form-control form-control-lg">
                                    <option value="<?php echo $hallList[0]['hall_id']; ?>">
                                        <?php echo $hallList[0]['hall_name']; ?>
                                    </option>
                        </select><br>


                        <label>Введите дату</label>
                        <input type = "date" name = "date"class = "form-control form-control-lg"><br>

                        <label>Введите время</label>
                        <input type="time" name="time" placeholder="" value=""class = "form-control form-control-lg"><br>
                        <input type="submit" name="submit" class="btn btn-default bnt" value="Сохранить">

                        <br/>
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
                            }
                            @media (max-width: 600px) {
                                .asp{
                                    margin:10px;
                                }
                            }
                            .bnt{
                                    background-color: black;
                                    color:white;
                                }
                            .bnt:hover{
                                background-color: #000;
                            }
                        </style>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section><br><br><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

