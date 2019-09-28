<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cache;

class AppController extends Controller
{
        public function __construct($route)
        {
            parent::__construct($route);
            new AppModel();
            App::$app->setProperty('currencies', Currency::getCurrencies());
            App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));
            App::$app->setProperty('cats', self::cacheCategory());
//            App::$app->setProperty('brands', self::cacheBrands());
        }

        public static function cacheCategory()
        {
            $cache = Cache::instance();
            $cats = $cache->get('cats');
            if (!$cats){
                $cats = \R:: getAssoc("SELECT * FROM category ");
                $cache->set('cats', $cats);
            }
            return $cats;
        }

    public static function cacheBrands()
    {
        $cache = Cache::instance();
        $brand = $cache->get('brands');
        if (!$brand){
            $brand = \R:: getAssoc("SELECT * FROM brand ");
            $cache->set('brands', $brand);
        }
        return $brand;
    }
}