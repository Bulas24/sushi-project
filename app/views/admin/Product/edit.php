<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование товара <?=$product->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Редактирование товар</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/product/edit" method="post" data-toggle="validator">
                    <?php if (isset($_SESSION['single'])) unset($_SESSION['single']);?>
                    <?php if (isset($_SESSION['multi'])) unset($_SESSION['multi']);?>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование товара</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара"
                                   value="<?=h($product->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/selecteditprod.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'class' => 'form-control',
                                'attrs' => [
                                    'name' => 'category_id',
                                    'id' => 'category_id',
                                ],
                            ]) ?>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="price">Цена</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Цена товара" pattern="^[0-9.]{1,}$"
                                   value="<?=$product->price;?>"
                                   data-error="Допускаются цифры и десятичная точка" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="old_price">Старая цена</label>
                            <input type="text" name="old_price" class="form-control" id="old_price" placeholder="Старая цена товара" pattern="^[0-9.]{1,}$"
                                   <?php if ($product->old_price):?>
                                   value="<?= $product->old_price ;?>"
                                    <?php endif;?>
                                   data-error="Допускаются цифры и десятичная точка">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ключевые слова"
                                   value="<?=h($product->keywords);?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Описание"
                                   value="<?=h($product->description);?>">
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?=$product->content;?></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" <?=$product->status ? ' checked' : null;?>> В наличии
                            </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="hit" <?=$product->hit ? ' checked' : null;?>> Хит
                            </label>
                        </div>

<!--                        <div class="form-group">-->
<!--                            <label for="related">Связанные товары</label>-->
<!--                            <select name="related[]" class="form-control select2" id="related" multiple="">-->
<!--                                --><?php //if (!empty($related_product)) :?>
<!--                                    --><?php //foreach ($related_product as $item) : ?>
<!--                                        <option value="--><?//=$item['related_id'];?><!--" selected>--><?//=$item['title'];?><!--</option>-->
<!--                                --><?php //endforeach;?>
<!--                                --><?php //endif;?>
<!--                            </select>-->
<!--                        </div>-->

                        <?php new \app\widgets\filter\Filter($filter, APP.'/widgets/filter/filter_tpl/admin_filter_tpl.php');?>

                        <div class="form-group" id="modif-groupe">
                            <div class="box-body">
                                <label for="mod_check"><input type="checkbox" <?php if(!empty($modif)):?>
                                    checked id="mod_check"
                                    <?php else:?>
                                        id="mod_check"
                                    <?php endif;?>> Модификация</label>
                                <div id="modifmodif">
                                    <?php if (!empty($modif)) : ?>
                                        <a href="#" id="modif_add" class="btn btn-success pull-right add-modif">Добавить поле</a>
                                        <?php foreach ($modif as $item) : ?>
                                            <div class="row mod-del">
                                                 <div class="col-xs-3" id="modif_title">
                                                  <input type="text" name="modif[title][]" class="form-control" placeholder="Наименование" value="<?=$item['title'];?>">
                                                 </div>
                                                 <div class="col-xs-2" id="modif_price">
                                                   <input type="text" name="modif[price][]" class="form-control" placeholder="цена(только цифры)" value="<?=$item['price'];?>">
                                                 </div>
                                               <div class="col-xs-2" id="modif_old_price">
                                                  <input type="text" name="modif[old_price][]" class="form-control" placeholder="Старая цена(только цифры)" value="<?=$item['old_price'];?>">
                                              </div>
                                                <i class="fa fa-fw fa-remove text-danger delete-modif"></i>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="prod_content">
                            <div class="box-body">
                                <label for="content_check"><input type="checkbox" <?php if(!empty($prod_cont)):?>
                                        checked id="content_check"
                                    <?php else:?>
                                        id="content_check"
                                    <?php endif;?>>  Контент КБЖУ</label>
                                <div id="content_prod_all">
                                    <?php if (!empty($prod_cont)) : ?>
                                        <a href="#" id="content_add" class="btn btn-success pull-right add-content">Добавить поле</a>
                                        <?php foreach ($prod_cont as $cont) : ?>
                                            <div class="row con-del">
                                                <div class="col-xs-3" id="content_title">
                                                    <input type="text" name="prodCont[title][]" class="form-control" placeholder="Наименование" value="<?=$cont['title'];?>">
                                                </div>
                                                <div class="col-xs-2" id="content_price">
                                                    <input type="text" name="prodCont[value][]" class="form-control" placeholder="Кол-во" value="<?=$cont['value'];?>">
                                                </div>
                                                <i class="fa fa-fw fa-remove text-danger delete-content"></i>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                            </div>
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
                                        <div class="single">
                                            <img src="/images/<?=$product->img;?>" style="max-height: 150px;
                                            <?php if ($product->img != 'no_image.jpg') :?>
                                            cursor: pointer;
                                            <?php endif;?>" alt="Картинка часов"
                                                 data-id="<?=$product->id;?>" data-src="<?=$product->img;?>"
                                                <?php if ($product->img != 'no_image.jpg') :?>
                                                    class="del-item-img"
                                                 <?php endif;?>>
                                        </div>
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
<!--                                        <div class="multi">-->
<!--                                            --><?php //if (!empty($gallery)) : ?>
<!--                                            --><?php //foreach ($gallery as $item) : ?>
<!--                                                    <img src="/images/--><?//=$item;?><!--" style="max-height: 150px; cursor: pointer;" alt="Картинка часов"-->
<!--                                                    data-id="--><?//=$product->id;?><!--" data-src="--><?//=$item;?><!--" class="del-item">-->
<!---->
<!--                                                --><?php //endforeach;?>
<!--                                            --><?php //endif;?>
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="overlay">-->
<!--                                        <i class="fa fa-refresh fa-spin"></i>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$product->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
