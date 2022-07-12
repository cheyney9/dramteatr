<?php

class AdminNewsController extends AdminBase
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $news = News::getNewsListAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/index.php');
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
            $options['text_news'] = $_POST['text_news'];
            $options['author_id'] = $_SESSION['user'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = News::createNews($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["news_img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["news_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/news");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/create.php');
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
        $news = News::getNewsById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $name = $_POST['name'];
            $text_news = $_POST['text_news'];
            // Сохраняем изменения
            if (News::updateNewsById($id, $name, $text_news)) {


                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["news_img"]["tmp_name"])) {

                    unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["afisha_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/news");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/update.php');
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
            News::deleteNewsById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/news");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/delete.php');
        return true;
    }

}
