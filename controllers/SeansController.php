<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class SeansController
{
    public function actionView($seansId)
    {
        // Список последних товаров

        $seans_details = Seans::getSeansById($seansId);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        unset($_SESSION['seansid']);
        require_once(ROOT . '/views/seans/index.php');
        return true;
    }
}
