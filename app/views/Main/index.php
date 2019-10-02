<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container noslidre">
        <ul class="rslides" id="slider4">
            <li>
                <img data-src="images/slider_1920x560_derzhim_tceni-1920x560-1920x560.jpg" class="lazyload" alt="большое фото суши"/>
            </li>
            <li>
                <img data-src="images/slider_1920x560_roll-1920x560.jpg" class="lazyload" alt="большое фото суши"/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->

<!--product-start-->

<div class="wraper">

    <?php
    $curr = \ishop\App::$app->getProperty('currency');
    ?>

<?php foreach ($categorys as $category) : ?>
<div>
    <div class="h1_ogr">
        <div class="title_h1">
            <span><img data-src="/images/dote.png" class="lazyload" alt="точки"></span><?=$category['title'];?><span><img data-src="/images/dote.png" class="lazyload" alt="точки"></span>
        </div></div>
<div data-id="<?=$category['id'];?>" class="ogr blockff categ cat">

    <?php $j=0;?>
    <?php foreach ($products as $product) : ?>

    <?php if ($category['id'] == $product['category_id']): ?>

            <?php if (($j % 4) == 0 && $j == 0){
                echo "<div>";
            }elseif (($j % 4) == 0 && $j != 0){
                echo "<div class='noactive'>";
            }
            ;?>
            <?php ++$j;?>
            <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-5 col-xs-12 ">

                <div class="element element-jbpriceadvance first last">
                    <div class="jbprice-sku">

                        <span class="sku" style="display: none;">666349009</span>


                    </div>
                </div>


                <div class="image imgdp" data-id="<?=$product['id'];?>">
                    <img class="thump lazyload" data-src="images/<?=$product['img'];?>" alt="Фотография суши">
                </div>
                <div class="title_prod dop_inf" data-id="<?=$product['id'];?>">
                    <?=$product['title'];?></div>

                <div class="dwdesc">
                <div class="desc" data-id="<?=$product['id'];?>">
                    <?=$product['content'];?>
                    <?php if (iconv_strlen($product['content']) > 90):?>
                    <span class="opendes" data-id="<?=$product['id'];?>" style="display: block;"><i class="fa fa-angle-down"></i></span>
                    <span class="closedes" data-id="<?=$product['id'];?>" style="display: none;"><i class="fa fa-angle-up"></i></span>
                <?php endif;?>
                </div>
                </div>

                <div class="option">
                <?php for ($i = 0;$i < count($modif); $i++):?>
                <?php if ($modif[$i]['product_id'] == $product['id']):?>
                    <select data-id="<?=$product['id'];?>"><option>Классический</option>
                        <?php break;?>
                        <?php endif;?>
                        <?php endfor;?>
                <?php foreach ($modif as $mod):?>
                    <?php if ($mod['product_id'] == $product['id']) :?>
                                    <option data-title="<?=$mod['title'];?>" data-price="<?=round($mod['price']*$curr['value']);?>"
                                            data-priceold="<?=round($mod['old_price']*$curr['value']);?>" value="<?=$mod['id'];?>">
                                        <?=$mod['title'];?></option>
                    <?php endif;?>
                <?php endforeach;?>
                        <?php for ($i = 0;$i < count($modif); $i++):?>
                        <?php if ($modif[$i]['product_id'] == $product['id']):?>
                    </select>
                            <?php break;?>
                            <?php endif;?>
                            <?php endfor;?>
                </div>

        <div class="price">
              <span class="item_price base_price" data-id="<?=$product['id'];?>" data-base="<?=round($product['price']*$curr['value']);?>"> <?=$curr['symbol_left'];?> <?=round($product['price']*$curr['value']);?> <?=$curr['symbol_right'];?></span>
            <?php if ($product['old_price']): ?>
         <small><del class="base_price_old" data-id="<?=$product['id'];?>" data-baseold="<?=round($product['old_price']*$curr['value']);?>"><?=$curr['symbol_left'];?> <?=round($product['old_price']*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
          <?php endif;?>
            <?php for ($i = 0;$i < count($modif); $i++):?>
                <?php if ($modif[$i]['product_id'] == $product['id']):?>
                    <?php if ($modif[$i]['old_price'] && !$product['old_price']): ?>
                    <del class="base-price-del" data-id="<?=$product['id'];?>">

                    </del>
                    <?php break;?>

                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
         </div>
                <div class="add_cart">
                <a class="add-to-cart-link btn" href="cart/add?id=<?=$product['id'];?>" data-id="<?=$product['id'];?>"><span>В корзину</span></a>
                </div>
            </div>


            <div class="dop_block noactivedop " data-id="<?=$product['id'];?>">
                <div class="dop_img ">
                    <img class="big_cls close_img lazyload" data-id="<?=$product['id'];?>" data-src="images/<?=$product['img'];?>" alt="Фотография суши">

                </div>
                <div class="block_text">
                    <div class="close" data-id="<?=$product['id'];?>"><img data-src="images/close2.png" alt="закрыть" class="lazyload"></div>
                    <div class="title_i"><?=$product['title'];?></div>
                    <div class="price">
                        <span class="item_price base_price_dop" data-id="<?=$product['id'];?>" data-base="<?=round($product['price']*$curr['value']);?>"> <?=$curr['symbol_left'];?> <?=round($product['price']*$curr['value']);?> <?=$curr['symbol_right'];?></span>
                        <?php if ($product['old_price']): ?>
                            <small><del class="base_price_old_dop" data-id="<?=$product['id'];?>" data-baseold="<?=round($product['old_price']*$curr['value']);?>"><?=$curr['symbol_left'];?> <?=round($product['old_price']*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
                        <?php endif;?>
                        <?php for ($i = 0;$i < count($modif); $i++):?>
                            <?php if ($modif[$i]['product_id'] == $product['id']):?>
                                <?php if ($modif[$i]['old_price'] && !$product['old_price']): ?>
                                    <del class="base-price-del_dop" data-id="<?=$product['id'];?>">

                                    </del>
                                    <?php break;?>

                                <?php endif;?>
                            <?php endif;?>
                        <?php endfor;?>
                    </div>
                    <div class="add_cart">
                        <a class="add-to-cart-link_dop btn" href="cart/add?id=<?=$product['id'];?>" data-id="<?=$product['id'];?>"><span>В корзину</span></a>
                    </div>

                    <div class="desc"><?=$product['content'];?></div>
                    <div class="option_dop">
                        <?php for ($i = 0;$i < count($modif); $i++):?>
                    <?php if ($modif[$i]['product_id'] == $product['id']):?>
                        <select data-id="<?=$product['id'];?>"><option>Классический</option>
                            <?php break;?>
                            <?php endif;?>
                            <?php endfor;?>
                            <?php foreach ($modif as $mod):?>
                                <?php if ($mod['product_id'] == $product['id']) :?>
                                    <option data-title="<?=$mod['title'];?>" data-price="<?=round($mod['price']*$curr['value']);?>"
                                            data-priceold="<?=round($mod['old_price']*$curr['value']);?>" value="<?=$mod['id'];?>">
                                        <?=$mod['title'];?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                            <?php for ($i = 0;$i < count($modif); $i++):?>
                            <?php if ($modif[$i]['product_id'] == $product['id']):?>
                        </select>
                    <?php break;?>
                    <?php endif;?>
                    <?php endfor;?>
                    </div>
                    <div class="atribute">
                        <?php foreach ($prodContent as $prodcon):?>
                        <?php if ($prodcon['product_id'] == $product['id']) :?>
                        <div class="dop_atr">
                            <div><?=$prodcon['title'];?></div>
                            <div><?=$prodcon['value'];?></div>
                            <hr class="dot">
                        </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>


        <?php if ( $j % 4 == 0){
            echo "</div>";
            }
            ;?>
    <?php endif;?>
    <?php endforeach;?>
    <?php if ( $j % 4 > 0){
        echo "</div>";
    }
    ;?>

</div>
    <div class="knopp_wrap" data-id="<?=$category['id'];?>">
        <span></span>
        <div class="knop open" data-id="<?=$category['id'];?>">Показать еще</div>
        <div class="knop noactive closed" data-id="<?=$category['id'];?>">Скрыть добавленое</div>
    </div>
</div>
    <?php endforeach;?>

</div>

<!--product-end-->