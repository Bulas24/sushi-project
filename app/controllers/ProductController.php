<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\ProductModel;

class ProductController extends AppController
{
        public function viewAction()
        {
            $alias = $this->route['alias'];
            $product = \R::findOne("product", "alias = ? AND status = '1'", [$alias]);
            if (!$product){
                throw new \Exception("Страница продукта {$alias} не найдена",404);
            }

            // хлебные крошки

            $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

            // связанные товары
            $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);

            // запись в куки запрошенного товара
            $p_model = new ProductModel();
            $p_model->setRecentlyViewed($product->id);

            // просмотренные товары
            $r_viewed = $p_model->getRecentlyViewed();
            $recentlyViewed = null;
            if ($r_viewed){
                    $recentlyViewed = \R::find('product', 'id IN (' .\R::genSlots
                        ($r_viewed) . ') LIMIT 3', $r_viewed);
            }

            $r_viewedAll= $p_model->getAllRecentlyViewed();
            $recentlyViewedAll = null;
            if ($r_viewedAll){
                $recentlyViewedAll = explode('.', $r_viewedAll);
                $recentlyViewedAll = \R::find('product', 'id IN (' .\R::genSlots
                    ($recentlyViewedAll) . ')', $recentlyViewedAll);
            }

            //галерея
            $gallery = \R::findAll('gallery',"product_id = ?", [$product->id]);

            // модификации товара
            $mods = \R::findAll('modification',"product_id = ?", [$product->id]);

            $this->setMeta($product->title, $product->description, $product->keywords);
            $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'recentlyViewedAll',
                'breadcrumbs', 'mods'));


        }
}