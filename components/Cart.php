<?php

/**
 * Класс Cart
 * Компонент для работы корзиной
 */
class Cart
{

    /**
     * Добавление товара в корзину (сессию)
     * @param int $id <p>id товара</p>
     * @return integer <p>Количество товаров в корзине</p>
     */
    public static function addTicket($id)
    {
        // Приводим $id к типу integer
        $id = intval($id);

        for($i = 1; $i<=10; $i++)
        {
            $g = $i+1;
            if(isset($_SESSION["s$i"]))
            {
                continue;
            }
            else
            {
                $_SESSION["s$i"] = $id;
                break;
            }
        }
        
        return true;
        // Возвращаем количество товаров в корзине
        //return self::countItems();
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int <p>Количество товаров в корзине</p>
     */
    public static function countItems()
    {
        // Проверка наличия товаров в корзине
        if (isset($_SESSION['tickets'])) {
            // Если массив с товарами есть
            // Подсчитаем и вернем их количество
            $count = 0;
            foreach ($_SESSION['tickets'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // Если товаров нет, вернем 0
            return 0;
        }
    }

    /**
     * Возвращает массив с идентификаторами и количеством товаров в корзине<br/>
     * Если товаров нет, возвращает false;
     * @return mixed: boolean or array
     */
    public static function getProducts()
    {
        $mesta = array();
        for($i = 1; $i<=10;$i++)
        {
            if (isset($_SESSION["s$i"]))
            {
                $mesta[$i] = $_SESSION["s$i"];
            }
            else
                continue;
        }

        return $mesta;

    }

    /**
     * Получаем общую стоимость переданных товаров
     * @param array $products <p>Массив с информацией о товарах</p>
     * @return integer <p>Общая стоимость</p>
     */
    public static function getTotalPrice($products)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Подсчитываем общую стоимость
        $total = 0;
        if ($productsInCart) {
            // Если в корзине не пусто
            // Проходим по переданному в метод массиву товаров
            foreach ($products as $item) {
                // Находим общую стоимость: цена товара * количество товара
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    /**
     * Очищает корзину
     */
    public static function clear()
    {
        for($i = 1; $i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
    }


    public static function createPDF($seans_id, $seat_id)
    {
        $seans_det = Seans::getSeansById($seans_id);
        $seat_det = Hall::seatDataById($seat_id);
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Blog | E-Shopper</title>
            <style>
                body{
                    font-family: "Dejavu Serif";
                }
                .container1 {
                width: 561px;
                height: 264px;
                opacity: 1;
                align-self: center;
                align-items: center;
                border-color: #000000;
                border-style: solid;
                border-width: 2px;
                background-color: #f2e9e9;
                }
                .container2 {
                    width: 61px;
                    height: 264px;
                    opacity: 1;
                    align-self: center;
                    align-items: center;
                    border-color: #000000;
                    border-style: solid;
                    border-width: 2px;
                    flex-direction: column;
                    background-color:none;
                    margin-left: 500px;
                    border-top: none;
                    border-bottom: none;
                    border-right: none;
                    margin-top: -266px;

                }
                .text {
                display: inline-block;
                font-size: 21px;
                font-style: normal;
                margin-top: 20px;
                text-align: center;
                font-weight: 700;
                padding-top: 0px;
                margin-left:38px;
                text-transform: uppercase;
                }
                .text01 {
                display: inline-block;
                color: #8a7f48;
                font-size: 17px;
                font-style: normal;
                margin-top: 35px;
                text-align: center;
                font-weight: 700;
                margin-left: 60px;
                margin-right: 0px;
                text-transform: uppercase;
                }
                .text_ops {
                display: inline-block;
                color:rgb(138, 143, 146);
                font-style: normal;
                margin-top: 15px;
                text-align: center;
                font-weight: 700;
                margin-left: 20px;
                margin-right: 0px;
                text-transform: uppercase;
                font-size:12px;
                }
                .text02 {
                    display: inline-block;
                color: #000000;
                font-size: 17px;
                font-style: normal;
                margin-top: 20px;
                text-align: center;
                font-weight: 700;
                margin-left: 60px;
                margin-right: 0px;
                text-transform: uppercase;
                }
                .text03 {
                    display: inline-block;
                color: #000000;
                font-size: 17px;
                font-style: normal;
                margin-top: 30px;
                text-align: center;
                font-weight: 700;
                margin-left: 55px;
                margin-right: 0px;
                text-transform: uppercase;
                }
                .text04 {
                    display: inline-block;
                    color:rgb(138, 143, 146);
                font-size: 20px;
                font-style: normal;
                margin-top: 5px;
                text-align: center;
                font-weight: 700;
                margin-left: 110px;
                margin-right: 0px;
                opacity: 54%;
                }
                .text05 {
                    display: inline-block;
                    color: #ff0000;
                    font-size: 20px;
                    font-style: normal;
                    margin-top: 12px;
                    text-align: center;
                    font-weight: 700;
                    margin-left: 103px;
                    margin-right: 0px;
                    text-transform: uppercase;
                    letter-spacing:3px;
                }
                p{
                    transform:rotate(270deg);
                    font-weight: 700;
                    margin-top: -590px;
                    margin-right: -500px;
                    letter-spacing: 5px;
                    color:black;
                }
            </style>
        </head><!--/head-->
        
        <body>
                <div class="container1">
                <div class="text">Магнитогорский Театр драмы</div>
                <div class="text01">'.$seans_det['spekt_name'].'</div>
                <div class="text_ops">'.$seans_det['SD'].'</div>
                <div class="text02">'.$seans_det['date'].', в '.$seans_det['time'].'</div>
                <div class="text03">'.$seans_det['hall_name'].'</div>
                <div class="text04">'.$seat_det['sname'].', '.$seat_det['ryad'].' ряд, '.$seat_det['number_in_row'].' место</div>
                <div class="text05">Цена: '.$seat_det['price'].' рублей</div>
                <p>КОНТРОЛЬ</p>
                </div>
                <div class="container2"></div>
        </body>
        </html>';

        include_once (ROOT. '/dompdf/autoload.inc.php');
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();
        
        $id = $seans_id+$seat_id;
        // Или сохранение на сервере:
        $pdf = $dompdf->output(); 
        file_put_contents(ROOT . "/bilet$id.pdf", $pdf); 
        return $pdf;
    }

    public static function sendMultiple($from,$to,$subject,$files){
        $eol = PHP_EOL;
        $separator = md5(time());
    
       // $headers  = "From: \"".$from."\" <"p">\r\n";
        $headers = "MIME-Version: 1.0".$eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
    
        $body = "Content-Transfer-Encoding: 7bit".$eol;
        $body .= "This is a MIME encoded message.".$eol;
        $body .= "--".$separator.$eol;
        $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
        $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $body .= $eol;
        foreach ($files as $file ) {
            $body .= "--" . $separator . $eol;
            $body .= "Content-Type: application/octet-stream; name=\"" . $file['name'] . "\"" . $eol;
            $body .= "Content-Transfer-Encoding: base64" . $eol;
            $body .= "Content-Disposition: attachment" . $eol . $eol;
            $body .= $file['file'] . $eol;
            //This line is not needed, solved the issue
            //$body .= "--" . $separator . "--";
        }
        $mail = mail($to,$subject,$body,$headers);
        if($mail){
            return true;
        }
        return null;
    }
    
    //$files is an array of this

    /**
     * Удаляет товар с указанным id из корзины
     * @param integer $id <p>id товара</p>*/

}
