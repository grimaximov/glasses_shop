<?php


namespace app\controllers;


use app\models\AppModel;
use diplom\base\Controller;
use diplom\App;
use diplom\Cache;


class AppController extends Controller{

    public function __construct($route){
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty('cats', self::cacheCategory());
    }

    public static function cacheCategory(){
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if(!$cats){
            $cats = \R::getAssoc("SELECT * FROM category");
            $cache->set('cats', $cats);
        }
        return $cats;
    }

}