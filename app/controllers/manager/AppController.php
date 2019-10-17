<?php


namespace app\controllers\manager;


use app\models\AppModel;
use app\models\User;
use ishop\base\Controller;

class AppController extends Controller
{
        public $layout = 'manager';

        public function __construct($route)
        {
            parent::__construct($route);
            if (!User::isManager() && $route['action'] != 'login-manager'){
                redirect(MANAGER.'/user/login-manager');
            }

            new AppModel();
        }

        public function getRequestID($get = true, $id = 'id')
        {
            if ($get){
                $data = $_GET;
            }else {
                $data = $_POST;
            }
            $id = !empty($data[$id]) ? (int)$data[$id] : null;
            if (!$id){
                throw new \Exception('Страница не найдена', 404);
            }
            return $id;
        }
}