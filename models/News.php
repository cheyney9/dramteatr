<?php

/**
 * Класс Product - модель для работы с товарами
 */
class News
{

    /**
     * Возвращает список товаров в указанной категории
     * @param type $categoryId <p>id категории</p>
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив с товарами</p>
     */

    public static function getTotalNews(){
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(news_id) AS counts FROM news';
        $result = $db->prepare($sql);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $count;
        $count = $rst['counts'];
       
        return $count;
    }

    public static function getNewsForSideBar()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT news_id, name FROM news ORDER BY date_time DESC LIMIT 5';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['news_id'];
            $products[$i]['name'] = $row['name'];
            $i++;
        }
        return $products;
    }



    public static function getNewsList($page = 1)
    {
        $limit = 5;
        // Смещение (для запроса)
        $offset = ($page - 1) * $limit;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT news_id, name, date_time, text_news FROM news ORDER BY date_time DESC LIMIT :limit OFFSET :offset';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['news_id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['text'] = $row['text_news'];
            $time = new DateTime($row['date_time']);
            $products[$i]['date'] = $time->format('d.m.Y');
            $products[$i]['time'] = $time->format('H:i');
            $i++;
        }
        return $products;
    }

    /**
     * Возвращает продукт с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getNewsById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM news WHERE news_id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }



    /**
     * Возвращаем количество товаров в указанной категории
     * @param integer $categoryId
     * @return integer
     */
  

    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */

    /**
     * Возвращает список товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getNewsListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT news_id, name, date_time FROM news ORDER BY date_time DESC');
        $newsLis = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $newsLis[$i]['id'] = $row['news_id'];
            $newsLis[$i]['name'] = $row['name'];
            $time = new DateTime($row['date_time']);
            $newsLis[$i]['date'] = $time->format('d.m.Y');
            $newsLis[$i]['time'] = $time->format('H:i');
            $i++;
        }
        return $newsLis;
    }



    

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteNewsById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM news WHERE news_id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateNewsById($id, $name, $tn)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE news
            SET 
                name = :name, 
                text_news = :text_news
            WHERE news_id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':text_news', $tn, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createNews($options)
    {
        // Соединение с БД
        $db = Db::getConnection($options['text_news']);

        $tn = nl2br($options['text_news'], true);

        // Текст запроса к БД
        $sql = 'INSERT INTO news '
                . '(name, text_news, author_id)'
                . 'VALUES '
                . '(:name, :text_news, :author_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':text_news', $tn, PDO::PARAM_STR);
        $result->bindParam(':author_id', $options['author_id'], PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }



    /**
     * Возвращает текстое пояснение наличия товара:<br/>
     * <i>0 - Под заказ, 1 - В наличии</i>
     * @param integer $availability <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImageNews($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/news/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

}
