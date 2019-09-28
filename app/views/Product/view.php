<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?=$breadcrumbs;?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-12 single-main-left wesss">
                <div class="sngl-top">
                    <div class="col-md-4 single-top-left product-flex">
                        <?php if ($gallery):?>
                        <div class="flexslider">
                            <ul class="slides">
                                <?php foreach ($gallery as $img):?>
                                <li data-thumb="images/<?=$img->img;?>">
                                    <div class="thumb-image"> <img src="images/<?=$img->img;?>" data-imagezoom="true" class="img-responsive" alt="фотография часов"/> </div>
                                </li>
                                <?endforeach;?>
                            </ul>

                        </div>
                        <?php else:?>
                        <div>
                            <img src="images/<?=$product->img;?>" class="img-responsive" alt="фотография часов"/> </div>
                        </div>
                        <?endif;?>

                    </div>
                    <div class="col-md-7 single-top-right">
                        <?php
                        $curr = \ishop\App::$app->getProperty('currency');
                        $cats = \ishop\App::$app->getProperty('cats');
                        $brand = \ishop\App::$app->getProperty('brands');
                        ?>
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?=$product->title;?></h2>
                            <h5 class="item_price" id="base-price" data-base="<?=round($product->price*$curr['value']);?>"><?=$curr['symbol_left'];?> <?=round($product->price*$curr['value']);?> <?=$curr['symbol_right'];?></h5>
                                <?php if ($product->old_price): ?>
                                    <del id="base-price-old" data-baseold="<?=round($product->old_price*$curr['value']);?>"><?=$curr['symbol_left']?> <?=round($product->old_price*$curr['value']);?> <?=$curr['symbol_right']?> </del>
                                <?php endif;?>
                            <?php foreach ($mods as $mod):?>
                            <?php if ($mod->old_price && !$product->old_price): ?>
                                <del id="base-price-del">

                                </del>
                                <?php break;?>
                            <?php endif;?>
                            <?php endforeach;?>

                            <p><?=$product->description;?></p>
                            <?php if ($mods): ?>
                            <div class="available">
                                <ul>
                                    <li>Color
                                        <select>
                                            <option>Выбрать цвет:</option>
                                            <?php foreach ($mods as $mod):?>
                                            <option data-title="<?=$mod->title;?>" data-price="<?=round($mod->price*$curr['value']);?>"
                                                    data-priceold="<?=round($mod->old_price*$curr['value']);?>" value="<?=$mod->id;?>">
                                                <?=$mod->title;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>
                            <?php endif;?>
                            <ul class="tag-men">
                                <li><span>Brand</span>
                                    <span>: <a href="brands/<?=$brand[$product->brand_id]['alias'];?>"><?=$brand[$product->brand_id]['title'];?></a></span></li>
                                <li><span>Category</span>
                                    <span>: <a href="category/<?=$cats[$product->category_id]['alias'];?>"><?=$cats[$product->category_id]['title'];?></a></span></li>
                            </ul>
                            <div class="quantity">
                                    <input type="number" size="4" value="1" name="quantity" min="1" step="1">
                            </div>
                            <a id="productAdd" data-id="<?=$product->id;?>" href="cart/add?id=<?=$product->id;?>"
                               class="add-cart item_add add-to-cart-link">Добавить в корзину</a>
                        </div>
                        <div class="panel-group accord-panel" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-primary">
                                <div class="panel-heading" role="tab" id="heading1">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            Подробное описание
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                    <div class="panel-body"><?=$product->content;?></div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" role="tab" id="heading2">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            О марке <?=$brand[$product->brand_id]['title'];?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                    <div class="panel-body"><?=$brand[$product->brand_id]['content'];?></div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" role="tab" id="heading3">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            Доставка
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                    <div class="panel-body">
                                            <h3>Доставка</h3>
                                            <p>Стандартная доставка курьерской компанией в Ваш город в среднем занимает от 1 до 3 дней. Оформить ее вы можете домой, в офис, в пункт самовывоза курьерской компании СДЭК. Кроме того, Ваш заказ может быть доставлен в любой из наших магазинов рядом с вами (присутствие магазинов Мегачас вы можете посмотреть в разделе Адреса магазинов), где Вы сможете забрать заказ в удобное время.
                                            </p>
                                            <h3>Стоимость доставки.</h3>
                                            <p>Курьерской компанией по России при стоимости заказа от 5000 тыс.руб из рук в руки – бесплатно, если стоимость товара менее 5000 тыс.руб.(есть возможность бесплатной доставки с перемещением, обращаем Ваше внимание – доставка в данном случае более длительная) условия доставки Вы сможете уточнить у менеджера компании по бесплатному номеру телефона.
                                            </p>
                                            <p>
                                                Доставка в Москве, Санкт-Петербурге возможна при стоимости заказа от 3000 руб.
                                            </p>
                                            <p>
                                                Срочная доставка курьером – 1300р.
                                            </p>
                                        </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" role="tab" id="heading4">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            Комплектация
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                                    <div class="panel-body">
                                            <ul>
                                                <li>- Гарантийный талон от производителя с необходимыми печатями и метками. </li>
                                                <li>- Для всех часов гарантийный талон с голограммой и уникальным штрих-кодом!</li>
                                                <li>- Международный гарантийный талон</li>
                                                <li>- Товарный чек на сумму покупки</li>
                                                <li>- Инструкция на русском языке</li>
                                                <li>- Мультиязычная инструкция</li>
                                                <li>- Оригинальная упаковка</li>
                                            </ul>
                                        </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading" role="tab" id="heading5">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                            Возврат товара
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                                    <div class="panel-body">
                                            <h1>Информация о возврате товара</h1>
                                            На основании <a href="http://publication.pravo.gov.ru/Document/View/0001201605300017" rel="nofollow" target="_blank">постановления Правительства Российской Федерации от 27.05.2016 № 471 "О внесении изменений в некоторые акты Правительства Российской Федерации по вопросу возврата или обмена технически сложных товаров"</a> наручные часы внесены в список непродовольственных товаров, <b>не подлежащих возврату или обмену</b> на аналогичный товар других размера, формы, габарита, фасона, расцветки или комплектации, утвержденный постановлением Правительства Российской Федерации от 19 января 1998 г. № 55 "Об утверждении Правил продажи отдельных видов товаров, перечня товаров длительного пользования, на которые не распространяется требование покупателя о безвозмездном предоставлении ему на период ремонта или замены аналогичного товара, и перечня непродовольственных товаров надлежащего качества, не подлежащих возврату или обмену на аналогичный товар других размера, формы, габарита, фасона, расцветки или комплектации".<br><br>Также наручные часы добавлены к списку технически сложных товаров, утвержденный постановлением Правительства Российской Федерации от 10 ноября 2011г. №924 "Об утверждении перечня технически сложных товаров".
                                            <br><br>Возврат бракованного товара возможен при наличии заключения о заводском браке, выданного сервисным центром.
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <?php if ($related) :?>
                <div class="latestproducts">
                    <div class="product-one">
                        <h4>С этим товаром также часто покупают:</h4>
                        <?php foreach ($related as $item):?>
                        <div class="col-md-4 product-left p-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="product/<?=$item['alias'];?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$item['img'];?>" alt="<?=$item['alias'];?>" /></a>
                                <div class="product-bottom">
                                    <h3><a href="product/<?=$item['alias'];?>"><?=$item['title'];?></a></h3>
                                    <p>Explore Now</p>
                                    <h4><a class="item_add add-to-cart-link" href="cart/add?id=<?=$item['id'];?>" data-id="<?=$item['id'];?>"><i></i></a> <span class=" item_price"><?=$curr['symbol_left'];?> <?=round($item['price']*$curr['value']);?> <?=$curr['symbol_right'];?></span>
                                        <?php if ($item['old_price']): ?>
                                            <small><del><?=$curr['symbol_left'];?> <?=round($item['old_price']*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
                                        <?php endif;?>
                                    </h4>
                                </div>
                                <?php if ($item['old_price']): ?>
                                <div class="srch">
                                    <span>-<?=round(($item['old_price'] - $item['price'])*100/$item['old_price']);?>%</span>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endif;?>
                <?php if ($recentlyViewed) :?>
                    <div class="latestproducts">
                        <div class="product-one">
                            <h4>Вы смотрели эти товары:</h4>
                            <?php foreach ($recentlyViewed as $recently):?>
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
                    </div>
                <?php endif;?>
                <?php if ($recentlyViewedAll):?>
                <h4><a href="product-all/">Все раннее просмотренные товары...</a></h4>
                <?php endif;?>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--end-single-->
