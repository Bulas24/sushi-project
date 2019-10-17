<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый пользователь
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= ADMIN ?>/user"> Список пользователей</a></li>
        <li class="active">Добавление пользователя</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form method="post" action="<?=ADMIN;?>/user/add" role="form" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input class="form-control" name="login" id="login" type="text" value="<?= isset($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login'] : '' ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password">Пароль</label>
                            <input class="form-control" name="password" id="password" type="password" data-minlength="6" data-error="Пароль должен включать не менее 6 символов">
                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Имя</label>
                            <input class="form-control" name="name" id="name" type="text" value="<?= isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '' ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Телефон</label>
                            <input type="text" name="number" class="form-control" id="number"
                                   value="<?= isset($_SESSION['form_data']['number']) ? $_SESSION['form_data']['number'] : '' ?>"
                                   pattern="^[0-9]{1,}$" data-error="Телефон должен включать только числа" maxlength="12" placeholder="8 9XX XXX XXXX" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="address_street">Адрес улица</label>
                            <input type="text" class="form-control" name="address_street" id="address_street" value="<?= isset($_SESSION['form_data']['address_street']) ? $_SESSION['form_data']['address_street'] : '';?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_home">Адрес № дома</label>
                            <input type="text" class="form-control" name="address_home" id="address_home" value="<?=isset($_SESSION['form_data']['address_home']) ? $_SESSION['form_data']['address_home'] : '';?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_porch">Адрес № подъезда</label>
                            <input type="text" class="form-control" name="address_porch" id="address_porch" value="<?=isset($_SESSION['form_data']['address_porch']) ? $_SESSION['form_data']['address_porch'] : '';?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_floor">Адрес № этажа</label>
                            <input type="text" class="form-control" name="address_floor" id="address_floor" value="<?=isset($_SESSION['form_data']['address_floor']) ? $_SESSION['form_data']['address_floor'] : '';?>">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address_apartment">Адрес № квартиры</label>
                            <input type="text" class="form-control" name="address_apartment" id="address_apartment" value="<?=isset($_SESSION['form_data']['address_apartment']) ? $_SESSION['form_data']['address_apartment'] : '';?>">
                        </div>
                        <div class="form-group">
                            <label>Роль</label>
                            <select class="form-control" name="role">
                                <option value="user">Пользователь</option>
                                <option value="admin">Администратор</option>
                                <option value="manager">Менеджер</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
