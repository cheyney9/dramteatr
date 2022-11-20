<?php

abstract class AdminBase
{

    /**
     * Метод, который проверяет пользователя на то, является ли он администратором
     * @return boolean
     */
    public static function checkAdmin()
    {

        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'admin') {
            return true;
        }
        die('Вы пытаетесь попасть на закрытую страницу');
    }

    public static function isAdmin()
    {
        if(isset($_SESSION['user']))
        {
            $user = User::getUserById($_SESSION['user']);

            if ($user['role'] == 'admin') {
                return true;
            }
            else
                return false;
        }     
        return false;   
    }
  
    public function AddMov(){
        return 0;
    }

}
