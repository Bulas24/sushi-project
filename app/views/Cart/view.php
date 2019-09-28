
<!--prdt-starts-->

<div class="wraper">
            <div class="col-sm-12">
                <div class="cart_view">
                    <div>
                        <h2>Корзина</h2>
                    </div>
                    <?php if(!empty($_SESSION['cart'])):?>
                        <?php
                        $curr = \ishop\App::$app->getProperty('currency');
                        ?>
                        <div>
                                <?php foreach($_SESSION['cart'] as $id => $item): ?>

                                    <div class="col-xs-12 col-lg-12 blockff cart_block">
                                        <div class="cart_img">
                                            <img data-src="images/<?= $item['img'] ?>" alt="<?=$item['title'] ?>" title="<?=$item['title'] ?>" class="img-thumbnail">
                                        </div>
                                        <div class="cart_inf">
                                            <h5>Наименование</h5>
                                            <div><?=$item['title'] ?></div>
                                        </div>
                                        <div class="cart_price">
                                            <h5>Цена</h5>
                                            <div><?=round($item['price']) ?></div>
                                        </div>
                                        <div class="cart_upr" data-id="<?=$id?>">
                                            <h5>Количество</h5>
                                            <div class="number_cart" data-id="<?=$id?>">
                                                <span class="minus">-</span>
                                                <input type="text" value="<?=$item['qty'];?>" data-id="<?=$id;?>" min="1" readonly>
                                                <span class="plus">+</span>
                                            </div>
                                        </div>

                                        <div class="pr_total">
                                            <h5>Итого</h5>
                                            <div data-id="<?=$id?>"><?=$_SESSION['cart.currency']['symbol_left'] .' '. round($item['price']*$item['qty']). " {$_SESSION['cart.currency']['symbol_right']}";?></div>
                                        </div>
                                        <div class="cart_del">
                                        <a href="/cart/delete/?id=<?=$id ?>"><span data-id="<?=$id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <div>
                                <h2>Добавки</h2>
                                <?php if (!empty($hits)):?>
                                    <?php $j=0;?>
                                <?php foreach ($hits as $hit) :?>

                                    <?php if (($j % 6) == 0){
                                        echo "<div class='dop_cat_b1'>";
                                    }
                                    ;?>
                                    <?php ++$j;?>

                                    <div class="col-lg-2  col-xs-12 dop_cart">
                                        <div>
                                            <div class="img_dop">
                                                <img data-src="images/<?=$hit['img'];?>">
                                            </div>
                                            <div class="dop_name"><?=$hit['title'];?></div>
                                            <div class="dop_price">
                                                <span class="item_price base_price" data-id="<?=$hit['id'];?>" data-base="<?=round($hit['price']*$curr['value']);?>"> <?=$curr['symbol_left'];?> <?=round($hit['price']*$curr['value']);?> <?=$curr['symbol_right'];?></span>
                                                <?php if ($hit['old_price']): ?>
                                                    <small><del class="base_price_old" data-id="<?=$hit['id'];?>" data-baseold="<?=round($hit['old_price']*$curr['value']);?>"><?=$curr['symbol_left'];?> <?=round($hit['old_price']*$curr['value']);?> <?=$curr['symbol_right'];?> </del></small>
                                                <?php endif;?></div>
                                            <div class="qtu_cart">
                                                <div class="number_cart quantity" data-id="<?=$hit['id']?>">
                                                    <span class="minus">-</span>
                                                    <input type="text" value="1" data-id="<?=$hit['id'];?>" min="1" name="quantity" readonly>
                                                    <span class="plus">+</span>
                                                </div>
                                            </div>
                                            <div class="add_cart">
                                                <a class="add-to-cart-link btn" href="cart/add?id=<?=$hit['id'];?>" data-id="<?=$hit['id'];?>"><span>В корзину</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ( $j % 6 == 0){
                                        echo "</div>";
                                    }
                                    ;?>
                                <?php endforeach;?>
                                    <?php if ( $j % 6 > 0){
                                        echo "</div>";
                                    }
                                    ;?>
                                <?php endif;?>
                            </div>

                            <div>
                                <h2>Оформление заказа</h2>
                                <form method="post" action="cart/checkout" role="form" data-toggle="validator">
                                    <div class="how_delivery">
                                        <label for="how_delivery_yes" class="delivery_check">
                                        <input type="radio" name="how_delivery" id="how_delivery_yes" checked value="0"> Доставка
                                        </label>
                                        <label for="how_delivery_no">
                                        <input type="radio" name="how_delivery" id="how_delivery_no" value="1"> Самовывоз
                                        </label>
                                    </div>
                                    <div class="col-xs-12 col-lg-12 blockff order_block">
                                        <div class="order_left">
                                        <div class="contact_order">
                                        <div class="form-group has-feedback">
                                            <label for="login">Контактные данные</label>
                                            <input type="text" name="name" class="form-control" id="login" placeholder="Имя*" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>

                                        <div class="form-group has-feedback">
                                            <input type="text" name="number" class="form-control" id="number" placeholder="Телефон*" pattern="^[0-9+]{1,}$" data-error="Телефон должен включать только числа" maxlength="12" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email*" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        </div>
                                        <div class="time_order lb_btn">
                                                <input type="radio" name="time_add" id="time_now" checked value="0">
                                            <label for="time_now">В ближайшее время</label>
                                                <input type="radio" name="time_add" id="time_check" value="1">
                                            <label for="time_check"> В указанное время</label>
                                            <input type="text" name="time" class="form-control noactive" id="time" placeholder="xx:xx" disabled>
                                        </div>
                                        </div>
                                        <div class="delivery">
                                                <div class="address_order">
                                                    <label for="address">Адрес доставки</label>
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="address_street" class="form-control address_required" id="address_street" placeholder="Улица*" required>
                                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                </div>
                                                    <div class="form-group has-feedback">
                                                        <input type="text" name="address_home" class="form-control address_required" id="address_home" placeholder="Дом*" required>
                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="address_porch" class="form-control" id="address_porch" placeholder="Подъезд">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" name="address_floor" class="form-control" id="address_floor" placeholder="Этаж">
                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" name="address_apartment" class="form-control" id="address_apartment" placeholder="кв.">
                                                    </div>
                                                    <div class="note_order">
                                                        <input type="text" name="note" class="form-control" id="note" placeholder="Примечание">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="pickup noactive">
                                            <p><b>Скидка 10% предоставляется на все меню за исключением акционных товаров и позиций по специальной цене.</b></p>
                                            <p>Выберите адрес для самовывоза заказа:</p>
                                            <select name="pickup_address_id" disabled>
                                                <?php foreach ($pickup_address as $pickup):?>
                                                <option value="<?=$pickup['id']?>"><?=$pickup['title']?></option>
                                                <?php endforeach;?>
                                            </select>
                                            <div class="note_order">
                                                <input type="text" name="note" class="form-control" placeholder="Примечание" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="delivery">Выбор оплаты</h2>
                                    <div class="col-xs-12 col-lg-12 blockff order_block order_block_bottom">
                                        <div class="delivery bottom_order">
                                    <div class="buy_order lb_btn">
                                        <div class="cart_cash_order">
                                            <input type="radio" id="pay" name="pay" value="0" checked>
                                        <label for="pay">Оплатить онлайн</label>
                                            <input type="radio" id="courier" name="pay" value="1">
                                        <label for="courier">Оплата при доставке</label>
                                        </div>
                                        <div id="delivery_courier" class="noactive lb_btn">
                                            <div class="delivery_courier_left">
                                                <input type="radio" id="delivery_cart" name="delivery" value="0" disabled checked>
                                                <label for="delivery_cart">Оплата картой курьеру</label>
                                            </div>
                                            <div class="delivery_courier_right">
                                                <input type="radio" id="delivery_cash" name="delivery" value="1" disabled>
                                                <label for="delivery_cash">Оплата наличными</label>
                                            </div>
                                            <div class="form-group has-feedback noactive change_money">
                                                <p>Подготовить сдачу с : <input type="text" class="form-control" name="change_money" data-error="Введите числовое значение" pattern="^[0-9+]{1,}$" disabled></p>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>

                                        <div class="bottom_order_total">
                                            <h3>Итого всего:</h3>
                                            <div class="shop_sum"><?= $_SESSION['cart.currency']['symbol_left'] .' '. round($_SESSION['cart.sum']) . " {$_SESSION['cart.currency']['symbol_right']}" ?></div>
                                            <button type="submit" class="btn">Оформить</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

