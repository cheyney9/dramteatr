<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/seans">Управление сеансами</a></li>
                    <li class="active">Просмотр сеанса</li>
                </ol>
            </div>


            <h4><?php echo $seans['spekt_name']; ?></h4>
            <h5><?=$seans['date']?> в <?=$seans['time']?></h5>
            <br/>

            <h5>Информация о заказе</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер сеанса</td>
                    <td><?php echo $seans['id']; ?></td>
                </tr>
                <tr>
                    <td>Имя спектакля</td>
                    <td><?php echo $seans['spekt_name']; ?></td>
                </tr>
                <tr>
                    <td>Длительность</td>
                    <td><?php echo $seans['lng']; ?></td>
                </tr>
                <tr>
                    <td>Дата проведения</td>
                    <td><?php echo $seans['date']; ?></td>
                </tr>
                <tr>
                    <td><b>Время проведения</b></td>
                    <td><?php echo $seans['time'] ?></td>
                </tr>
                <tr>
                    <td><b>Зал</b></td>
                    <td><?php echo $seans['hall_name']; ?></td>
                </tr>
            </table>

            <h5>Билеты на спектакль</h5>
            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>Сектор</th>
                    <th>Ряд</th>
                    <th>Место</th>
                    <th>Цена</th>
                    <th>Занят</th>
                </tr>
                <?php foreach ($tickets as $t): ?>
                    <tr class = "tatr">
                        <td><?php echo $t['secname']; ?></td>
                        <td><?php echo $t['ryd']; ?></td>
                        <td><?php echo $t['nir']; ?></td>
                        <td><?php echo $t['pric']; ?></td>
                        <?php if($t['bron'] == 1):?>
                            <td><input id = "chek" data-ticket = "<?=$t['ticketid']?>" data-bron = "<?=$t['bron']?>" type = "checkbox" checked></td>
                        <?php else:?>
                            <td><input id = "chek" data-ticket = "<?=$t['ticketid']?>" data-bron = "<?=$t['bron']?>" type = "checkbox"></td>
                        <?php endif;?>
                    </tr>
                <?php endforeach; ?>
            </table>
            

            <a href="/admin/seans/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>


</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>