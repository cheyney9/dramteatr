<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление сеансами</li>
                </ol>
            </div>

            <a href="/admin/seans/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить сеанс</a>
            
            <h4>Список сеансов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID сеанса</th>
                    <th>Спектакль</th>
                    <th>Дата</th>
                    <th>Время</th>
                    <th>Зал</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($seanses as $seans): ?>
                    <tr>
                        <td><?php echo $seans['seans_id']; ?></td>
                        <td><?php echo $seans['name']; ?></td>
                        <td><?php echo $seans['date']; ?></td>
                        <td><?php echo $seans['time']; ?></td>  
                        <td><?php echo $seans['hall']; ?></td>  
                        <td><a href="/admin/seans/delete/<?php echo $seans['seans_id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        <td><a href="/admin/seans/view/<?php echo $seans['seans_id']; ?>" title="Подробнее"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>
<br><br><br>

<?php //include ROOT . '/views/layouts/footer_admin.php'; ?>

