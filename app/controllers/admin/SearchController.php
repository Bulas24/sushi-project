<?php


namespace app\controllers\admin;


class SearchController extends AppController
{
    public function indexAction()
    {
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if ($query){
            $products = \R::getAll("SELECT product.*, category.title AS cat FROM product
                    JOIN category ON category.id = product.category_id 
                    WHERE product.title LIKE ? ORDER BY product.category_id", ["%$query%"]);
        }
        $this->setMeta('Поиск по: '.h($query));
        $this->set(compact('products','query'));
    }

    public function typeaheadAction()
    {
        if ($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query){
                $products = \R::getAll("SELECT id, title FROM product WHERE title LIKE ? LIMIT 11", ["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die;
    }
}