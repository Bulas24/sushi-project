<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование бренда <?=$brand->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/brand">Список брендов</a></li>
        <li class="active">Редактирование бренда</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/brand/edit" method="post" data-toggle="validator">
                    <?php if (isset($_SESSION['single'])) unset($_SESSION['single']);?>
                    <?php if (isset($_SESSION['multi'])) unset($_SESSION['multi']);?>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?=h($brand->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" name="description" id="description" value="<?=h($brand->description);?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="<?=h($brand->keywords);?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?=h($brand->content);?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single" class="btn btn-success" data-url="brand/add-image" data-name="single">Загрузить</div>
                                        <p><small>Максимальный размер файла: 5 МБ</small></p>
                                        <p><small>Формат картинок: jpg, png, jpeg, gif</small></p>
                                        <p><small>Рекомендуемые размеры: 350x250</small></p>
                                        <div class="single">
                                            <img src="/images/<?=$brand->img;?>" style="max-height: 150px;
                                            <?php if ($brand->img != 'brand_no_image.jpg') :?>
                                                    cursor: pointer;
                                            <?php endif;?>" alt="Картинка часов"
                                                 data-id="<?=$brand->id;?>" data-src="<?=$brand->img;?>"
                                                <?php if ($brand->img != 'brand_no_image.jpg') :?>
                                                    class="del-item-img-brand"
                                                <?php endif;?>>
                                        </div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box box-primary box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Картинки галереи</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="multi" class="btn btn-success" data-url="brand/add-image" data-name="multi">Загрузить</div>
                                        <p><small>Максимальный размер файла: 5 МБ</small></p>
                                        <p><small>Формат картинок: jpg, png, jpeg, gif</small></p>
                                        <p><small>Рекомендуемые размеры: 1280x850</small></p>
                                        <div class="multi">
                                            <?php if (!empty($gallery)) : ?>
                                                <?php foreach ($gallery as $item) : ?>
                                                    <img src="/images/<?=$item;?>" style="max-height: 150px; cursor: pointer;" alt="Картинка часов"
                                                         data-id="<?=$brand->id;?>" data-src="<?=$item;?>" class="del-item-brand">

                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$brand->id;?>">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
