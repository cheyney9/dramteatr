<?php

/**
 * Контроллер ProductController
 * Товар
 */
class SpektaklController
{

    /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    public function actionView($spektId)
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        // Получаем инфомрацию о товаре
        $spekt = Spektakl::getSpektaklById($spektId);

        $nearest = Seans::getNearestSeansBySpektId($spektId);

        $commList = Comment::getCommentsBySpektId($spektId);
        $persList = Personal::getPersBySpektId($spektId);

        $director = 0;
        $i = 0;
        $q = 0;
        foreach($persList as $p)
        {
            if($p['posid'] == 1)
            {
                $director = $p;
            }
        }

        $sb = News::getNewsForSideBar();


        // Подключаем вид
        require_once(ROOT . '/views/spektakl/view.php');
        return true;
    }

    public function actionAddComment()
    {

        // Получаем инфомрацию о товаре
        //$spekt = Spektakl::getSpektaklById($spektId);

        
        $spekt_id = $_POST['spekt_id'];
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];

        $a = Comment::addComment($spekt_id, $user_id, $comment);
        $last = Comment::getLastComment($a);

        $last = json_encode($last);

        // Подключаем вид
        echo $last;
        return true;
    }

    public function actionDelComment()
    {

        // Получаем инфомрацию о товаре
        //$spekt = Spektakl::getSpektaklById($spektId);
        $comm_id = $_POST['commentid'];

        $a = Comment::deleteComment($comm_id);
        
        return true;
    }

}
