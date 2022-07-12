<?php

/**
 * Контроллер AdminCategoryController
 * Управление категориями товаров в админпанели
 */
class AdminSeansController extends AdminBase
{

    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        $seanses=Seans::getSeansList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_seans/index.php');
        return true;
    }

    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $seans = Seans::getSeansById($id);
        $tickets = Ticket::getTicketsBySpektAdmin($id);

        // Получаем данные о конкретном заказе
        //$spekt = Spektakl::getSpektaklById($id);
        //$prs = Personal::getPersBySpektId($id);

        // Подключаем вид
        require_once(ROOT . '/views/admin_seans/view.php');
        return true;
    }

    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        $spektsList = Spektakl::getSpektsList();
        $hallList = Hall::getHallList();
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            $options['spekt_id'] = $_POST['spekt_id'];
            $options['hall_id'] = $_POST['hall_id'];
            $options['date'] = date('Y-m-d', strtotime($_POST['date']));
            $options['time'] = $_POST['time'];

            if($options['date'] == '1970-01-01')
                $_SESSION['error_seans_add'] = 'Введите дату';
            elseif(Seans::validateSeansAdd($options['date'], $options['hall_id'])) {
                $_SESSION['error_seans_add'] = 'На эту дату уже есть спектакль';
            }

            if (!isset($_SESSION['error_seans_add'])) {
                $result = Seans::createSeans($options);

                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/seans");
            }

        }

        require_once(ROOT . '/views/admin_seans/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();
        $spektsList = Spektakl::getSpektsList();
        $hallList = Hall::getHallList();
        // Получаем данные о конкретной категории
        $seans = Seans::getSeansById($id);
        $seans['date'] = date('d.m.Y');

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $spekt_id = $_POST['spekt_id'];
            $hall_id = $_POST['spekt_id'];
            $date = date('Y-m-d', strtotime($_POST['date']));
            $time = $_POST['time'];

            
            Seans::updateSeans($id, $spekt_id, $hall_id, $date, $time);
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_seans/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            Seans::deleteSeansById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/seans");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_seans/delete.php');
        return true;
    }

    public function actionTicketAjax()
    {
        self::checkAdmin();
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        $id = $_POST['eid'];
        $a = Ticket::broneTicketAjax($id);

        echo $a;
        return true;
    }

}
