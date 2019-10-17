<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список пользователей
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=MANAGER;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список пользователей</li>
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
                                <th>Email</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Адрес</th>
                                <th>Роль</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?=$user['email'];?></td>
                                    <td><?=$user['name'];?></td>
                                    <td><?=$user['number'];?></td>
                                    <td><?=$user['address_street'];?> д. <?=$user['address_home'];?>, подъезд: <?=$user['address_porch'];?>, этаж: <?=$user['address_floor'];?>, кв. <?=$user['address_apartment'];?></td>
                                    <td><?=$user['role'];?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($users);?> пользователей из <?=$count;?>)</p>
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
