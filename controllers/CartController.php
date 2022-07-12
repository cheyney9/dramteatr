<?php

/**
 * Контроллер CartController
 * Корзина
 */
class CartController
{
    public function actionAddAjax()
    {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        $id_seat = $_POST['seat_id'];
        Cart::addTicket($id_seat);
        for($i = 1; $i<=10;$i++)
        {
            if(isset($_SESSION["s$i"]))
                echo $_SESSION["s$i"] . '<br>';
        }

        $_SESSION['seansid'] = $_POST['seans_id'];
        return true;
    }

    public function actionDelAjax()
    {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        $id_seat = $_POST['seat_id'];

        for($i = 1; $i<=10;$i++)
        {
            if(isset($_SESSION["s$i"]) && $id_seat == $_SESSION["s$i"])
            {
                unset($_SESSION["s$i"]);
                break;
            }
        }

        $arr= array();

        for($i = 1; $i<=10;$i++)
        {
            $arr[$i] = $_SESSION["s$i"];
        }

        $new = array_filter($arr);
        $end = array_values($new);
        

        for($i = 1;$i<=10;$i++)
        {
            $_SESSION["s$i"] = $end[$i-1];
        }

        return true;
    }
    
    public function actionClear()
    {
        for($i = 1;$i<=10;$i++)
        {
            unset($_SESSION["s$i"]);
        }
        unset($_SESSION['seansid']);
    }

    

    public function actionIndex()
    {   
        // Получием данные из корзины      
        if (!isset($_SESSION["s1"])) {
            header("Location: /");
        }
        $seatsID = Cart::getProducts();
        $seat_data = array();
        $sum = 0;
        for($i = 1; $i <= count($seatsID); $i++)
        {
            $seat_data[$i] = Hall::seatDataById($seatsID[$i]);
            $tickData[$i] = Ticket::ticketBySeatAndSeans($seatsID[$i], $_SESSION['seansid']);
            $sum += $seat_data[$i]['price'];
        }

        if(isset($_SESSION['seansid']))
            $seans_det = Seans::getSeansById($_SESSION['seansid']);
        else
            $seans_det = '';
        
        if(User::userAuth())
        {
            $user = User::getUserById($_SESSION['user']);
        }
        else{
            $user['email'] = '';
            $user['phone_number'] = '';
            $user['firstname'] = '';
        }


        // // Поля для формы
        $userName = false;
        $userPhone = false;
        $userMail = false;

        // // Статус успешного оформления заказа
        $result = false;

        // // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
             // Если пользователь не гость
             // Получаем информацию о пользователе из БД
             $userId = User::checkLogged();
             $user = User::getUserById($userId);
             $userName = $user['firstname'];
             $userPhone = $user['phone_number'];
             $userMail = $user['email'];
         } else {
             // Если гость, поля формы останутся пустыми
             $userId = '';
         }

        // // Обработка формы
        if (isset($_POST['submit'])) {
             $userName = $_POST['name'];
             $userPhone = $_POST['phone'];
             $userMail = $_POST['mail'];

             $errors = false;

              if (!User::checkName($userName)) {
                  $_SESSION['eror'] = 'Неправильное имя';
              }
              elseif (!User::checkPhone($userPhone)) {
                  $_SESSION['eror'] = 'Неправильный формат телефона';
              }
              elseif(!User::checkEmail($userMail)){
                  $_SESSION['eror'] = 'Неправильный формат адреса электронной почты';
              }
              else{
                 $fls  = array();
                 $files = array();
                 for($i = 0; $i<count($seat_data);$i++)
                 {
                    $g = $i+1;
                    $p = Cart::createPDF($seans_det['id'],$seatsID[$i+1]);
                    $fls[$i] = array("name"=>"ticket$g.pdf","file"=>chunk_split(base64_encode($p)));
                    array_push($files, $fls[$i]);
                    Ticket::broneTicket($seans_det['id'], $seatsID[$i+1]);
                 }
                 $apo = Cart::sendMultiple("amir_galeev_00@list.ru",$userMail,'Здравствуйте, '.$userName.'. Ваши билеты на спектакль "'.$seans_det['spekt_name'].'".',$files);
                 if(!User::isGuest())
                 {
                    $userid = User::checkLogged();

                    $result = Order::save($tickData, $userMail, $userPhone, $userid, $sum);
                    for($i = 1; $i<=10;$i++)
                    {
                        unset($_SESSION["s$i"]);
                    }
                 }
                 else{
                    $result = Order::save_anon($tickData, $userMail, $userPhone, $sum);
                    for($i = 1; $i<=10;$i++)
                    {
                        unset($_SESSION["s$i"]);
                    }
                 }
                 
             }
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

}
