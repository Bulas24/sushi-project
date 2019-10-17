<?php


namespace app\controllers\manager;


class MainController extends AppController
{
        public function indexAction()
        {
            $countNewOrders = \R::count('order', "status = '0' OR status = '3'");
            $countUsers = \R::count('user');
            $countProducts = \R::count('product');
            $countCategories = \R::count('category');
            $this->setMeta('Панель управления');
            $this->set(compact('countUsers','countNewOrders','countProducts','countCategories'));
        }
}