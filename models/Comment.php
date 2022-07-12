<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Comment
{

    /**
     * Возвращает список товаров в указанной категории
     * @param type $categoryId <p>id категории</p>
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив с товарами</p>
     */
    public static function addComment($spekt_id, $user_id, $comment)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO feedbacks '
                . '(spekt_id, user_id, comment_text)'
                . 'VALUES '
                . '(:spekt_id, :user_id, :comment_text)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':spekt_id', $spekt_id, PDO::PARAM_INT);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':comment_text', $comment, PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }



    public static function deleteComment($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM feedbacks WHERE comment_id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    public static function getSpektID($comm)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM feedbacks WHERE comment_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $comm, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        return $result->fetch();

    }

    public static function getLastComment($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM feedbacks WHERE comment_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $seat = array();
        $seat['comment_id'] = $rst['comment_id'];
        $seat['user_firstname'] = User::getName($rst['user_id']);
        $seat['user_surname'] = User::getSurname($rst['user_id']);
        $seat['comment_text'] = $rst['comment_text'];
        $time = new DateTime($rst['date_time']);
        $seat['date'] = $time->format('d.m.Y');
        $seat['time'] = $time->format('H:i');
       
        return $seat;
    }

    public static function getLastCommentsAdmin()
    {
        $db = Db::getConnection();
        $sql = 'SELECT f.comment_id as comment_id, f.user_id as user_id, f.date_time as date_time, f.comment_text as comment_text, sp.name as spekt_name, f.spekt_id as spektid FROM feedbacks f INNER JOIN spektakls sp ON f.spekt_id = sp.spekt_id ORDER BY date_time DESC LIMIT 3';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $commList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $commList[$i]['comment_id'] = $row['comment_id'];
            $commList[$i]['user_id'] = $row['user_id'];
            $commList[$i]['user_firstname'] = User::getName($row['user_id']);
            $commList[$i]['user_surname'] = User::getSurname($row['user_id']);
            $commList[$i]['date_time'] = $row['date_time'];
            $time = new DateTime($row['date_time']);
            $commList[$i]['date'] = $time->format('d.m.Y');
            $commList[$i]['time'] = $time->format('H:i');
            $commList[$i]['comment_text'] = $row['comment_text'];
            $commList[$i]['spektid'] = $row['spektid'];
            $commList[$i]['spektname'] = $row['spekt_name'];
            $i++;
        }
        return $commList;
    }

    public static function getCommentsBySpektId($spekt_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM feedbacks WHERE spekt_id = :id ORDER BY date_time DESC';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $spekt_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $commList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $commList[$i]['comment_id'] = $row['comment_id'];
            $commList[$i]['user_id'] = $row['user_id'];
            $commList[$i]['user_firstname'] = User::getName($row['user_id']);
            $commList[$i]['user_surname'] = User::getSurname($row['user_id']);
            $commList[$i]['date_time'] = $row['date_time'];
            $time = new DateTime($row['date_time']);
            $commList[$i]['date'] = $time->format('d.m.Y');
            $commList[$i]['time'] = $time->format('H:i');
            $commList[$i]['comment_text'] = $row['comment_text'];
            $i++;
        }
        return $commList;
    }



    /**
     * Возвращает продукт с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о товаре</p>
     */
    public static function getSpektaklById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM spektakls WHERE spekt_id = :id';

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
    public static function getTotalProductsInCategory($categoryId)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */

    /**
     * Возвращает список товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getSpektsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT spekt_id, name, length, author FROM spektakls ORDER BY spekt_id ASC');
        $spektList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $spektList[$i]['id'] = $row['spekt_id'];
            $spektList[$i]['name'] = $row['name'];
            $spektList[$i]['length'] = $row['length'];
            $spektList[$i]['author'] = $row['author'];
            $i++;
        }
        return $spektList;
    }

    
    public static function getSpektsForSlider()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT spekt_id, name, author FROM spektakls ORDER BY `premier_date` DESC LIMIT 3');
        $spektList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $spektList[$i]['id'] = $row['spekt_id'];
            $spektList[$i]['name'] = $row['name'];
            $spektList[$i]['author'] = $row['author'];
            $i++;
        }
        return $spektList;
    }

    

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteSpektById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM spektakls WHERE spekt_id = :id';

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
    public static function updateSpektById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE spektakls
            SET 
                name = :name, 
                short_descript = :short_descript,
                descript = :descript, 
                length = :length, 
                author = :author, 
                premier_date = :premier_date
            WHERE spekt_id = $id";

        $lngt = intval($options['length']);
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        //$result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':short_descript', $options['short_descript'], PDO::PARAM_STR);
        $result->bindParam(':descript', $options['descript'], PDO::PARAM_STR);
        $result->bindParam(':length', $lngt, PDO::PARAM_INT);
        $result->bindParam(':author', $options['author'], PDO::PARAM_STR);
        $result->bindParam(':premier_date', $options['premier_date'], PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createSpektakl($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO spektakls '
                . '(name, short_descript, descript, length, author, premier_date,'
                . ' afisha_img)'
                . 'VALUES '
                . '(:name, :short_descript, :descript, :length, :author, :premier_date,'
                . ':afisha_img)';

        $lngt = intval($options['length']);
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':short_descript', $options['short_descript'], PDO::PARAM_STR);
        $result->bindParam(':descript', $options['descript'], PDO::PARAM_STR);
        $result->bindParam(':length', $lngt, PDO::PARAM_INT);
        $result->bindParam(':author', $options['author'], PDO::PARAM_STR);
        $result->bindParam(':premier_date', $options['premier_date'], PDO::PARAM_STR);
        $result->bindParam(':afisha_img', $options['afisha_img'], PDO::PARAM_STR);
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
    public static function getImageAfisha($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

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
