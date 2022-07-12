<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class RepertoirController
{
    public function actionIndex()
    {

        $spektsList = Spektakl::getSpektsList();
        $sb = News::getNewsForSideBar();
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        require_once(ROOT . '/views/repertoir/index.php');
        return true;
    }
}
?>