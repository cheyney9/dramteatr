<?php

/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminActorController extends AdminBase
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $persList = Personal::getPersList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_actors/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        $positionsList = Personal::getPositionList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['position_id'] = $_POST['position_id'];
            $options['text'] = $_POST['text_pers'];
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Personal::createPers($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["actor_img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["actor_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/actors/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/actor");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_actors/create.php');
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

        $positionsList = Personal::getPositionList();
        // Получаем данные о конкретном заказе
        $pers = Personal::getPersById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['posid'] = $_POST['posid'];
            $options['descript'] = $_POST['descript'];
            // Сохраняем изменения
            if (Personal::updatePersById($id, $options)) {


                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["pers_img"]["tmp_name"])) {

                    unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/actors/{$id}.jpg");
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["pers_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/actors/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/actor");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_actors/update.php');
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
            Personal::deletePersById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/actor");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_actors/delete.php');
        return true;
    }

}
