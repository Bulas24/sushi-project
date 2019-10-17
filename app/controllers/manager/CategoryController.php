<?php


namespace app\controllers\manager;


use app\models\AppModel;
use app\models\Category;
use ishop\App;

class CategoryController extends AppController
{
        public function indexAction()
        {
            $this->setMeta('Список категорий');
        }

}