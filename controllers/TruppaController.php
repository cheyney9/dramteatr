<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class TruppaController
{
    public function actionIndex()
    {

        $p = Personal::getPersList();
        $sb = News::getNewsForSideBar();
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        require_once(ROOT . '/views/truppa/index.php');
        return true;
    }
}
?>