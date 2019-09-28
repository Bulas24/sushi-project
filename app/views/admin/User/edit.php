<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование профиля пользователя <?=$user->name;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/user">Список пользователей</a></li>
        <li class="active">Редактирование профиля</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/user/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input type="text" class="form-control" name="login" id="login" value="<?=h($user->login);?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль, если хотите его изменить">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=h($user->name);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?=h($user->email);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="number">Телефон</label>
                            <input type="text" class="form-control" name="number" id="number" data-error="Телефон должен включать только числа"
                                   pattern="^[0-9]{1,}$" maxlength="12" placeholder="8 9XX XXX XXXX" value="<?=h($user->number);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_street">Адрес улица</label>
                            <input type="text" class="form-control" name="address_street" id="address_street" value="<?=h($user->address_street);?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_home">Адрес № дома</label>
                            <input type="text" class="form-control" name="address_home" id="address_home" value="<?=h($user->address_home);?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_porch">Адрес № подъезда</label>
                            <input type="text" class="form-control" name="address_porch" id="address_porch" value="<?=h($user->address_porch);?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_floor">Адрес № этажа</label>
                            <input type="text" class="form-control" name="address_floor" id="address_floor" value="<?=h($user->address_floor);?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_apartment">Адрес № квартиры</label>
                            <input type="text" class="form-control" name="address_apartment" id="address_apartment" value="<?=h($user->address_apartment);?>">
                        </div>
                        <div class="form-group">
                            <label>Роль</label>
                            <select name="role" id="role" class="form-control">
                                <option value="user"<?php if($user->role == 'user') echo ' selected'; ?>>Пользователь</option>
                                <option value="admin"<?php if($user->role == 'admin') echo ' selected'; ?>>Администратор</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$user->id;?>">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
            <h3>Заказы пользователя:</h3>
            <div class="box">
                <div class="box-body">
            <?php if ($orders): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
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
                                        if ($order['status'] == '2' || $order['status'] == '3'){
                                            $class = 'success';
                                        }else{
                                            $class = '';
                                        }
                                ;?>
                                <tr class="<?=$class;?>">
                                    <td><?=$order['id'];?></td>
                                    <td>
                                        <?php
                                        if($order['status'] == '2'){
                                            echo 'Завершен';
                                        }elseif($order['status'] == '3'){
                                            echo 'Оплачен';
                                        }elseif($order['status'] == '1'){
                                            echo 'В работе';
                                        }
                                        else{
                                            echo 'Новый';
                                        }
                                        ?>
                                    </td>
                                    <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                    <td><?=$order['date'];?></td>
                                    <td><?=$order['update_at'];?></td>
                                    <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a>
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
            <?php else: ?>
            <p class="text-danger">Пользователь ничего не заказывал</p>
            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
