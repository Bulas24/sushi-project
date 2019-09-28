<?php


namespace app\controllers;


use app\models\ProductModel;

class ProductAllController extends ProductController
{
    public function indexAction()
    {
        $p_model = new ProductModel();

        $r_viewedAll= $p_model->getAllRecentlyViewed();
        $recentlyViewedAll = null;
        if ($r_viewedAll){
            $recentlyViewedAll = explode('.', $r_viewedAll);
            $recentlyViewedAll = \R::find('product', 'id IN (' .\R::genSlots
                ($recentlyViewedAll) . ')', $recentlyViewedAll);
        }

        $this->set(compact('product', 'recentlyViewedAll'));
    }
}