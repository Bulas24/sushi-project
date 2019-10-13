<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование баннера <?=$banner->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/banner">Список баннеров</a></li>
        <li class="active">Редактирование баннера</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/banner/edit" method="post" data-toggle="validator">
                    <?php if (isset($_SESSION['single'])) unset($_SESSION['single']);?>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование баннера"
                                   value="<?=h($banner->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single" class="btn btn-success" data-url="banner/add-image" data-name="single">Загрузить</div>
                                        <p><small>Максимальный размер файла: 5 МБ</small></p>
                                        <p><small>Формат картинок: jpg, png, jpeg, gif</small></p>
                                        <p><small>Рекомендуемые размеры: 1920x560</small></p>
                                        <div class="single">
                                            <img src="/images/<?=$banner->img;?>" style="max-height: 150px;
                                            <?php if ($banner->img != 'no_image.jpg') :?>
                                            cursor: pointer;
                                            <?php endif;?>" alt="Картинка часов"
                                                 data-id="<?=$banner->id;?>" data-src="<?=$banner->img;?>"
                                                <?php if ($banner->img != 'no_image.jpg') :?>
                                                    class="del-banner-img"
                                                 <?php endif;?>>
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
                        <input type="hidden" name="id" value="<?=$banner->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
