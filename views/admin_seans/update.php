<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<style>
input {
    width:  200px;
    height: 35px;
    padding: 5px 10px 5px 10px;
    border:1px solid #999;
    font-size:16px;
    font-family: Tahoma;
}



</style>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/seans">Управление сеансом</a></li>
                    <li class="active">Изменить сеанс</li>
                </ol>
            </div>


            <h4 class = "title">Изменить сеанс</h4>

            <br/><br>

            <div class="cnt">
            <div class="col-lg-6 reda">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <h5 class = "title">Выберите спектакль</p><br>
                        <select name="spekt_id">
                                <?php foreach ($spektsList as $spekt): ?>
                                    <option value="<?php echo $spekt['id']; ?>"
                                        <?php if ($seans['spektId'] == $spekt['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $spekt['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select><br><br>

                        <p class = "title">Выберите зал</p><br>
                        <select name="hall_id">
                                <?php foreach ($hallList as $hall): ?>
                                    <option value="<?php echo $hall['hall_id']; ?>"
                                        <?php if ($seans['hall_id'] == $hall['hall_id']); ?>>
                                        <?php echo $hall['hall_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                        </select><br><br>

                        <p class = "title">Введите дату</p><br>
                        <input type = "date" name = "date" value = "<?=date("Y-m-d",strtotime($seans['date']))?>"><br>

                        <p class = "title">Введите время</p><br>
                        <input type="time" name="time" placeholder="" value = "<?=$seans['time']?>">

                        <br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>