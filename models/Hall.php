<?php

class Hall
{
    public static function renderHall($id, $seans_id)
    {
        self::renderHallParter($id, $seans_id, 1);
        self::renderHallAmfi($id, $seans_id, 2);
        self::renderHallBalkon($id, $seans_id, 3);
    }


    public static function renderHallParter($id, $seans_id, $sector_id)
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(DISTINCT ryad) AS count_r FROM seats WHERE hall_id = :id AND sector_id = 1";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $rst = array();
        $rst = $result->fetch();

        $count = array();
        $count['count_r'] = $rst['count_r'];

        $rows_hall = array();

        for($i = 1; $i<=$count['count_r'];$i++)
        {
            $rows_hall[$i] = self::getCountSeatsAtRow($i, $id, $sector_id);
        }

        echo '<div class = "title_sec">Партер</div><br>';
        for($i = 1; $i<=$count['count_r']; $i++)
        {
            if($i<10)
            echo '<div class= "nomerRow">'.$i.'&#8199;</div>';
            else
            echo '<div class= "nomerRow">'.$i.'</div>';
            for($j = 1; $j <= $rows_hall[$i]; $j++)
            {
                $seatid = self::getSeatId($i, $j, $id, $sector_id);
                $seatData = self::seatDataById($seatid);
                $sered = $rows_hall[$i]/2;
                if(self::seatFree($seans_id, self::getSeatId($i, $j, $id,$sector_id)) == self::getSeatId($i, $j, $id,$sector_id))
                    echo '<div class="seat colormesto" data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .'>'.$seatData['number_in_row'].'</div>';
                else 
                    echo '<div class="seat colormesto1 free" data-sectorname = '.$seatData['sname'].' data-sectorid='.$sector_id.' data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .' data-seatid='.$seatid.' data-price='. $seatData['price'] .'>'.$seatData['number_in_row'].'</div>';
                if($j == $sered)
                    echo '&#8199;&#8199;';
            }
            echo "<br>";
        }
    }

    public static function renderHallAmfi($id, $seans_id, $sector_id)
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(DISTINCT ryad) AS count_r FROM seats WHERE hall_id = :id AND sector_id = 2";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $rst = array();
        $rst = $result->fetch();

        $count = array();
        $count['count_r'] = $rst['count_r'];

        $rows_hall = array();

        for($i = 1; $i<=$count['count_r'];$i++)
        {
            $rows_hall[$i] = self::getCountSeatsAtRow($i, $id,$sector_id);
        }

        echo '<div class = "title_sec">Амфитеатр</div><br>';
        for($i = 1; $i<=$count['count_r']; $i++)
        {
            if($i<10)
            echo '<div class= "nomerRow">'.$i.'&#8199;</div>';
            else
            echo '<div class= "nomerRow">'.$i.'</div>';
            for($j = 1; $j <= $rows_hall[$i]; $j++)
            {
                $seatid = self::getSeatId($i, $j, $id, $sector_id);
                $seatData = self::seatDataById($seatid);
                if(self::seatFree($seans_id, self::getSeatId($i, $j, $id,$sector_id)) == self::getSeatId($i, $j, $id,$sector_id))
                    echo '<div class="seat colormesto" data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .'>'.$seatData['number_in_row'].'</div>';
                else 
                    echo '<div class="seat colormesto2 free" data-sectorname = '.$seatData['sname'].' data-sectorid='.$sector_id.' data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .' data-seatid='.$seatid.' data-price='. $seatData['price'] .'>'.$seatData['number_in_row'].'</div>';
            }
            echo "<br>";
        }
    }

    public static function renderHallBalkon($id, $seans_id, $sector_id)
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(DISTINCT ryad) AS count_r FROM seats WHERE hall_id = :id AND sector_id = 3";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $rst = array();
        $rst = $result->fetch();

        $count = array();
        $count['count_r'] = $rst['count_r'];

        $rows_hall = array();

        for($i = 1; $i<=$count['count_r'];$i++)
        {
            $rows_hall[$i] = self::getCountSeatsAtRow($i, $id,$sector_id);
        }

        echo '<div class = "title_sec">Балкон</div><br>';
        for($i = 1; $i<=$count['count_r']; $i++)
        {
            if($i<10)
            echo '<div class= "nomerRow">'.$i.'&#8199;</div>';
            else
            echo '<div class= "nomerRow">'.$i.'</div>';
            for($j = 1; $j <= $rows_hall[$i]; $j++)
            {
                $seatid = self::getSeatId($i, $j, $id, $sector_id);
                $seatData = self::seatDataById($seatid);
                if(self::seatFree($seans_id, self::getSeatId($i, $j, $id,$sector_id)) == self::getSeatId($i, $j, $id,$sector_id))
                    echo '<div class="seat colormesto" data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .'>'.$seatData['number_in_row'].'</div>';
                else 
                    echo '<div class="seat colormesto3 free" data-sectorname = '.$seatData['sname'].' data-sectorid='.$sector_id.' data-row='. $seatData['ryad'] .' data-seat='. $seatData['number_in_row'] .' data-seatid='.$seatid.' data-price='. $seatData['price'] .' >'.$seatData['number_in_row'].'</div>';
            }
            echo "<br>";
        }
    }


    

    public static function getCountSeatsAtRow($ryad, $hall_id, $sector_id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(number_in_row) AS count_seats FROM seats  WHERE hall_id = :id AND ryad = :i AND sector_id = :sector_id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $hall_id, PDO::PARAM_INT);
        $result->bindParam(':i', $ryad, PDO::PARAM_INT);
        $result->bindParam(':sector_id', $sector_id, PDO::PARAM_INT);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $count = array();
        $count['count_seats'] = $rst['count_seats'];
       
        return $count['count_seats'];
    }

    public static function getSeatId($ryad, $mesto, $hall_id, $sector_id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT seat_id FROM seats WHERE ryad = :r AND number_in_row = :n AND hall_id = :halid AND sector_id = :sector_id';
        $result = $db->prepare($sql);
        $result->bindParam(':r', $ryad, PDO::PARAM_INT);
        $result->bindParam(':n', $mesto, PDO::PARAM_INT);
        $result->bindParam(':halid', $hall_id, PDO::PARAM_INT);
        $result->bindParam(':sector_id', $sector_id, PDO::PARAM_INT);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();


        $seat = array();
        $seat['seat_id'] = $rst['seat_id'];
       
        return $seat['seat_id'];
    } 

    public static function seatDataById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT ryad, number_in_row, sectors.name as sname, sectors.price as price FROM seats JOIN sectors ON seats.sector_id = sectors.sector_id WHERE seat_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $seat = array();
        $seat['ryad'] = $rst['ryad'];
        $seat['number_in_row'] = $rst['number_in_row'];
        $seat['price'] = $rst['price'];
        $seat['sname'] = $rst['sname'];
       
        return $seat;
    }

    public static function seatFree($seans_id, $id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT broned FROM tickets WHERE seans_id = :s_id AND seat_id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':s_id', $seans_id, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $rst = array();
        $rst = $result->fetch();

        $seat = array();

        if($rst)
        {
            if($rst['broned'] == 0)
            {
                $seat['broned'] = '';
            }
            else
            {
                $seat['broned'] = $id;
            }

            return $seat['broned'];
        }
    }

    public static function getHallList()
    {
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM halls');
        $hallList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $hallList[$i]['hall_id'] = $row['hall_id'];
            $hallList[$i]['hall_name'] = $row['hall_name'];
            $i++;
        }
        return $hallList;
    }
}


