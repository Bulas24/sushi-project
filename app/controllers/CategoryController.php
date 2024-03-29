<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use app\widgets\filter\Filter;
use ishop\App;
use ishop\libs\Pagination;

class CategoryController extends AppController
{
        public function viewAction()
        {
            $alias = $this->route['alias'];
            $category = \R::findOne('category', 'alias = ?', [$alias]);
            if (!$category){
                throw new \Exception('Страница не найдена',404);
            }

            // модификации
            $modif = \R::getAll("SELECT * FROM modification");

            //контент продуктов
            $prodContent= \R::getAll("SELECT * FROM prod_content");

            // хлебные крошки
            $breadcrumbs = $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);

            $cat_model = new Category();
            $ids = $cat_model->getIds($category->id);
            $ids = !$ids ? $category->id : $ids . $category->id;

            //пагинация
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

            $total = \R::count('product', "status = '1' AND category_id IN ($ids) $sql_part");
            $pagination = new Pagination($page, $perpage, $total);
            $start = $pagination->getStart();

            $products = \R::find('product',"status = '1' AND category_id IN ($ids) $sql_part LIMIT $start, $perpage");

            if ($this->isAjax()){
                $this->loadView('filter', compact('products', 'pagination', 'total','modif','prodContent','category'));
            }

            $this->setMeta($category->title, $category->description, $category->keywords);
            $this->set(compact('products','breadcrumbs', 'pagination', 'total','modif','prodContent','category'));

        }
}