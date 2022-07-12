<?php

class Order
{
    public static function save($tickets, $user_email, $user_phone, $user_id, $total)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO orders (tickets, user_email, user_phone, user_id, total_order)  VALUES (:tickets, :user_email, :user_phone, :user_id, :total)';

        $tickets = json_encode($tickets);

        $result = $db->prepare($sql);
        $result->bindParam(':tickets', $tickets, PDO::PARAM_STR);
        $result->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':total', $total, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function save_anon($tickets, $user_email, $user_phone, $total)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO orders (tickets, user_email, user_phone, total_order)  VALUES (:tickets, :user_email, :user_phone, :total)';

        $tickets = json_encode($tickets);

        $result = $db->prepare($sql);
        $result->bindParam(':tickets', $tickets, PDO::PARAM_STR);
        $result->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $result->bindParam(':total', $total, PDO::PARAM_INT);
        return $result->execute();
    }

    //////////////////////////

    /**
     * Возвращает список заказов
     * @return array <p>Список заказов</p>
     */
    public static function getOrdersList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT order_id, user_email, user_phone, date_time, total_order FROM orders ORDER BY order_id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['order_id'];
            $ordersList[$i]['email'] = $row['user_email'];
            $ordersList[$i]['phone'] = $row['user_phone'];
            $ordersList[$i]['date_time'] = $row['date_time'];
            $time = new DateTime($row['date_time']);
            $ordersList[$i]['date'] = $time->format('d.m.Y');
            $ordersList[$i]['time'] = $time->format('H:i');
            $ordersList[$i]['total'] = $row['total_order'];
            $i++;
        }
        return $ordersList;
    }


    public static function getTicketsData($tickets)
    {
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = "SELECT se.date as dat, se.time as tim, sp.name as nam, sct.price as pric, sct.name as snm, h.hall_name as hnam, st.ryad as ryd, st.number_in_row as nir FROM tickets t 
        INNER JOIN seans se 
            ON t.seans_id = se.seans_id
        INNER JOIN spektakls sp
            ON se.spekt_id = sp.spekt_id
        INNER JOIN seats st
            ON t.seat_id = st.seat_id
        INNER JOIN sectors sct
            ON st.sector_id = sct.sector_id
        INNER JOIN halls h
            ON st.hall_id = h.hall_id
        WHERE t.ticket_id = :id";        

        $result = $db->prepare($sql);
        $result->bindParam(':id', $tickets, PDO::PARAM_INT);
        $result->execute();

        $rst = $result->fetch();

        $ordersList = array();

        $ordersList['dat'] = $rst['dat'];
        $ordersList['tim'] = substr($rst['tim'],0,-3);
        $ordersList['nam'] = $rst['nam'];
        $ordersList['pric'] = $rst['pric'];
        $ordersList['hnam'] = $rst['hnam'];
        $ordersList['ryd'] = $rst['ryd'];
        $ordersList['nir'] = $rst['nir'];
        $ordersList['snm'] = $rst['snm'];
        return $ordersList;
    }
    

    public static function getHistoryUser($userId)
    {
        $db = Db::getConnection();

        // Получение и возврат результатов
        //"SELECT seans.id AS id, seans.id_hall AS hall_id, seans.date AS date, seans.time AS time, spektakl.name AS spekt_name, spektakl.id AS spektId FROM seans JOIN spektakl ON seans.id_spekt = spektakl.id WHERE seans.id = :id";
        $sql = "SELECT order_id, tickets from orders WHERE user_id = :id ORDER BY date_time DESC";        

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->execute();

        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['order_id'];
            $ordersList[$i]['tickets'] = $row['tickets'];
            $i++;
        }
        return $ordersList;
    }

    public static function getOrderDetails($id)
    {
        $db = Db::getConnection();

        // Получение и возврат результатов
        //"SELECT seans.id AS id, seans.id_hall AS hall_id, seans.date AS date, seans.time AS time, spektakl.name AS spekt_name, spektakl.id AS spektId FROM seans JOIN spektakl ON seans.id_spekt = spektakl.id WHERE seans.id = :id";
        $sql = "SELECT tickets from orders where order_id = :id";        

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['tickets'] = $row['tickets'];
            $i++;
        }
        return $ordersList;
    }

    

    /**
     * Возвращает текстое пояснение статуса для заказа :<br/>
     * <i>1 - Новый заказ, 2 - В обработке, 3 - Доставляется, 4 - Закрыт</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }

    /**
     * Возвращает заказ с указанным id 
     * @param integer $id <p>id</p>
     * @return array <p>Массив с информацией о заказе</p>
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM orders WHERE order_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Удаляет заказ с заданным id
     * @param integer $id <p>id заказа</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM orders WHERE order_id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getProductsUserDetails($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
