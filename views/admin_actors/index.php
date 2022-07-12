<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление сотрудников</li>
                </ol>
            </div>

            <a href="/admin/actor/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить сотрудника</a>
            
            <h4>Список сотрудников</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID сотрудника</th>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($persList as $pers): ?>
                    <tr>
                        <td><?php echo $pers['id']; ?></td>
                        <td><?php echo $pers['name']; ?></td>
                        <td><?php echo Personal::positionName($pers['position_id']); ?></td>
                        <td><a href="/admin/actor/update/<?php echo $pers['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/actor/delete/<?php echo $pers['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section><br><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
