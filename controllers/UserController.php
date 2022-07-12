<?php

/**
 * Контроллер UserController
 */
class UserController
{

    public function actionRegister()
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        // Переменные для формы
        $name = false;
        $lastname = false;
        $surname = false;
        $email = false;
        $password = false;
        $phone = false;
        $result = false;

        if(!User::userAuth())
        {
            if (isset($_POST['submit'])) 
            {
                // Если форма отправлена 
                // Получаем данные из формы
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $password_confirm = $_POST['password_confirm'];

                // Флаг ошибок
                // Валидация полей



                if (!User::checkName($name)) {
                    $_SESSION['err'] = 'Имя не должно быть короче 2-х символов';
                }
                elseif(!User::checkEmail($email)) {
                    $_SESSION['err'] = 'Неправильный email';
                }
                elseif(!User::checkPassword($password)) {
                    $_SESSION['err'] = 'Пароль не должен быть короче 6-ти символов';
                }
                elseif(User::checkEmailExists($email)) {
                    $_SESSION['err'] = 'Такой email уже используется';
                }
                elseif($password!=$password_confirm){
                    $_SESSION['err'] = 'Пароли не совпадают';
                }
                
                if (!isset($_SESSION['err'])) {
                    $result = User::register($name, $lastname, $surname, $email, $password, $phone);
                }
            }
            require_once(ROOT . '/views/user/register.php');
        }
        else{
            header("Location: /cabinet");
        }

        // Подключаем вид
        
        return true;
    }
    
    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        unset($_SESSION['seansid']);
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        $email = false;
        $password = false;

        if(!User::userAuth())
        {
            if (isset($_POST['submit'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];

                $userId = User::checkUserData($email, $password);

                if (!User::checkEmail($email)) {
                    $_SESSION['err'] = 'Неправильный email';
                }
                elseif (!User::checkPassword($password)) {
                    $_SESSION['err'] = 'Пароль не должен быть короче 6-ти символов';
                }
                elseif ($userId == false) {
                    $_SESSION['err'] = 'Неверный логин либо пароль';
                } else {
                    User::auth($userId);

                    header("Location: /cabinet");
                }
            }
            require_once(ROOT . '/views/user/login.php');
        }
        else
            header("Location: /cabinet");
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {    
        unset($_SESSION["user"]);
        $pr = $_SERVER['HTTP_REFERER'];
        header("Location: $pr");
    }

}
