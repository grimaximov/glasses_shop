<?php


namespace app\controllers;



use diplom\Cache;

class MainController extends AppController
{



    public function indexAction(){
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 4");
        $this->set(compact('brands', 'hits'));
        $this-> setMeta('Зоркий клуб', 'Это фронт-контроллер', 'очки зрение оптика');

}
}