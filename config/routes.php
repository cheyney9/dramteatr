<?php

return array(
    // Товар:
    'spektakl/([0-9]+)' => 'spektakl/view/$1',
    'spektakl/addComment' => 'spektakl/addComment',
    'spektakl/delComment' => 'spektakl/delComment',
    // Каталог:
    'seans/([0-9]+)'=>'seans/view/$1',
    'afisha/([0-9]+)' => 'afisha/index/$1',

    //news
    'thenews/page-([0-9]+)'=>'newslist/index/$1',
    'newsingle/([0-9]+)'=>'singleNews/index/$1',
    // Категория товаров:
    // 'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    //'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    // Корзина:  
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController    
    'cart/delAll' => 'cart/clear',
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController    
    'cart/addAjax' => 'cart/addAjax', // actionAddAjax в CartController
    'cart/delAjax' => 'cart/delAjax',
    'cart' => 'cart/index',
    'repertoir'=>'repertoir/index',
    'truppa'=>'truppa/index',
    'pers/([0-9]+)'=>'pers/index/$1',
    // actionIndex в CartController
    
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/history' => 'cabinet/history',
    'cabinet/details/([0-9]+)' => 'cabinet/details/$1',
    'cabinet' => 'cabinet/index',
    // Управление товарами:    
    'admin/spektakl/create' => 'adminSpektakl/create',
    'admin/spektakl/update/([0-9]+)' => 'adminSpektakl/update/$1',
    'admin/spektakl/delete/([0-9]+)' => 'adminSpektakl/delete/$1',
    'admin/spektakl/view/([0-9]+)' => 'adminSpektakl/view/$1',
    'admin/spektakl/addPersSpekt' => 'adminSpektakl/addPersSpekt',
    'admin/spektakl/delPers' => 'adminSpektakl/delPers',
    'admin/spektakl/addPhoto/([0-9]+)' => 'adminSpektakl/addPhoto/$1',
    //'admin/spektakl/delPersSpekt' => 'spektakl/delComment',
    'admin/spektakl' => 'adminSpektakl/index',
    //news
    'admin/news/create' => 'adminNews/create',
    'admin/news/update/([0-9]+)' => 'adminNews/update/$1',
    'admin/news/delete/([0-9]+)' => 'adminNews/delete/$1',
    'admin/news' => 'adminNews/index',
    //pers
    'admin/actor/create' => 'adminActor/create',
    'admin/actor/update/([0-9]+)' => 'adminActor/update/$1',
    'admin/actor/delete/([0-9]+)' => 'adminActor/delete/$1',
    'admin/actor' => 'adminActor/index',
    //seans
    'admin/seans/create' => 'adminSeans/create',
    //'admin/seans/update/([0-9]+)' => 'adminSeans/update/$1',
    'admin/seans/delete/([0-9]+)' => 'adminSeans/delete/$1',
    'admin/seans/view/([0-9]+)' => 'adminSeans/view/$1',
    'admin/seans/brn'=>'adminSeans/ticketAjax',
    'admin/seans' => 'adminSeans/index',
    // Управление категориями:    
    //'admin/category/create' => 'adminCategory/create',
    //'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    //'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    //'admin/category' => 'adminCategory/index',
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',

    'admin/user/create' => 'adminUser/create',
    'admin/user/update/([0-9]+)' => 'adminUser/update/$1',
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1',
    'admin/user' => 'adminUser/index',
    // Админпанель:
    'admin' => 'admin/index',
    // О магазине
    //'contacts' => 'site/contact',
    //'about' => 'site/about',
    // Главная страница
    '([^\s]+)' => 'error/mistake',
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
