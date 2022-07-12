<?php

class Ticket
{
    public static function broneTicket($seans_id, $seat_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE tickets SET 
                broned = 1 
            WHERE seans_id = :id AND seat_id = :seatid";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $seans_id, PDO::PARAM_INT);
        $result->bindParam(':seatid', $seat_id, PDO::PARAM_INT);
        return $result->execute();
    }

    
    
    public static function ticketBySeatAndSeans($seat_id, $seans_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT ticket_id FROM tickets WHERE seans_id = :seans_id AND seat_id = :seat_id';
        $result = $db->prepare($sql);
        $result->bindParam(':seans_id', $seans_id, PDO::PARAM_INT);
        $result->bindParam(':seat_id', $seat_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $ticket = array();
        $seat['ticket_id'] = $rst['ticket_id'];
       
        return $seat;
    }

    public static function ticketInfo($ticket_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT broned FROM tickets WHERE ticket_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $ticket_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $ticket = array();
        $ticket['broned'] = $rst['broned'];
       
        return $ticket;
    }

    public static function broneTicketAjax($ticket_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

       
        $br;
        $condition = self::ticketInfo($ticket_id);
        if($condition['broned'] == 1)
        {
            $br = 0;
        }
        else{
            $br=1;
        }


        $sql = "UPDATE tickets SET broned = :br WHERE ticket_id = :id";
        // Текст запроса к БД
        

        $result = $db->prepare($sql);
        $result->bindParam(':id', $ticket_id, PDO::PARAM_INT);
        $result->bindParam(':br', $br, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getTicketsBySpektAdmin($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT t.ticket_id as ticketid, t.broned as bron, st.ryad as ryd, st.number_in_row as nir, sct.name as secname, sct. price as pric FROM tickets t 
        INNER JOIN seats st ON t.seat_id = st.seat_id INNER JOIN sectors sct ON sct.sector_id = st.sector_id WHERE t.seans_id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $ticket = array();
        while ($row = $result->fetch()) {
            $ticket[$i]['ticketid'] = $row['ticketid'];
            $ticket[$i]['bron'] = $row['bron'];
            $ticket[$i]['ryd'] = $row['ryd'];
            $ticket[$i]['nir'] = $row['nir'];
            $ticket[$i]['secname'] = $row['secname'];
            $ticket[$i]['pric'] = $row['pric'];
            $i++;
        }
        return $ticket;
    }
}
