<?php


namespace app\controllers\manager;


use app\models\admin\Order;
use ishop\libs\Pagination;

class OrderController extends AppController
{
        public function indexAction()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = 10;
            $count = \R::count('order');
            $pagination = new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

            $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
            $this->setMeta('Список всех заказов');
            $this->set(compact('orders', 'pagination', 'count'));
        }

        public function viewAction()
        {
            $order_id = $this->getRequestID();
            $user_order = \R::getRow("SELECT `order`.`id`, `order`.`user_id`, `user`.`name`, `user`.`email`, `user`.`number`,
            `user`.`address_street`, `user`.`address_home`, `user`.`address_porch`, `user`.`address_floor`,
            `user`.`address_apartment`,`user`.`login` FROM `order`
             JOIN `user` ON `order`.`user_id` = `user`.`id`
             WHERE `order`.`id` = ?
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);

            $order = \R::getRow("SELECT `order`.*, `pickup_address`.`id` AS `pickup_address_id`, `pickup_address`.`title` AS pickup_address_title FROM `order`
            LEFT JOIN `pickup_address` ON `pickup_address`.`id` = `order`.`pickup_address_id`
            WHERE `order`.`id` = ?",[$order_id]);
            if (!$order){
                throw new \Exception('Страница не найдена', 404);
            }
            $order_products = \R::findAll('order_product', "order_id = ?", [$order_id]);
            $this->setMeta("Заказ № {$order_id}");
            $this->set(compact('order', 'order_products','user_order'));

        }

        public function changeAction()
        {
            $order_id = $this->getRequestID();
            if (!empty($_GET['status']) && $_GET['status'] == 0){
                $status = '0';
            }
            if (!empty($_GET['status']) && $_GET['status'] == 1){
                $status = '1';
            }
            if (!empty($_GET['status']) && $_GET['status'] == 2){
                $status = '2';
            }
            if (!empty($_GET['status']) && $_GET['status'] == 4){
                $status = '4';
            }
            $order = \R::load('order', $order_id);
            if (!$order){
                throw new \Exception('Страница не найдена', 404);
            }
            $order->status = $status;
            $order->update_at = date("Y-m-d H:i:s");
            \R::store($order);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
        }

        public function editAction()
        {
            if (!empty($_POST)){
                $id = $this->getRequestID(false);
                $order = new Order();

                $data = $_POST;
                $order->load($data);

                $order->attributes['how_delivery'] = $order->attributes['how_delivery'] ? '1' : '0';
                $order->attributes['time_add'] = $order->attributes['time_add'] ? '1' : '0';
                $order->attributes['delivery'] = $order->attributes['delivery'] ? '1' : '0';

                if (!$order->validate($data)){
                    $order->getErrors();
                    redirect();
                }
                if ($order->update('order', $id)){
                    $_SESSION['success'] = 'Изменения сохранены';
                }
                redirect(MANAGER."/order/view?id={$id}");
            }

            $order_id = $this->getRequestID();
            $order = \R::load('order', $order_id);
            if (!$order){
                throw new \Exception('Страница не найдена', 404);
            }

            $pickup_address = \R::getAll("SELECT * FROM pickup_address");

            $this->setMeta('Редактирование заказа');
            $this->set(compact( 'order','pickup_address'));
        }

        public function newAction()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = 10;
            $count = \R::count('order',"status = '0'");
            $pagination = new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

            $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE `order`.`status` = '0'
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
            $this->setMeta('Список новых заказов');
            $this->set(compact('orders', 'pagination', 'count'));
        }

    public function workAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('order',"status = '1'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE `order`.`status` = '1'
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
        $this->setMeta('Список заказов в работе');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function waitAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('order',"status = '4'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE `order`.`status` = '4'
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
        $this->setMeta('Список подготовленных заказов');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function okAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('order',"status = '2'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE `order`.`status` = '2'
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
        $this->setMeta('Список выполненых заказов');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function onlineAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('order',"status = '3'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`, `order`.`name`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE `order`.`status` = '3'
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
        $this->setMeta('Список заказов оплаченных онлайн');
        $this->set(compact('orders', 'pagination', 'count'));
    }
}