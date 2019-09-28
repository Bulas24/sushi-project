<?php if (!empty($_SESSION['cart'])): ?>
<li><div class="table-responsive scrol">
    <table class="table table-hover table-striped">
        <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $item):?>
                <tr>
                    <td class="text-center" id="img_cart"><img class="img-thumbnail" src="images/<?=$item['img'];?>" alt="фото часов"></td>
                    <td class="text-left title_td"><?=$item['title'];?></td>
                    <td class="text-right qty_td">
                        <div class="qty_modal">
                        <span class="minus">-</span>
                        <input type="text" value="<?=$item['qty'];?>" data-id="<?=$id;?>" min="1" readonly>
                        <span class="plus">+</span>
                        </div>
                    </td>
                    <td class="text-right new_price_cart" data-id="<?=$id;?>" data-price="<?=round($item['price']*$item['qty']);?>"><?=round($item['price']*$item['qty']);?></td>
                    <td class="text-center del_td"><span data-id="<?=$id;?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
</li>
<li>
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <td class="text-left">Итого:</td>
                <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart.qty'];?></td>
            </tr>
            <tr>
                <td class="text-left">На сумму:</td>
                <td colspan="4" class="text-right cart-sum" data-price="<?= round($_SESSION['cart.sum'])?>"><?=$_SESSION['cart.currency']['symbol_left'].' '.
                    round($_SESSION['cart.sum']).' '.$_SESSION['cart.currency']['symbol_right'];?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="add_cart">
    <p><a class="btn" href="cart/view" data-id=""><span>Оформить</span></a></p>
    <p><a id="openerder" class="btn" href="#" data-id="" onclick="getModal(); return false;"><span>Купить в один клик</span></a></p>
    <p><button type="button" class="btn clear_cart" onclick="clearCart()"><span>Очистить корзину</span></button></p>
    </div>
</li>
<?php else:?>
<li><h4>Ваша корзина пуста!</h4></li>
<?php endif;?>
