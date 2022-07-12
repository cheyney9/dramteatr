<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление спектаклями</li>
                </ol>
            </div>

            <a href="/admin/spektakl/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить спектакль</a>
            
            <h4>Список спектаклей</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Автор спектакля</th>
                    <th>Продолжительность</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($spektList as $spekt): ?>
                    <tr>
                        <td><?php echo $spekt['id']; ?></td>
                        <td><?php echo $spekt['name']; ?></td>
                        <td><?php echo $spekt['author']; ?></td>
                        <td><?php echo $spekt['length']; ?></td>  
                        <td><a href="/admin/spektakl/update/<?php echo $spekt['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/spektakl/delete/<?php echo $spekt['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        <td><a href="/admin/spektakl/view/<?php echo $spekt['id']; ?>" title="Просмотр"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/spektakl/addPhoto/<?php echo $spekt['id']; ?>" title="Добавить фото"><i class="fa fa-camera-retro"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

