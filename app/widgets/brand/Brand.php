<?php


namespace app\widgets\brand;


use ishop\App;
use ishop\Cache;

class Brand
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $class = '';
    protected $container = 'ul';
    protected $table = 'brand';
    protected $cache = 3600;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = [])
    {
        $this->tpl = __DIR__.'/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v){
            if (property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml){
            $this->data = App::$app->getProperty('brands');
            if (!$this->data){
                $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this->cache){
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }

    protected function output(){
        $attrs = '';
        if (!empty($this->attrs)){
            foreach ($this->attrs as $k => $v){
                $attrs .= " $k='$v' ";
            }
        }
        echo "<{$this->container} class ='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>$item) {
                $tree[$id] = $item;
        }
        return $tree;

    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $brands){
            $str .= $this->catToTemplate($brands, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($brands, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }


}