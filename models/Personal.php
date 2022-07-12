<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Personal
{


    public static function getPersBySpektId($spekt_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT personal_in_spekt.pers_id as pers_id, personal_in_spekt.position_id as posid, position.name as pos_name, personal_in_spekt.role_spekt as role_spekt, personal.name as namepe FROM personal_in_spekt JOIN personal ON personal_in_spekt.pers_id = personal.pers_id JOIN position ON personal_in_spekt.position_id = position.position_id WHERE personal_in_spekt.spekt_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $spekt_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $commList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $commList[$i]['name'] = $row['namepe'];
            $commList[$i]['posid'] = $row['posid'];
            $commList[$i]['persid'] = $row['pers_id'];
            $commList[$i]['pos_name'] = $row['pos_name'];
            $commList[$i]['role_spekt'] = $row['role_spekt'];
            $i++;
        }
        return $commList;
    }


    public static function getLastPers()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM personal ORDER BY pers_id DESC LIMIT 3');
        $spektList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $spektList[$i]['persid'] = $row['pers_id'];
            $spektList[$i]['name'] = $row['name'];
            $spektList[$i]['position'] = self::positionName($row['position_id']);
            $i++;
        }
        return $spektList;
    }

    public static function positionName($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT name FROM position WHERE position_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();
        $seat = array();

        $seat['name'] = $rst['name'];
       
        return $seat['name'];
    }

    public static function getPositionList()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM position';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $pos = array();

        $i = 0;
        while ($row = $result->fetch()) {
            $pos[$i]['id'] = $row['position_id'];
            $pos[$i]['pos_name'] = $row['name'];
            $i++;
        }
       
        return $pos;
    }


    public static function getPersList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT pers_id, name, position_id FROM personal ORDER BY pers_id ASC');
        $spektList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $spektList[$i]['id'] = $row['pers_id'];
            $spektList[$i]['name'] = $row['name'];
            $spektList[$i]['position_id'] = $row['position_id'];
            $spektList[$i]['position'] = self::positionName($spektList[$i]['position_id']);
            $i++;
        }
        return $spektList;
    }

    

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deletePersById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM personal WHERE pers_id = :id';

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
    public static function updatePersById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE personal
            SET 
                name = :name, 
                position_id = :posid,
                description = :descript
            WHERE pers_id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':posid', $options['posid'], PDO::PARAM_STR);
        $result->bindParam(':descript', $options['descript'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getPersById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM personal WHERE pers_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

    public static function getPersRoles($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT pis.spekt_id as spektid, pis.position_id, pis.role_spekt as rol, sp.name as nam, pos.name as dolz FROM personal_in_spekt pis INNER JOIN spektakls sp ON pis.spekt_id = sp.spekt_id INNER JOIN position pos ON pis.position_id = pos.position_id  WHERE pers_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        $dataRoles = array();

        $i = 0;
        while ($row = $result->fetch()) {
            $dataRoles[$i]['spektid'] = $row['spektid'];
            $dataRoles[$i]['rol'] = $row['rol'];
            $dataRoles[$i]['nam'] = $row['nam'];
            $dataRoles[$i]['dolz'] = $row['dolz'];
            $i++;
        }
        return $dataRoles;

    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createPers($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO personal '
                . '(name, position_id, description)'
                . 'VALUES '
                . '(:name, :position_id, :description)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':position_id', $options['position_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['text'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImageActor($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/actors/';

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
?>