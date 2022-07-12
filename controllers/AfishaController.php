<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class AfishaController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex($m)
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        // Список категорий для левого меню
        // Список последних товаров

        $d = date("Y-m-d");
        list($day, $month, $year) = explode("-", $d);

        $cur_month = $month;
        $next_month = $month+1;
        $next_next_month = $month+2;

        $nearestSpekts = Seans::getNearestSeans($m);

        // Подключаем вид
        require_once(ROOT . '/views/afisha/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