<!--                                <tr>-->
<!--                                    <td>Итого:</td>-->
<!--                                    <td colspan="4" class="text-right cart-qty">--><?//=$_SESSION['cart.qty'] ?><!--</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>На сумму:</td>-->
<!--                                    <td colspan="4" class="text-right cart-sum">--><?//= $_SESSION['cart.currency']['symbol_left'] .' '. round($_SESSION['cart.sum']) . " {$_SESSION['cart.currency']['symbol_right']}" ?><!--</td>-->
<!--                                </tr>-->
                        </div>
<!--                        <div class="col-md-6 account-left">-->
<!--                            <form method="post" action="cart/checkout" role="form" data-toggle="validator">-->
<!--                                --><?php //if(!isset($_SESSION['user'])): ?>
<!--                                    <div class="cart-login"><h3>Регистрация</h3><a class="btn btn-default" href="user/login">Вход</a></div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="login">Login</label>-->
<!--                                        <input type="text" name="login" class="form-control" id="login" placeholder="Login" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                    </div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="pasword">Password</label>-->
<!--                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-minlength="6" data-error="Пароль должен включать не менее 6 символов" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                        <div class="help-block with-errors"></div>-->
<!--                                    </div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="name">Имя</label>-->
<!--                                        <input type="text" name="name" class="form-control" id="name" placeholder="Имя" value="--><?//= isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '' ?><!--" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                    </div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="name">Телефон</label>-->
<!--                                        <input type="text" name="number" class="form-control" id="number" pattern="^[0-9]{1,}$"-->
<!--                                               data-error="Телефон должен включать 11 чисел" data-minlength="11" maxlength="11" placeholder="8 9XX XXX XXXX" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                        <div class="help-block with-errors"></div>-->
<!--                                    </div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="email">Email</label>-->
<!--                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="--><?//= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?><!--" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                    </div>-->
<!--                                    <div class="form-group has-feedback">-->
<!--                                        <label for="address">Address</label>-->
<!--                                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="--><?//= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '' ?><!--" required>-->
<!--                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                                    </div>-->
<!--                                --><?php //endif; ?>
<!--                                <div class="form-group">-->
<!--                                    <label for="address">Примечание</label>-->
<!--                                    <textarea name="note" class="form-control"></textarea>-->
<!--                                </div>-->
<!--                                <div class="form-group has-feedback">-->
<!---->
<!--                                    <label for="courier">-->
<!--                                        <input type="radio" id="courier" name="pay" value="courier" required>-->
<!--                                        Оплата курьеру-->
<!--                                    </label>-->
<!--                                    <label for="pay">-->
<!--                                        <input type="radio" id="pay" name="pay" value="pay" required>-->
<!--                                        Оплатить онлайн-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn btn-default">Оформить</button>-->
<!--                            </form>-->
<!--                            --><?php //if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
<!--                        </div>-->
                    <?php else: ?>
                        <h3>Корзина пуста</h3>
                    <?php endif;?>
                </div>
            </div>
</div>
<!--product-end-->
