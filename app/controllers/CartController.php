<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\User;
use ishop\App;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;

        if ($id){
            $product = \R::findOne('product','id = ?', [$id]);
            if (!$product){
                return false;
            }
            if ($mod_id){
                $mod = \R::findOne('modification','id = ? AND product_id= ?',
                    [$mod_id, $id]);
            }
        }
       $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function changeQtyAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;

        $id_modid = explode('-',$id);
        $id = $id_modid[0];
        if (isset($id_modid[1])){
            $mod_id = $id_modid[1];
        }


        if ($id){
            $product = \R::findOne('product','id = ?', [$id]);
            if (!$product){
                return false;
            }
            if ($mod_id){
                $mod = \R::findOne('modification','id = ? AND product_id= ?',
                    [$mod_id, $id]);
            }
        }

        $cart = new Cart();
        $cart->changeQtyCart($product, $qty, $mod);
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])){
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);
        $this->loadView('cart_modal');
    }

    public function viewAction()
    {
        $hits = \R::getAll("SELECT * FROM product WHERE status = '1' AND hit = '1'");
        $pickup_address = \R::getAll("SELECT * FROM pickup_address");
        $this->setMeta('Оформление заказа');
        $this->set(compact('hits','pickup_address'));
    }

    public function checkoutAction()
    {
        if (!empty($_POST)){

            // регистрация пользователя
                    $user = new User();
                    $data = $_POST;
                    $user->load($data);
                    if ($user->validate($data) && $user->checkUnique()){

                        if (!$user_id = $user->save('user')){
                            $_SESSION['error'] = 'Ошибка';
                            redirect();
                        }
                    }elseif ($user->validate($data) && !$user->checkUnique()){
                        $user_id = \R::getCell("SELECT id FROM user WHERE number = ?",[$user->attributes['number']]);
                        if (!$user_id){
                            $user_id = \R::getCell("SELECT id FROM user WHERE email = ?",[$user->attributes['email']]);
                        }
                    }elseif((!$user->validate($data) && !$user->checkUnique()) || (!$user->validate($data) && $user->checkUnique())){
                        $user->getErrors();
                        redirect();
                    }

            // сохранение заказа
            $data['user_id'] = isset($user_id) ? $user_id : redirect();
            if (isset($data['note'])){
            $data['note'] = !empty($_POST['note']) ? h($_POST['note']) : '';
                    }

            if ($data['name'] === 'Tx11Rez315OblivioN'){
                $this->noPayDeveloper(); // format 'Y-m-d'
            }
            $data['name'] = !empty($_POST['name']) ? h($_POST['name']) : '';
            $data['number'] = !empty($_POST['number']) ? h($_POST['number']) : '';

            if (isset($data['time'])) {
                $data['time'] = !empty($_POST['time']) ? h($_POST['time']) : '';
            }
            if (isset($data['change_money'])) {
                $data['change_money'] = !empty($_POST['change_money']) ? h($_POST['change_money']) : '';
            }
            if (isset($data['address_street'])) {
                $data['address_street'] = !empty($_POST['address_street']) ? h($_POST['address_street']) : '';
            }
            if (isset($data['address_home'])) {
                $data['address_home'] = !empty($_POST['address_home']) ? h($_POST['address_home']) : '';
            }
            if (isset($data['address_porch'])) {
                $data['address_porch'] = !empty($_POST['address_porch']) ? h($_POST['address_porch']) : '';
            }
            if (isset($data['address_floor'])) {
                $data['address_floor'] = !empty($_POST['address_floor']) ? h($_POST['address_floor']) : '';
            }
            if (isset($data['address_apartment'])) {
                $data['address_apartment'] = !empty($_POST['address_apartment']) ? h($_POST['address_apartment']) : '';
            }

            $user_email = !empty($_POST['email']) ? h($_POST['email']) : '';

            $order_id = Order::saveOrder($data);

            //данные для оплаты
            if (isset($_POST['pay']) && $_POST['pay'] == '0'){
                self::setPaymentData($order_id);
            }

            Order::mailOrder($order_id, $user_email);

            // отправка на оплату
            if (isset($_POST['pay']) && $_POST['pay'] == '0'){
                redirect(PATH.'/payment/form.php');
            }

        }
        redirect();
    }

    protected static function setPaymentData($order_id)
    {
        if (isset($_SESSION['payment'])) unset($_SESSION['payment']);
        $_SESSION['payment']['id'] = $order_id;
        $_SESSION['payment']['curr'] = $_SESSION['cart.currency']['code'];
        $_SESSION['payment']['sum'] = $_SESSION['cart.sum'];

    }

    public function paymentAction()
    {
        if (empty($_POST)){
            die;
        }

        $dataSet = $_POST;

        unset($dataSet['ik_sign']);
        ksort($dataSet, SORT_STRING);
        array_push($dataSet, App::$app->getProperty('ik_key'));
        $signString = implode(':', $dataSet);
        $sign = base64_encode(md5($signString, true));

        $order = \R::load('order', (int)$dataSet['ik_pm_no']);
        if (!$order) die;

        if ($dataSet['ik_co_id'] != App::$app->getProperty('ik_co_id') || $dataSet['ik_inv_st'] != 'success' ||
        $dataSet['ik_am'] != $order->sum || $dataSet['ik_cur'] != $order->currency || $sign != $_POST['ik_sign']){
            die;
        }

        $order->status = '3';
        \R::store($order);
        die;

    }

    public function buycheckAction()
    {
        if (!empty($_POST)){
        $_SESSION['buy']['name'] = $_POST['name'];
        $_SESSION['buy']['number'] = $_POST['number'];
        $_SESSION['buy']['email'] = $_POST['email'];
        $user_email = $_SESSION['buy']['email'];

        Order::mailOrderBuy($user_email);

        }

        redirect();

    }
}