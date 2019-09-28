<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование адреса самовывоза
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/pickup">Список адресов самовывоза</a></li>
        <li class="active">Редактирование адреса самовывоза</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/pickup/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Адрес</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Адрес" value="<?=h($address_pickup->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$address_pickup->id;?>">
                        <button type="submit" class="btn btn-success">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->