<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="/">
    <?php if (!empty($canonical)) : ?>
        <link rel="canonical" href="<?=$canonical?>" />
    <?php endif;?>
    <link rel="shortcut icon" href="images/favicon(1).ico" type="image/x-icon" />
    <?=$this->getMeta();?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="fonts/fontawesome/css/all.css" rel="stylesheet">
    <link href="css/newStyle.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<!--top-header-->
<div class="top_block">
    <div class="wraper">
        <div class="logo">
            <a href="<?=PATH;?>"><img data-src="images/IMG_0420.png" title="Лого" alt="Лого" class="img-responsive lazyload"></a>
        </div>
        <div class="phone_top">
            <span>Звоните по номеру:</span>
            <div class="n_phone">
                99-999-99</div>
        </div>
        <div class="rabota">
            <img data-src="/images/prinimaem.png" class="lazyload" alt="прием">
            <span>Приём заказов:</span>
            Ежедневно с 10 до 23,
            по ПТ и СБ с 10 до 24</div>
        <div class="call_phone">
            <a class="foot-tel" href="tel:999999"><img data-src="images/phone-1.png" class="lazyload" alt="телефон"></a>
        </div>
        <div class="cart btn-group btn-block" id="cart">
            <a href="cart/show" onclick="getCart(); return false;" class="dropdown-toggle" data-toggle="dropdown">
                <div class="total">
                    <img data-src="images/cart.png" class="lazyload" alt="Картинка корзины" />
                    <?php if (!empty($_SESSION['cart'])):?>
                        <span class="simpleCart_total" style="font-size: 22px;"><?=$_SESSION['cart.currency']['symbol_left'].' '.round($_SESSION['cart.sum']).' '.$_SESSION['cart.currency']['symbol_right']?>
                                        </span>
                    <?php else:?>
                        <span class="simpleCart_total" style="font-size: 14px;">В корзине пусто :(</span>
                    <?php endif;?>
                </div>
            </a>
            <ul class="dropdown-menu pull-right modal-cart"></ul>
        </div>
    </div>
</div>

<div class="menu-container">
    <div class="menu">
        <div class="wraper" style="overflow: hidden; padding: 0px 25px; position: relative;">
        <?php new \app\widgets\menu\Menu([
            'tpl' => WWW.'/menu/menu.php',
            'class' => 'menu_cat topmenu slick-menu',
        ]);?>
        </div>
    </div>
</div>
<!--top-header-->
<div class="content">
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
<!--footer-starts-->
<footer>
    <div class="wraper">
        <div class="infor-top">

            <div class="col-md-9 footer_col2">
                <div class="f_menu">
                    <?php new \app\widgets\menu\Menu([
                        'tpl' => WWW.'/menu/menu.php',
                        'class' => 'menu_cat_f',
                    ]);?>
                </div>
            </div>
            <div class="col-md-3 footer_col3">
                <div class="f_phone">
                    <span>Звоните:</span>

                    <a class="foot-tel" href="tel:999999">99-999-99</a>
                </div>
            </div>
            <div class="col-md-12 footer_bnht">
                <div class="footer_col1">
                    <div class="f_rabota">
                        <span class="f_title">
                        Прием заказов
                        </span>
                        <p>Ежедневно с 10 до 23,
                        по ПТ и СБ с 10 до 24</p>
                    </div>
                </div>
                <div class="footer_col3">
                    <div class="f_social">
                        <a href="#"><img data-src="images/iconmonstr-vk-5-32.png" class="lazyload" alt="vk"></a>
                        <a href="#"><img data-src="images/iconmonstr-instagram-15-32.png" class="lazyload" alt="inst"></a>
                        <a href="#"><img data-src="images/iconmonstr-facebook-5-32.png" class="lazyload" alt="fb"></a>
                    </div>
                    <div class="copirait">© 2019 Служба доставки Суши</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer-end-->

<div id="form_order_q" class="">
    <div class="close" onclick="closeModal(); return false;"><img src="images/close2.png" alt="закрыть"></div>
    <p class="form_modal">Отправьте заявку и наши операторы перезвонят вам в кратчайшее время</p>
    <form method="post" action="cart/checkout" role="form" data-toggle="validator">
    <div class="contact_order">
        <div class="form-group has-feedback">
            <label for="login">Контактные данные</label>
            <input type="text" name="name" class="form-control" id="login" placeholder="Имя*" disabled>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="text" name="number" class="form-control" id="number" placeholder="Телефон*" pattern="^[0-9+]{1,}$" data-error="Телефон должен включать только числа" maxlength="12" disabled>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email*" disabled>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
    </div>
        <button type="submit" class="btn">Оформить</button>
    </form>
    <p class="desc">Нажимая кнопку "Оформить" вы даете свое согласие на обработку персональных данных.</p>
</div>

<div class="preloader"><img src="images/ring.svg" alt="Картинка загрузки"></div>

<div id="form_buy" class="">
    <div class="close" onclick="closeModalBuy(); return false;"><img src="images/close2.png" alt="закрыть"></div>
    <p class="form_modal">Отправьте заявку и разработчик свяжется с Вами в ближайщее время.</p>
    <p class="form_modal">Вы всегда можете связаться напрямую с разработчиком по адресу arkad-plus@mail.ru</p>
    <p class="form_modal">Любые вопросы относительно сайта обсуждаемы, возможны внесения индивидуальных правок</p>
    <form method="post" action="cart/buycheck" role="form" data-toggle="validator">
        <div class="contact_order">
            <div class="form-group has-feedback">
                <label for="login">Контактные данные</label>
                <input type="text" name="name" class="form-control" id="login" placeholder="Имя*" disabled>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" name="number" class="form-control" id="number" placeholder="Телефон*" pattern="^[0-9+]{1,}$" data-error="Телефон должен включать только числа" maxlength="12" disabled>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email*" disabled>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
    <p class="desc">На сайте реализовано все необходимое для доставки,есть админ панель сайта. Через админ панель можете менять все под свои нужды: товары, их карточки, вывод товаров со скидкой на главную, добавление модификаций товара с различной ценной, меню, фильтры, осуществлять работу с пользователями и заказами т. д.
        Реализована система онлайн оплаты, email уведомлений.</p>
    <p class="desc">Сайт адаптирован под мобильные устройства.

        Вы просто получаете готовое решение, с минимальным необходимым функционалом для ведения бизнеса и увеличения прибыли:)</p>
</div>
<div class="buy_btn">
    <a href="#" class="btn" onclick="getModalBuy(); return false;">Хочу сайт!</a>
</div>

<?php $curr = \ishop\App::$app->getProperty('currency'); ?>
        <script>
            var path = '<?=PATH;?>',
                course = <?=$curr['value'];?>,
                symbolLeft = '<?=$curr['symbol_left'];?>',
                symbolRight = '<?=$curr['symbol_right'];?>';
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/validator.js"></script>
        <script src="js/jquery-cookie-master/jquery-cookie-master/src/jquery.cookie.js"></script>
        <!--dropdown-->
        <script src="js/jquery.easydropdown.js"></script>
        <!--Slider-Starts-Here-->
        <script src="js/responsiveslides.min.js"></script>
        <script src="js/typeahead.bundle.js"></script>
<!-- FlexSlider -->
        <script src="js/imagezoom.js"></script>
        <script defer src="js/jquery.flexslider.js"></script>
    <script src="js/jquery.easydropdown.js"></script>
<!--Slick script-->
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script defer src="fonts/fontawesome//js/all.js"></script>
<script src="js/lazysizes.min.js" async=""></script>
    <script src="js/main.js"></script>
        <!--End-slider-script-->
</body>
</html>
