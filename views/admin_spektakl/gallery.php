<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<style>
.knipa{
    background:#000;
}   
</style>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/spektakl">Управление спектаклями</a></li>
                    <li class="active">Добавить фото</li>
                </ol>
            </div>


            <div class="col-md-6 col-sm-offset-3 login-form">
            <h4>Добавить фото к спектаклю "<?=$sp['name']?>"</h4><br>
            <form method="post"  enctype = "multipart/form-data">
                <input type = "file" name = "gallery[]" multiple>
                <input type="submit" class = "knipa" name="submit" value="Загрузить" />
            </form>
            </div>
            <div class="col-sm-12"><br><br><br>
									<h2 class="title_rep text-center">Галерея</h2>
									<?php $paths = Spektakl::getGallery($id) ?>
									<?php foreach($paths as $p):?>
									<div class="col-sm-4">
										<div class="product-image-wrapper_rep_i">
											<div class="single-products_rep_i">
												<div class="productinfo_rep_i text-center">
													<img src="<?=$p?>" alt="" />
												</div>
											</div>
										</div>
									</div>
									<?php endforeach;?>                
                				</div>
        </div>
    </div>
</section>
<br><br><br><br><br><br>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>