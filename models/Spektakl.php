<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Spektakl
{
    public static function getProductsListByCategory($categoryId, $page = 1)
    {
        $limit = Product::SHOW_BY_DEFAULT;

        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = 1 AND category_id = :category_id '
                . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        $result->execute();

        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }

    public static function getSpektaklById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM spektakls WHERE spekt_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

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


    public static function delPersInSpekt($spekt_id, $pers_id)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM personal_in_spekt WHERE spekt_id = :spektid AND pers_id = :persid';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':persid', $pers_id, PDO::PARAM_INT);
        $result->bindParam(':spektid', $spekt_id, PDO::PARAM_INT);
        return $result->execute();
    }


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

    public static function addPersInSpekt($spekt_id, $pers_id, $position_id, $role_spekt)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO personal_in_spekt '
                . '(spekt_id, pers_id, position_id, role_spekt)'
                . 'VALUES '
                . '(:spekt_id, :pers_id, :position_id, :role_spekt)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':spekt_id', $spekt_id, PDO::PARAM_INT);
        $result->bindParam(':pers_id', $pers_id, PDO::PARAM_INT);
        $result->bindParam(':position_id', $position_id, PDO::PARAM_INT);
        $result->bindParam(':role_spekt', $role_spekt, PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function getLastPIS($spekt_id, $pers_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT personal_in_spekt.pers_id as pers_id, personal_in_spekt.position_id as posid, position.name as pos_name, personal_in_spekt.role_spekt as role_spekt, personal.name as namepe FROM personal_in_spekt JOIN personal ON personal_in_spekt.pers_id = personal.pers_id JOIN position ON personal_in_spekt.position_id = position.position_id WHERE personal_in_spekt.spekt_id = :spektid AND personal_in_spekt.pers_id = :persid';
        $result = $db->prepare($sql);
        $result->bindParam(':spektid', $spekt_id, PDO::PARAM_INT);
        $result->bindParam(':persid', $pers_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $commList = array();
        $rst = $result->fetch();
            $commList['name'] = $rst['namepe'];
            $commList['posid'] = $rst['posid'];
            $commList['persid'] = $rst['pers_id'];
            $commList['pos_name'] = $rst['pos_name'];
            $commList['role_spekt'] = $rst['role_spekt'];
        return $commList;
    }


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

    public static function getGallery($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/gallerys/';

        // Путь к изображению товара

        $pths = array();

        //$pathToProductImage = $path . $id . '_' . 0 . '.jpg';

        $i = 0;
        while($i<=20){
            $pathToProductImage = $path .'spekt'. $id . '_' . $i . '.jpg';
            if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)){
            $pths[$i] = $pathToProductImage;
            $i++;}
            else
                break;
        }

        $PATHS = array();

        return $pths;

        // Возвращаем путь изображения-пустышки
        //return $path . $noImage;
    }

}
