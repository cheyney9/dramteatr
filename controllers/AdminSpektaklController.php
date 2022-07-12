<?php

/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminSpektaklController extends AdminBase
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $spektList = Spektakl::getSpektsList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_spektakl/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['short_descript'] = $_POST['short_descript'];
            $options['descript'] = $_POST['descript'];
            $options['length'] = $_POST['length'];
            $options['author'] = $_POST['author'];
            $options['premier_date'] = date('Y-m-d', strtotime($_POST['premier_date']));
            

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Spektakl::createSpektakl($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["afisha_img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["afisha_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/spektakl");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_spektakl/create.php');
        return true;
    }

    public function actionAddPersSpekt()
    {
        $spekt_id = $_POST['spekt_id'];
        $pers_id = $_POST['pers_id'];
        $pos_id = $_POST['pos_id'];
        $role = $_POST['role'];

        if($role == NULL || $role == "" || !isset($role))
            $role = "нет";

        $a = Spektakl::addPersInSpekt($spekt_id, $pers_id, $pos_id, $role);
        $last = Spektakl::getLastPIS($spekt_id, $pers_id);

        $last = json_encode($last);

        // Подключаем вид
        echo $last;
        return true;
    }

    public function actionDelPers()
    {
        $spekt_id = $_POST['spektid'];
        $pers_id = $_POST['persid'];

        $a = Spektakl::delPersInSpekt($spekt_id, $pers_id);


        return true;
    }

    public function actionAddPhoto($id){
        self::checkAdmin();


        $sp = Spektakl::getSpektaklById($id);

        if (isset($_POST['submit'])) {
            foreach($_FILES["gallery"]["tmp_name"] as $key=>$val) 
                move_uploaded_file($_FILES["gallery"]["tmp_name"][$key], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/gallerys/spekt{$id}_{$key}.jpg");
                header("Location: /admin/spektakl");
        }

        require_once(ROOT . '/views/admin_spektakl/gallery.php');
        return true;
    }

    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $persList = Personal::getPersList();
        $positionsList = Personal::getPositionList();

        // Получаем данные о конкретном заказе
        $spekt = Spektakl::getSpektaklById($id);
        $prs = Personal::getPersBySpektId($id);

        // Подключаем вид
        require_once(ROOT . '/views/admin_spektakl/view.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка

        // Получаем данные о конкретном заказе
        $spekt = Spektakl::getSpektaklById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['short_descript'] = $_POST['short_descript'];
            $options['descript'] = $_POST['descript'];
            $options['length'] = $_POST['length'];
            $options['author'] = $_POST['author'];
            $options['premier_date'] = date('Y-m-d', strtotime($_POST['premier_date']));
            // Сохраняем изменения
            if (Spektakl::updateSpektById($id, $options)) {


                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["afisha_img"]["tmp_name"])) {

                    unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["afisha_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/spektakl");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_spektakl/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Spektakl::deleteSpektById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/spektakl");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_spektakl/delete.php');
        return true;
    }

}
