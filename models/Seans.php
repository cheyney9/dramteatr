<?php

class Seans
{
    public static function getNearestSeans($month)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT seans.seans_id AS id, seans.date AS date, spektakls.short_descript AS short_descript, seans.time AS time, spektakls.name AS spekt_name, spektakls.spekt_id AS spektId FROM seans JOIN spektakls ON seans.spekt_id = spektakls.spekt_id HAVING DAYOFYEAR(`date`) > DAYOFYEAR(NOW()) AND MONTH(`date`) = $month ORDER BY `date` ASC";
        
        //$sql = 'SELECT id, id_spekt, date, time FROM seans';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $spektsList = array();
        while ($row = $result->fetch()) {
            $spektsList[$i]['id'] = $row['id'];
            $spektsList[$i]['date'] = Seans::dateFormat($row['date']);
            $spektsList[$i]['time'] = substr($row['time'],0,-3);
            $spektsList[$i]['spekt_name'] = $row['spekt_name'];
            $spektsList[$i]['short_descript'] = $row['short_descript'];
            $spektsList[$i]['spektId'] = $row['spektId'];
            $i++;
        }
        return $spektsList;
    }

    public static function getNearestSeansNaGlavnuyu()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT seans.seans_id AS id, seans.date AS date, spektakls.short_descript AS short_descript, seans.time AS time, spektakls.name AS spekt_name, spektakls.spekt_id AS spektId FROM seans JOIN spektakls ON seans.spekt_id = spektakls.spekt_id HAVING DAYOFYEAR(`date`) > DAYOFYEAR(NOW()) ORDER BY `date` ASC LIMIT 9";
        
        //$sql = 'SELECT id, id_spekt, date, time FROM seans';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $spektsList = array();
        while ($row = $result->fetch()) {
            $spektsList[$i]['id'] = $row['id'];
            $spektsList[$i]['date'] = Seans::dateFormat($row['date']);
            $spektsList[$i]['time'] = substr($row['time'],0,-3);
            $spektsList[$i]['spekt_name'] = $row['spekt_name'];
            $spektsList[$i]['short_descript'] = $row['short_descript'];
            $spektsList[$i]['spektId'] = $row['spektId'];
            $i++;
        }
        return $spektsList;
    }

    public static function formatMonth($month)
    {
        switch($month){
            case "01":
                return "Январь";
            case "02":
                return "Февраль";
            case "03":
                return "Март";
            case "04":
                return "Апрель";
            case "05":
                return "Май";
            case "06":
                return "Июнь";
            case "07":
                return "Июль";
            case "08":
                return "Август";
            case "09":
                return "Сентябрь";
            case "10":
                return "Октябрь";
            case "11":
                return "Ноябрь";
            case "12":
                return "Декабрь";
                case 1:
                    return "Январь";
                case 2:
                    return "Февраль";
                case 3:
                    return "Март";
                case 4:
                    return "Апрель";
                case 5:
                    return "Май";
                case 6:
                    return "Июнь";
                case 7:
                    return "Июль";
                case 8:
                    return "Август";
                case 9:
                    return "Сентябрь";
        }
    }

    public static function getNearestSeansBySpektId($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'SELECT seans_id, time, `date` FROM seans WHERE spekt_id = :id AND DAYOFYEAR(`date`) > DAYOFYEAR(NOW()) LIMIT 4';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $spektsList = array();
        while ($row = $result->fetch()) {
            $spektsList[$i]['seans_id'] = $row['seans_id'];
            $spektsList[$i]['date'] = Seans::dateFormat($row['date']);
            $spektsList[$i]['time'] = substr($row['time'],0,-3);
            $i++;
        }
        return $spektsList;
    }

    public static function dateFormat($date)
    {   
        // получаем значение даты и времени
        list($day) = explode(' ', $date);
    
        switch( $day )
        {
    
        default:
        {
            // Разделяем отображение даты на составляющие
                list($y, $m, $d)  = explode('-', $day);
    
            $month_str = array(
                    'января', 'февраля', 'марта',
                    'апреля', 'мая', 'июня',
                    'июля', 'августа', 'сентября',
                    'октября', 'ноября', 'декабря'
                );
            $month_int = array(
                    '01', '02', '03',
                    '04', '05', '06',
                    '07', '08', '09',
                    '10', '11', '12'
                );
    
                    // Замена числового обозначения месяца на словесное (склоненное в падеже)
                    $m = str_replace($month_int, $month_str, $m);
                    // Формирование окончательного результата
                    if($d[0]=='0')
                        $d[0]=' ';
            $result = $d.' '.$m;
             }
        }
        return $result;
    }



    public static function getSeansById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT seans.seans_id AS id, spektakls.length as lng, halls.hall_name as hall_name, seans.hall_id AS hall_id, seans.date AS date, seans.time AS time, spektakls.short_descript as SD, spektakls.name AS spekt_name, spektakls.spekt_id AS spektId FROM seans JOIN spektakls ON seans.spekt_id = spektakls.spekt_id JOIN halls ON seans.hall_id = halls.hall_id WHERE seans.seans_id = :id";

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        // Выполнение коменды
        $rst = array();
        $rst = $result->fetch();

        $i = 0;
        $seansbyID = array();
        $seansbyID['id'] = $rst['id'];
        $seansbyID['date'] = Seans::dateFormat($rst['date']);
        $seansbyID['time'] = substr($rst['time'],0,-3);
        $seansbyID['hall_id'] = $rst['hall_id'];
        $seansbyID['hall_name'] = $rst['hall_name'];
        $seansbyID['spekt_name'] = $rst['spekt_name'];
        $seansbyID['spektId'] = $rst['spektId'];
        $seansbyID['lng'] = $rst['lng'];
        $seansbyID['SD'] = $rst['SD'];
        return $seansbyID;
    }


    public static function getSeansList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT seans_id, spektakls.name as name, date, time, halls.hall_name as hall FROM seans JOIN spektakls ON seans.spekt_id = spektakls.spekt_id JOIN halls ON seans.hall_id = halls.hall_id  ORDER BY seans_id ASC');
        $seansList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $seansList[$i]['seans_id'] = $row['seans_id'];
            $seansList[$i]['name'] = $row['name'];
            $seansList[$i]['date'] = $row['date'];
            $seansList[$i]['time'] = $row['time'];
            $seansList[$i]['hall'] = $row['hall'];
            $i++;
        }
        return $seansList;
    }




    public static function createSeans($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO seans '
                . '(spekt_id, hall_id, date, time)'
                . 'VALUES '
                . '(:spekt_id, :hall_id, :date, :time)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':spekt_id', $options['spekt_id'], PDO::PARAM_INT);
        $result->bindParam(':hall_id', $options['hall_id'], PDO::PARAM_INT);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':time', $options['time'], PDO::PARAM_STR);
        if ($result->execute()) {
            self::addTickets($options);
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function updateSeans($id, $spekt_id, $hall_id, $date, $time)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = "UPDATE seans SET spekt_id = :spekt, hall_id = :hid, date = :dat, time = :tim WHERE seans_id = :id";
        // Текст запроса к БД


        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':spekt', $spekt_id, PDO::PARAM_INT);
        $result->bindParam(':hid', $hall_id, PDO::PARAM_INT);
        $result->bindParam(':dat', $date, PDO::PARAM_STR);
        $result->bindParam(':tim', $time, PDO::PARAM_STR);
        return $result->execute();
    }


    public static function validateSeansAdd($date, $hall_id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM seans WHERE date = :date';

        $result = $db->prepare($sql);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        //$result->bindParam(':hall_id', $hall_id, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
            
        return false;
    }

    public static function deleteSeansById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM seans WHERE seans_id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getSeatsByHall($hall_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT seat_id FROM seats WHERE hall_id = :hall_id';
        $result = $db->prepare($sql);
        $result->bindParam(':hall_id', $hall_id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $seatsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $seatsList[$i]['seat_id'] = $row['seat_id'];
            $i++;
        }
        return $seatsList;
    }

    public static function getCurrentSeansId()
    {
        $db = Db::getConnection();

        $sql = 'SELECT seans_id FROM seans ORDER BY seans_id DESC LIMIT 1';
        $result = $db->prepare($sql);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $seans = array();

        $seans['seans_id'] = $rst['seans_id'];
        return $seans['seans_id'];
    }
    
    public static function addTickets($seans_data)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $sid = self::getCurrentSeansId();

        $hid = $seans_data['hall_id'];

        $seats = self::getSeatsByHall($hid);

        for($i = 0; $i < count($seats); $i++)
        {
            $sql = 'INSERT INTO tickets '
                    . '(seans_id, seat_id, broned)'
                    . 'VALUES '
                    . '(:seans_id, :seat_id, 0)';

            
            $result = $db->prepare($sql);
            $result->bindParam(':seans_id', $sid, PDO::PARAM_INT);
            $result->bindParam(':seat_id', $seats[$i]['seat_id'], PDO::PARAM_INT);
            $result->execute();
        }
    }


        

    public static function getImage($id)
    {
        $noImage = 'no-image.jpg';

        $path = '/upload/images/products/';

        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            return $pathToProductImage;
        }

        return $path . $noImage;
    }

}