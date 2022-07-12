<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление новостями</li>
                </ol>
            </div>

            <a href="/admin/news/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить новость</a>
            
            <h4>Список новостей</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID новости</th>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Время</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($news as $new): ?>
                    <tr>
                        <td><?php echo $new['id']; ?></td>
                        <td><?php echo $new['name']; ?></td>
                        <td><?php echo $new['date']; ?></td>  
                        <td><?php echo $new['time']; ?></td> 
                        <td><a href="/admin/news/update/<?php echo $new['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/news/delete/<?php echo $new['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>