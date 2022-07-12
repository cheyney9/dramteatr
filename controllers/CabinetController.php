<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        unset($_SESSION['seansid']);
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        //$user_orders = Order::getProductsListUser($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    public function actionDetails($id)
    {
        $details = Order::getProductsUserDetails($id);
        require_once(ROOT . '/views/cabinet/details.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */

    public function actionHistory()
    {
        $userId = User::checkLogged();
        $user_orders = Order::getHistoryUser($userId);

        $ticketsIDS = array();

        //
        //

        require_once(ROOT . '/views/cabinet/history.php');
        return true;
    }

    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['firstname'];
        $lastname = $user['lastname'];
        $surname = $user['surname'];
        $email = $user['email'];
        $phone = $user['phone_number'];
        $password = $user['password'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['fistname'];
            $lastname = $_POST['midname'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $lastname, $surname, $email, $phone, $password);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

}
