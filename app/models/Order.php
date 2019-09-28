<?php


namespace app\models;


use ishop\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel
{
        public static function saveOrder($data)
        {
                $order = \R::dispense('order');
                $order->user_id = $data['user_id'];
                $order->name = $data['name'];
                $order->number = $data['number'];
                $order->email = $data['email'];

                if (isset($data['how_delivery'])){
                $order->how_delivery = $data['how_delivery'];
                }

                if (isset($data['note'])){
                    $order->note = $data['note'];
                }

                if (isset($data['time_add'])){
                    $order->time_add = $data['time_add'];
                }

                if (isset($data['time'])){
                    $order->time = $data['time'];
                }

            if (isset($data['how_delivery'])) {

                if ($data['how_delivery'] == '0') {

                    $order->address_street = $data['address_street'];
                    $order->address_home = $data['address_home'];
                    $order->address_porch = $data['address_porch'];
                    $order->address_floor = $data['address_floor'];
                    $order->address_apartment = $data['address_apartment'];
                    $order->pay = $data['pay'];
                    if (isset($data['delivery'])) {
                        $order->delivery = $data['delivery'];
                        if ($data['delivery'] == '1') {
                            if (isset($data['change_money'])) {
                                $order->change_money = $data['change_money'];
                            }
                        }
                    }
                }

            if ($data['how_delivery'] == '1'){
                if (isset($data['pickup_address_id'])){
                    $order->pickup_address_id = $data['pickup_address_id'];
                }
            }

            }



                $order->currency = $_SESSION['cart.currency']['code'];
                $order->sum = $_SESSION['cart.sum'];
                $order_id = \R::store($order);
                self::saveOrderProduct($order_id);
                return $order_id;
        }

        public static function saveOrderProduct($order_id)
        {
            $sql_part = '';
            foreach ($_SESSION['cart'] as $product_id => $product){
                $product_id = (int)$product_id;
                $product['price'] = $product['price'] * $product['qty'];
                $product['price'] = round($product['price']);
                $sql_part .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES $sql_part");
        }

        public static function mailOrder($order_id, $user_email)
        {
            try {
                // Create the Transport
                $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'),
                    App::$app->getProperty('smtp_protocol')))
                    ->setUsername(App::$app->getProperty('smtp_login'))
                    ->setPassword(App::$app->getProperty('smtp_password'))
                ;

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                ob_start();
                require APP.'/views/mail/mail_order.php';
                $body = ob_get_clean();

                $message_client = (new Swift_Message("Подтверждение заказа №{$order_id}"))
                    ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                    ->setTo($user_email)
                    ->setBody($body,'text/html')
                ;

                $message_admin = (new Swift_Message("Совершен заказ №{$order_id} на сайте"))
                    ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                    ->setTo(App::$app->getProperty('admin_email'))
                    ->setBody($body,'text/html')
                ;

                // Send the message
                $result = $mailer->send($message_client);
                $result = $mailer->send($message_admin);
            } catch (\Exception $e){

            }

            unset($_SESSION['cart']);
            unset($_SESSION['cart.qty']);
            unset($_SESSION['cart.sum']);
            unset($_SESSION['cart.currency']);

            $_SESSION['success'] = 'Спасибо за Ваш заказ, в ближайщее время с Вами свяжется менеджер для согласования заказа';
        }

    public static function mailOrderBuy($user_email)
    {
        try {
            // Create the Transport
            $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'),
                App::$app->getProperty('smtp_protocol')))
                ->setUsername(App::$app->getProperty('smtp_login'))
                ->setPassword(App::$app->getProperty('smtp_password'))
            ;

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message admin
            ob_start();
            require APP.'/views/mail/mail_order_buy.php';
            $body = ob_get_clean();

            // Create a message client
            ob_start();
            require APP.'/views/mail/mail_order_buy_client.php';
            $body_client = ob_get_clean();

            $admin_email = App::$app->getProperty('admin_email');

            $message_client = (new Swift_Message("Подтверждение отправки контактной формы"))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                ->setTo($user_email)
                ->setBody($body_client,'text/html')
            ;

            $message_admin = (new Swift_Message("Поступила заявка на покупку сайта"))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                ->setTo(App::$app->getProperty('admin_email'))
                ->setBody($body,'text/html')
            ;

            // Send the message
            $result = $mailer->send($message_client);
            $result = $mailer->send($message_admin);
        } catch (\Exception $e){

        }

        unset($_SESSION['buy']['name']);
        unset($_SESSION['buy']['number']);
        unset($_SESSION['buy']['email']);
        unset($_SESSION['buy']);

        $_SESSION['success'] = "Спасибо за выбор данного проекта, более подробная информация отправлена письмом. 
        Вы всегда можете связаться напрямую с разработчиком по адресу {$admin_email}";
    }
}