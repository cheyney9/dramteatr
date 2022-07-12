<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Просмотр заказа</li>
                </ol>
            </div>


            <h4>Просмотр заказа №<?php echo $order['order_id']; ?></h4>
            <br/>




            <h5>Информация о заказе</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер заказа</td>
                    <td><?php echo $order['order_id']; ?></td>
                </tr>
                <tr>
                    <td>Спектакль</td>
                    <td><?php echo $pup['nam']; ?></td>
                </tr>
                <tr>
                    <td>Дата</td>
                    <td><?=Seans::dateFormat($pup['dat'])?></td>
                </tr>
                <tr>
                    <td>Время</td>
                    <td><?php echo $pup['tim']; ?></td>
                </tr>
                <?php if ($order['user_id'] != 0): ?>
                    <tr>
                        <td>ID клиента</td>
                        <td><?php echo $order['user_id']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Email клиента</b></td>
                    <td><?php echo $order['user_email']; ?></td>
                </tr>
                <tr>
                    <td><b>Телефон клиента</b></td>
                    <td><?php echo $order['user_phone']; ?></td>
                </tr>
            </table>

            <h5>Билеты в заказе</h5>

            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>Зал</th>
                    <th>Сектор</th>
                    <th>Ряд</th>
                    <th>Место</th>
                    <th>Цена</th>
                </tr>
                <?php foreach($ara as $a):?>
                    <tr>
                        <?php $ap = array(); $ap = Order::getTicketsData($a['ticket_id']); $sum += $ap['pric']?>
                        <td><?=$ap['hnam']?></td>
                        <td><?=$ap['snm']?></td>
                        <td><?=$ap['ryd']?></td>
                        <td><?=$ap['nir']?></td>
                        <td><?=$ap['pric']?></td>
                    </tr>   
                <?php endforeach;?>            
            </table>

            <a href="/admin/order/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>


</section>
<br><br><br>
<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

