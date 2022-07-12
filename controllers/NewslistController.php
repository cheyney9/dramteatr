<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class NewslistController
{
    public function actionIndex($page = 1)
    {

        $news = News::getNewsList($page);
        $sb = News::getNewsForSideBar();
        $total = News::getTotalNews();
        $pagination = new Pagination($total, $page, 5, 'page-');
        
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        require_once(ROOT . '/views/news/index.php');
        return true;
    }
}
?>