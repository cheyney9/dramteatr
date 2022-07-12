<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/spektakl">Управление спектаклями</a></li>
                    <li class="active">Детали спектакля</li>
                </ol>
            </div>


            <h4>Просмотр спектакля <?php echo $spekt['name']; ?></h4>
            <br/>




            <h5>Информация о спектакле</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер спектакля</td>
                    <td><?php echo $spekt['spekt_id']; ?></td>
                </tr>
                <tr>
                    <td>Название спектакля</td>
                    <td><?php echo $spekt['name']; ?></td>
                </tr>
                <tr>
                    <td>Длительность</td>
                    <td><?php echo $spekt['length']; ?> минут</td>
                </tr>
                <tr>
                    <td>Автор</td>
                    <td><?php echo $spekt['author']; ?></td>
                </tr>
                <tr>
                    <td><b>Краткое описание</b></td>
                    <td><?php echo $spekt['short_descript']; ?></td>
                </tr>
                <tr>
                    <td><b>Описание</b></td>
                    <td><?php echo $spekt['descript']; ?></td>
                </tr>
            </table>
            <br><br>
            <h3>Творческий коллектив спектакля</h3>
            <h4 class= "title">Добавить сотрудника</h4><br>
            <div class="col-sm-5 login-form">
			<form class = "actf">
                <input type="hidden" class = "spekt_id" name="spekt_id" value="<?=$spekt['spekt_id'];?>">
				<div class="mb-4">
					<label for="exampleFormControlTextarea1" class="form-label">Выберите сотрудника</label><br>
					<select class = "persid form-control form-control-lg">
                        <?php foreach($persList as $ps):?>
                            <option value="<?php echo $ps['id']; ?>">
                                        <?php echo $ps['name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select><br><br>
                    <label for="exampleFormControlTextarea1" class="form-label">Выберите должность</label><br>
                    <select class = "posid form-control form-control-lg">
                        <?php foreach($positionsList as $pos):?>
                            <option value="<?php echo $pos['id']; ?>">
                                        <?php echo $pos['pos_name']; ?>
                            </option>
                        <?php endforeach;?>
                    </select><br><br>
                    <label for="exampleFormControlTextarea1" class="form-label">Введите роль</label><br>
                    <input type = "text" class = "role"><br>
				</div>
				<div class="mb-3">
					<button type="button" class="btn btn-primary"  id = "actform" >Добавить</button>
				</div>
            </form>
        </div>
        <div class="col-sm-4 actorsadmin">
                <?php foreach ($prs as $p): ?>
                <div class="one-comment col-10 pjija diplomzavtra<?=$spekt['spekt_id']?>_<?=$p['persid']?>">
                    <h4><?php echo $p['name'];?></h4>
					<span class = "title"><?php echo mb_strtoupper($p['pos_name']);?></span>
                    <?php if($p['posid'] == 2):?>
                        <span class = "title">, Роль: <?php echo $p['role_spekt'];?></span>	
                    <?php endif;?>
                    <div class="mussar" data-persid = "<?=$p['persid']?>" data-spektid = "<?=$spekt['spekt_id']?>">Удалить</div>
				</div><hr>
                <?php endforeach; ?>   
        </div>
            
</section>
</div><br><br><br><br><br>
<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
