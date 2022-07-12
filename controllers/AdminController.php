<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        $userId = User::checkLogged();

        $spektsLast = Spektakl::getSpektsForSlider();
        $persLast = Personal::getLastPers();
        $comments = Comment::getLastCommentsAdmin();

        $user = User::getUserById($userId);
        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
