<?php


namespace app\controllers;


use app\widgets\filter\Filter;
use ishop\App;
use ishop\libs\Pagination;

class BrandsController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $brands = \R::findOne('brand', 'alias = ?', [$alias]);
        $gallery = \R::findAll('gallery_brand', "brand_id = ?", [$brands->id]);
        if (!$brands){
            throw new \Exception('Страница не найдена',404);
        }

        $this->setMeta($brands->title, $brands->description);
        $this->set(compact('products', 'brands', 'gallery'));
    }

    public function indexAction()
    {
        $alias = $this->route['alias'];
        $brand = \R::findOne('brand', "alias = ?", [$alias]);
        if (!$brand){
            throw new \Exception('Страница не найдена',404);
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');

        //sql запрос фильтров
        $sql_part = '';
        if (!empty($_GET['filter'])){
            $filter = Filter::getFilter();
            if ($filter){
                $cnt = Filter::getCountGroups($filter);
                $sql_part = "AND id IN(SELECT product_id FROM attribute_product WHERE
                     attr_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) = $cnt)";
            }
        }

        $total = \R::count('product', "status = '1' AND brand_id = ? $sql_part", [$brand->id]);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = \R::find('product', "status = '1' AND brand_id = ? $sql_part LIMIT $start, $perpage", [$brand->id]);

        if ($this->isAjax()){
            $this->loadView('filter', compact('products', 'pagination', 'total'));
        }

        $this->setMeta("Все продукты {$brand->title}");
        $this->set(compact('brand','products', 'pagination', 'total'));
    }
}