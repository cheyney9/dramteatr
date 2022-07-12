<?php

class User
{
    public static function register($name, $lastname, $surname, $email, $password, $phone)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO users (firstname, lastname, surname, email, phone_number, password) '
                . 'VALUES (:name, :lastname, :surname, :email, :phone, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    // public static function getUserListAdmin()
    // {
    //     // Соединение с БД
    //     $db = Db::getConnection();

    //     // Запрос к БД
    //     $result = $db->query('SELECT id, name, email FROM user');

    //     // Получение и возврат результатов
    //     $userList = array();
    //     $i = 0;
    //     while ($row = $result->fetch()) {
    //         $userList[$i]['id'] = $row['id'];
    //         $userList[$i]['name'] = $row['name'];
    //         $userList[$i]['email'] = $row['email'];
    //         $i++;
    //     }
    //     return $userList;
    // }

    public static function edit($id, $name, $lastname, $surname, $email, $phone, $password)
    {
        $db = Db::getConnection();

        $sql = "UPDATE users 
            SET firstname = :name, lastsname = :lastname, surname = :surname, email = :email, phone_number = :phone, password = :password 
            WHERE user_id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if ($user) {
            return $user['user_id'];
        }
        return false;
    }

    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function userAuth()
    {
        if(isset($_SESSION['user']))
            return true;
        else
            return false;
    }

    public static function getName($userId)
    {
            $user = User::getUserById($userId);
            $userName = $user['firstname'];
            return $userName;
    }

    public static function getSurname($userId)
    {
            $user = User::getUserById($userId);
            $userName = $user['surname'];
            return $userName;
    }
    

    public static function getUserId()
    {
        if(isset($_SESSION['user']))
        {
            $userId = User::checkLogged();
            return $userId;
        }
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {
        // Соединение с БД        
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
        return false;
    }

    public static function getUserById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE user_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
}
?>