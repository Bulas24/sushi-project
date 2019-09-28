<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список подготовленных заказов
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/order"><i class="fa fa-dashboard"></i> Список всех заказов</a></li>
        <li class="active">Список подготовленных заказов</li>
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
                                <th>Имя заказчика</th>
                                <th>Статус</th>
                                <th>Сумма</th>
                                <th>Дата создания</th>
                                <th>Дата изменения</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order): ?>
                                <?php
                                if($order['status'] == '2'){
                                    $class = 'success';
                                    $text = 'Завершен';
                                }elseif($order['status'] == '3'){
                                    $class = 'info';
                                    $text = 'Оплачен';
                                }elseif($order['status'] == '1'){
                                    $class = 'active';
                                    $text = 'В работе';
                                }
                                elseif($order['status'] == '4'){
                                    $class = 'warning';
                                    $text = 'Подготовлен';
                                }
                                else{
                                    $class = '';
                                    $text = 'Новый';
                                }
                                ?>
                                <tr class="<?=$class;?>">
                                    <td><?=$order['id'];?></td>
                                    <td><?=h($order['name']);?></td>
                                    <td><?=$text?></td>
                                    <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                    <td><?=$order['date'];?></td>
                                    <td><?=$order['update_at'];?></td>
                                    <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a>
                                        <a href="<?=ADMIN;?>/order/delete?id=<?=$order['id'];?>" class="delete"><i class="fa fa-fw fa-remove text-danger"></i></a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($orders);?> заказа(-ов) из <?=$count;?>)</p>
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
