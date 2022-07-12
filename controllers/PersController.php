<?php

class PersController
{
    public function actionIndex($id)
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        // Получаем инфомрацию о товаре
        $pers = Personal::getPersById($id);

        $sb = News::getNewsForSideBar();

        $roles = Personal::getPersRoles($id);


        // Подключаем вид
        require_once(ROOT . '/views/pers/index.php');
        return true;
    }
}