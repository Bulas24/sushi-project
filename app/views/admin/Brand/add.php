<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый бренд
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/brand">Список брендов</a></li>
        <li class="active">Новый бренд</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/brand/add" method="post" data-toggle="validator">
                    <?php if (isset($_SESSION['single'])) unset($_SESSION['single']);?>
                    <?php if (isset($_SESSION['multi'])) unset($_SESSION['multi']);?>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование бренда</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование бренда"
                                   value="<?= isset($_SESSION['form_data']['title']) ? h($_SESSION['form_data']['title']) : null;?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" name="description" id="description" value="<?= isset($_SESSION['form_data']['description']) ? h($_SESSION['form_data']['description']) : null;?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="<?= isset($_SESSION['form_data']['keywords']) ? h($_SESSION['form_data']['keywords']) : null;?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?= isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : null;?></textarea>
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
                                        <div class="single"></div>
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
                                        <div class="multi"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']);?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->