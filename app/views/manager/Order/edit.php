<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование заказа № <?=$order->id;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=MANAGER;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=MANAGER;?>/order">Список заказов</a></li>
        <li><a href="<?=MANAGER;?>/order/view?id=<?=$order->id;?>">Заказ № <?=$order->id;?></a></li>
        <li class="active">Редактирование заказа</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=MANAGER;?>/order/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name">Имя заказчика</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=h($order->name);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="number">Номер телефона</label>
                            <input type="text" class="form-control" name="number" id="number" pattern="^[0-9+]{1,}$" data-error="Телефон должен включать только числа" maxlength="12" value="<?=h($order->number);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?=h($order->email);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>


                        <div class="form-group">
                            <label for="how_delivery">Тип заказа: </label>
                            <select name="how_delivery" id="how_delivery">
                                <option value="<?=$order['how_delivery'] ? '1' : '0';?>"><?=$order['how_delivery'] ? 'Самовывоз' : 'Доставка';?></option>
                                <option value="<?=!$order['how_delivery'] ? '1' : '0';?>"><?=!$order['how_delivery'] ? 'Самовывоз' : 'Доставка';?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time_add">Время заказа: </label>
                            <select name="time_add" id="time_add">
                                <option value="<?=$order['time_add'] ? '1' : '0';?>"><?=$order['time_add'] ? 'В определенное время' : 'Ближайшее время';?></option>
                                <option value="<?=!$order['time_add'] ? '1' : '0';?>"><?=!$order['time_add'] ? 'В определенное время' : 'Ближайшее время';?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time">При указании времени заказа:</label>
                            <input type="text" class="form-control" name="time" id="time" value="<?=h($order['time']);?>">
                        </div>

                            <div class="form-group">
                                <label for="pickup_address_id">Адрес самовывоза: </label>
                                <select name="pickup_address_id" id="pickup_address_id">
                                    <?php foreach ($pickup_address as $pickup):?>
                                    <option value="<?=$pickup['id'];?>" <?php if($pickup['id'] == $order['pickup_address_id']) echo "selected";?>><?=$pickup['title'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="address_street">Улица доставки:</label>
                                <input type="text" class="form-control" name="address_street" id="address_street" value="<?=h($order['address_street']);?>">
                            </div>
                            <div class="form-group">
                                <label for="address_home">Дом доставки:</label>
                                <input type="text" class="form-control" name="address_home" id="address_home" value="<?=h($order['address_home']);?>">
                            </div>
                            <div class="form-group">
                                <label for="address_porch">Подъезд доставки:</label>
                                <input type="text" class="form-control" name="address_porch" id="address_porch" value="<?=h($order['address_porch']);?>">
                            </div>
                            <div class="form-group">
                                <label for="address_floor">Этаж доставки:</label>
                                <input type="text" class="form-control" name="address_floor" id="address_floor" value="<?=h($order['address_floor']);?>">
                            </div>
                            <div class="form-group">
                                <label for="address_apartment">Квартира доставки:</label>
                                <input type="text" class="form-control" name="address_apartment" id="address_apartment" value="<?=h($order['address_apartment']);?>">
                            </div>


                            <div class="form-group">
                                <label for="delivery">Способ оплаты при доставке: </label>
                                <select name="delivery" id="delivery">
                                    <option value="<?=$order['delivery'] ? '1' : '0';?>"><?=$order['delivery'] ? 'Наличными' : 'Картой';?></option>
                                    <option value="<?=!$order['delivery'] ? '1' : '0';?>"><?=!$order['delivery'] ? 'Наличными' : 'Картой';?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="change_money">При оплате наличными, сдача с:</label>
                                <input type="text" class="form-control" name="change_money" id="change_money" value="<?=h($order['change_money']);?>">
                            </div>

                        <div class="form-group">
                            <label for="note_man">Примечание менеджера к заказу:</label>
                            <input type="text" class="form-control" name="note_man" id="note_man" value="<?=h($order['note_man']);?>">
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$order->id;?>">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
