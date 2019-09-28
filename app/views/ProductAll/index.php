<?php
$curr = \ishop\App::$app->getProperty('currency');
$cats = \ishop\App::$app->getProperty('cats');
$brand = \ishop\App::$app->getProperty('brands');
?>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href='<?=PATH;?>'>Главная</a></li>
                    <li>Все просмотренные</li>
                </ol>
            </div>
        </div>
    </div>

<div class="single contact productall">
<div class="container">
<div class="col-md-12 single-main-left">
    <div class="latestproducts">
        <?php if ($recentlyViewedAll) :?>
        <div class="product-one">
            <h4>Ваши все раннее просмотренные товары:</h4>
            <?php foreach ($recentlyViewedAll as $recently):?>
                <div class="col-md-4 product-left p-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="product/<?=$recently['alias'];?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$recently['img'];?>" alt="<?=$recently['alias'];?>" /></a>
                        <div class="product-bottom">
                            <h3><a href="product/<?=$recently['alias'];?>"><?=$recently['title'];?></a></h3>
                            <p>Explore Now</p>
                            <h4><a class="item_add add-to-cart-link" href="cart/add?id=<?=$recently['id'];?>" data-id="<?=$recently['id'];?>"><i></i></a> <span class=" item_price"><?=$curr['symbol_left'];?> <?=round($recently['price']*$curr['value']);?> <?=$curr['symbol_right'];?></span>
                                <?php if ($recently['old_price']): ?>
                                    <small><del><?=$curr['symbol_left'];?> <?=round($recently['old_price']*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
                                <?php endif;?>
                            </h4>
                        </div>
                        <?php if ($recently['old_price']): ?>
                            <div class="srch">
                                <span>-<?=round(($recently['old_price'] - $recently['price'])*100/$recently['old_price']);?>%</span>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach;?>
            <div class="clearfix"></div>
        </div>
        <?php endif;?>
        <?php if (!$recentlyViewedAll) : ?>
        <h3>Вы пока не смотрели товары</h3>
        <?php endif;?>
    </div>

</div>
</div>
</div>

