<?php


namespace app\controllers;




use ishop\Cache;

class MainController extends AppController
{
        public function indexAction()
        {
                $categorys = \R::getAll("SELECT * FROM category");
                $products = \R::getAll("SELECT * FROM product WHERE status = '1'");
                $modif = \R::getAll("SELECT * FROM modification");
                $prodContent= \R::getAll("SELECT * FROM prod_content");
                $banners = \R::getAll("SELECT * FROM banners");
                $canonical = PATH;
                $this->setMeta('Доставка суши, роллов, пиццы', 'Доставка суши, роллов, пиццы', 'Суши, роллы, пицца, еда');
                $this->set(compact('products','prodContent','categorys','modif', 'canonical','banners'));

        }
}