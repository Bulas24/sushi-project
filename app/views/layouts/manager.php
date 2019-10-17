<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="/adminlte/">
    <link rel="shortcut icon" href="../images/star.png" type="image/png" />
    <?=$this->getMeta();?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!--    select2-->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="manager/my.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?=PATH;?>" class="logo" target="_blank">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Manager</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?=$_SESSION['user']['name'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    <?=$_SESSION['user']['name'];?>
                                    <small><?=$_SESSION['user']['number'];?></small>
                                    <small><?=$_SESSION['user']['email'];?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?=MANAGER;?>/user/edit?id=<?=$_SESSION['user']['id'];?>" class="btn btn-default btn-flat">Профиль</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/user/logout" class="btn btn-default btn-flat">Выход</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?=$_SESSION['user']['name'];?></p>
                    <a href="<?=MANAGER;?>"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <div class="header-right">
                <div class="search-bar">
                    <form action="<?=MANAGER;?>/search" method="get" autocomplete="off" class="search-form">
                        <div class="input-group">
                            <input type="text" class="typeahead form-control" id="typeahead" name="s" placeholder="Поиск товара">
                            <span class="input-group-btn">
                <button type="submit" value="" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                        </div>
                    </form>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Меню</li>
                <li><a href="<?= MANAGER ;?>/"><i class="fa fa-home"></i> <span>Home</span></a></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span>Заказы</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= MANAGER ; ?>/order">Все заказы</a></li>
                        <li><a href="<?= MANAGER ; ?>/order/new">Новые заказы</a></li>
                        <li><a href="<?= MANAGER ; ?>/order/work">Заказы в работе</a></li>
                        <li><a href="<?= MANAGER ; ?>/order/wait">Подготовленые заказы</a></li>
                        <li><a href="<?= MANAGER ; ?>/order/ok">Выполненые заказы</a></li>
                        <li><a href="<?= MANAGER ; ?>/order/online">Оплачены онлайн</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-navicon"></i> <span>Категории</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= MANAGER ; ?>/category">Список категорий</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Товары</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= MANAGER ; ?>/product">Список товаров</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Пользователи</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= MANAGER ; ?>/user">Список пользователей</a></li>
                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
                        </div>
                    <?php endif;?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']);?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?=$content;?>
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
    var path = '<?=PATH;?>',
        adminpath = '<?=MANAGER;?>';

</script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/js/ajaxupload.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="/js/validator.js"></script>
<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<script src="bower_components/ckeditor/adapters/jquery.js"></script>
<!--select2-->
<script src="bower_components/select2/dist/js/select2.full.js"></script>
<script src="../js/typeahead.bundle.js"></script>
<script src="manager/my.js"></script>
</body>
</html>
