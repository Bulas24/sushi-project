<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список баннеров
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список баннеров</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя баннера</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($banners as $banner): ?>
                                <tr>
                                    <td><?=$banner['id'];?></td>
                                    <td><?=h($banner['title']);?></td>
                                    <td><a href="<?=ADMIN;?>/banner/edit?id=<?=$banner['id'];?>"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="<?=ADMIN;?>/banner/delete?id=<?=$banner['id'];?>" class="delete"><i class="fa fa-fw fa-remove text-danger"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($banners);?> баннер(-ов) из <?=$count;?>)</p>
                        <?php if ($pagination->countPages > 1):?>
                            <?=$pagination;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->