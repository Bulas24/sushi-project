<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый товар
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Новый товар</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/product/add" method="post" data-toggle="validator" id="add">
                    <?php if (isset($_SESSION['single'])) unset($_SESSION['single']);?>
                    <?php if (isset($_SESSION['multi'])) unset($_SESSION['multi']);?>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование товара</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара"
                                   value="<?= isset($_SESSION['form_data']['title']) ? h($_SESSION['form_data']['title']) : null;?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/select.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'class' => 'form-control',
                                'attrs' => [
                                    'name' => 'category_id',
                                    'id' => 'category_id',
                                ],
                                'prepend' => '<option>Выберите категорию</option>',
                            ]) ?>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="price">Цена</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Цена товара" pattern="^[0-9.]{1,}$"
                                   value="<?= isset($_SESSION['form_data']['price']) ? h($_SESSION['form_data']['price']) : null;?>"
                                   data-error="Допускаются цифры и десятичная точка" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="old_price">Старая цена</label>
                            <input type="text" name="old_price" class="form-control" id="old_price" placeholder="Старая цена товара" pattern="^[0-9.]{1,}$"
                                   value="<?= isset($_SESSION['form_data']['old_price']) ? h($_SESSION['form_data']['old_price']) : null;?>"
                                   data-error="Допускаются цифры и десятичная точка">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ключевые слова"
                                   value="<?= isset($_SESSION['form_data']['keywords']) ? h($_SESSION['form_data']['keywords']) : null;?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Описание"
                                   value="<?= isset($_SESSION['form_data']['description']) ? h($_SESSION['form_data']['description']) : null;?>">
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?= isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : null;?></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" checked> В наличии
                            </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="hit"> Хит
                            </label>
                        </div>

<!--                        <div class="form-group">-->
<!--                            <label for="related">Связанные товары</label>-->
<!--                            <select name="related[]" class="form-control select2" id="related" multiple=""></select>-->
<!--                        </div>-->

                        <?php new \app\widgets\filter\Filter(null, APP.'/widgets/filter/filter_tpl/admin_filter_tpl.php');?>
                        <div class="form-group" id="modif-groupe">
                                <div class="box-body">
                                    <label for="mod_check"><input type="checkbox" id="mod_check"> Модификация</label>
                                    <div id="modifmodif">

                                    </div>
                                </div>
                        </div>

                        <div class="form-group" id="prod_content">
                            <div class="box-body">
                                <label for="content_check"><input type="checkbox" id="content_check"> Контент КБЖУ</label>
                                <div id="content_prod_all">

                                </div>
                            </div>
                        </div>
                                <!-- /.box-body -->
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single" class="btn btn-success" data-url="product/add-image" data-name="single">Загрузить</div>
                                        <p><small>Максимальный размер файла: 5 МБ</small></p>
                                        <p><small>Формат картинок: jpg, png, jpeg, gif</small></p>
                                        <p><small>Рекомендуемые размеры: 550x411</small></p>
                                        <div class="single"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-md-8">-->
<!--                                <div class="box box-primary box-solid file-upload">-->
<!--                                    <div class="box-header">-->
<!--                                        <h3 class="box-title">Картинки галереи</h3>-->
<!--                                    </div>-->
<!--                                    <div class="box-body">-->
<!--                                        <div id="multi" class="btn btn-success" data-url="product/add-image" data-name="multi">Загрузить</div>-->
<!--                                        <p><small>Максимальный размер файла: 5 МБ</small></p>-->
<!--                                        <p><small>Формат картинок: jpg, png, jpeg, gif</small></p>-->
<!--                                        <p><small>Рекомендуемые размеры: 700x1000</small></p>-->
<!--                                        <div class="multi"></div>-->
<!--                                    </div>-->
<!--                                    <div class="overlay">-->
<!--                                        <i class="fa fa-refresh fa-spin"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить товар</button>
                    </div>
                </form>
                <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']);?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->