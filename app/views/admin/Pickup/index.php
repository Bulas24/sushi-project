<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список адресов самовывоза
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список адресов самовывоза</li>
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
                                <th>Адрес</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pickup_address as $pickup): ?>
                                <tr>
                                    <td><?=$pickup['id'];?></td>
                                    <td><?=$pickup['title'];?></td>
                                    <td><a href="<?=ADMIN;?>/pickup/edit?id=<?=$pickup['id'];?>"><i class="fa fa-fw fa-edit"></i></a>
                                        <a href="<?=ADMIN;?>/pickup/delete?id=<?=$pickup['id'];?>" class="delete"><i class="fa fa-fw fa-remove text-danger"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($pickup_address);?> адреса(-ов) из <?=$count;?>)</p>
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
