<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='<?=PATH;?>'>Главная</a></li>
                <li>Поиск по запросу "<?=h($query);?>"</li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-9 prdt-left">
                    <?php if (!empty($products)):?>
                        <?php $curr = \ishop\App::$app->getProperty('currency');?>
                <div class="product-one">
                        <?php foreach ($products as $product):?>
                    <div class="col-md-4 product-left p-left">
                        <div class="product-main simpleCart_shelfItem">
                            <a href="product/<?=$product->alias;?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$product->img;?>" alt="Фото часов" /></a>
                            <div class="product-bottom">
                                <h3><a href="product/<?=$product->alias;?>"><?=$product->title;?></a></h3>
                                <p>Explore Now</p>
                                <h4>
                                    <a class="add-to-cart-link" href="cart/add?id=<?=$product->id;?>" data-id="<?=$product->id;?>"><i></i></a>
                                    <span class=" item_price"><?=$curr['symbol_left'];?> <?=round($product->price*$curr['value']);?> <?=$curr['symbol_right'];?></span>
                                    <?php if ($product->old_price): ?>
                                        <small><del><?=$curr['symbol_left'];?> <?=round($product->old_price*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
                                    <?php endif;?>
                                </h4>
                            </div>
                            <?php if ($product->old_price): ?>
                                <div class="srch">
                                    <span>-<?=round(($product->old_price - $product->price)*100/$product->old_price);?> %</span>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                        <?php endforeach;?>
                    <div class="clearfix"></div>
                </div>
                <?php endif;?>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--prdt-end-->
