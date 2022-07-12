<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление заказами</li>
                </ol>
            </div>

            <h4>Список заказов</h4>

            <br/>

            
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Email заказчика</th>
                    <th>Телефон заказчика</th>
                    <th>Дата оформления</th>
                    <th>Время оформления</th>
                    <th>Сумма, руб.</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td>
                            <a href="/admin/order/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['phone']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['time']; ?></td>    
                        <td><?php echo $order['total']; ?></td>
                        <td><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>
<br><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

