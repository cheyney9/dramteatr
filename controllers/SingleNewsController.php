<?php

/**
 * Контроллер ProductController
 * Товар
 */
class SingleNewsController
{

    public function actionIndex($newsId)
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        // Получаем инфомрацию о товаре
        $news = News::getNewsById($newsId);

        $sb = News::getNewsForSideBar();
        
        $time = new DateTime($news['date_time']);
        $ns = array();
        $ns['date'] = $time->format('d.m.Y');
        $ns['time'] = $time->format('H:i');
        $ns['author_firstname'] = User::getName($news['author_id']);
        $ns['author_surname'] = User::getSurname($news['author_id']);



        // Подключаем вид
        require_once(ROOT . '/views/single_news/index.php');
        return true;
    }


}
?>