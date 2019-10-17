<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Заказ № <?=$order['id'];?>
        <?php if (!$order['status']):?>
            <a href="<?=MANAGER;?>/order/change?id=<?=$order['id'];?>&status=1" class="btn btn-default btn-xs">Отправить в работу</a>
        <?php elseif($order['status'] == '1'):?>
            <a href="<?=MANAGER;?>/order/change?id=<?=$order['id'];?>&status=4" class="btn btn-info btn-xs">Подготовлен</a>
        <?php elseif($order['status'] == '4'):?>
            <a href="<?=MANAGER;?>/order/change?id=<?=$order['id'];?>&status=2" class="btn btn-success btn-xs">Выполнить</a>
        <?php elseif($order['status'] == '3'):?>
            <a href="<?=MANAGER;?>/order/change?id=<?=$order['id'];?>&status=1" class="btn btn-default btn-xs">Отправить в работу</a>
        <?php elseif($order['status'] == '2'):?>
            <a href="<?=MANAGER;?>/order/change?id=<?=$order['id'];?>&status=1" class="btn btn-default btn-xs">Вернуть в работу</a>
        <?php endif;?>
        <a href="<?=MANAGER;?>/order/edit?id=<?=$order['id'];?>" class="btn btn-primary btn-xs">Редактировать заказ</a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=MANAGER;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=MANAGER;?>/order">Список заказов</a></li>
        <li class="active">Заказ №<?=$order['id'];?></a></li>
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
                            <tbody>
                                <tr>
                                    <td>Номер заказа</td>
                                    <td><?=$order['id'];?></td>
                                </tr>
                                <tr>
                                    <td>Тип заказа</td>
                                    <td><?=$order['how_delivery'] ? 'Самовывоз' : 'Доставка';?></td>
                                </tr>
                                <tr>
                                    <td>Статус заказа</td>
                                    <td>
                                        <?php
                                        if($order['status'] == '2'){
                                            echo 'Завершен';
                                        }elseif($order['status'] == '3'){
                                            echo 'Оплачен';
                                        }elseif($order['status'] == '1'){
                                            echo 'В работе';
                                        }
                                        elseif($order['status'] == '4'){
                                            echo 'Подготовлен';
                                        }
                                        else{
                                            echo 'Новый';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Время заказа</td>
                                    <td><?=$order['time_add'] ? "Приготовить в ". h($order['time']) : "Ближайщее время";?></td>
                                </tr>
                                <tr>
                                    <td>Дата создания заказа</td>
                                    <td><?=$order['date'];?></td>
                                </tr>
                                <tr>
                                    <td>Дата изменения заказа</td>
                                    <td><?=$order['update_at'];?></td>
                                </tr>
                                <tr>
                                    <td>Количество позиций в заказе</td>
                                    <td><?=count($order_products);?></td>
                                </tr>
                                <tr>
                                    <td>Сумма заказа</td>
                                    <td class="<?=$order['status'] ? 'success' : 'active';?>"><?=$order['sum'];?> <?=$order['currency'];?></td>
                                </tr>
                                <tr>
                                    <td>Имя заказчика</td>
                                    <td><?=h($order['name']);?></td>
                                </tr>
                                <tr>
                                    <td>Телефон заказчика</td>
                                    <td><?=h($order['number']);?></td>
                                </tr>
                                <tr>
                                    <td>Email заказчика</td>
                                    <td><?=h($order['email']);?></td>
                                </tr>
                                <?php if ($order['how_delivery']):?>
                                <?php if(!empty($order['pickup_address_id'])) :?>
                                    <tr>
                                        <td>Адрес самовывоза</td>
                                        <td><?=$order['pickup_address_title'];?></td>
                                    </tr>
                                <?php endif;?>
                                <?php else:?>
                                    <tr>
                                        <td>Адрес доставки</td>
                                        <td><?=h($order['address_street']);?> д. <?=h($order['address_home']);?>, подъезд: <?=h($order['address_porch']);?>, этаж: <?=h($order['address_floor']);?>, кв. <?=h($order['address_apartment']);?></td>
                                    </tr>
                                    <tr>
                                        <td>Оплата</td>
                                        <td><?=$order['pay'] ? 'Оплата при доставке': 'Онлайн оплата';?></td>
                                    </tr>
                                <?php if ($order['pay']):?>
                                        <tr>
                                            <td>Способ оплаты</td>
                                            <td><?=$order['delivery'] ? 'Наличными': 'Картой';?></td>
                                        </tr>
                                    <?php if ($order['delivery']):?>
                                            <tr>
                                                <td>Подготовить сдачу с</td>
                                                <td><?=h($order['change_money']);?></td>
                                            </tr>
                                    <?endif;?>
                                <?endif;?>
                                <?php endif;?>
                                <tr>
                                    <td>Комментарий к заказу</td>
                                    <td><?=h($order['note']);?></td>
                                </tr>

                            <?php if (!empty($order['note_man'])):?>
                                <tr>
                                    <td>Комментарий менеджера к заказу</td>
                                    <td><?=h($order['note_man']);?></td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h3>Детали заказа</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $qty = 0; foreach ($order_products as $product):?>
                                <tr>
                                    <td><?=$product->product_id;?></td>
                                    <td><?=$product->title;?></td>
                                    <td><?=$product->qty; $qty += $product->qty;?> </td>
                                    <td><?=$product->price;?> <?=$order['currency'];?></td>
                                    </tr>
                                <?php endforeach;?>
                                    <tr class="active">
                                        <td colspan="2">
                                            <b>Итого:</b>
                                        </td>
                                        <td><b><?=$qty;?></b></td>
                                        <td><b><?=$order['sum'];?> <?=$order['currency'];?></b></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <h3>Зарегистрированный пользователь</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Телефон</th>
                                <th>Адрес</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$user_order['name'];?></td>
                                    <td><?=$user_order['email'];?> </td>
                                    <td><?=$user_order['number'];?></td>
                                    <td><?=$user_order['address_street'];?> д. <?=$user_order['address_home'];?>, подъезд: <?=$user_order['address_porch'];?>, этаж: <?=$user_order['address_floor'];?>, кв. <?=$user_order['address_apartment'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
