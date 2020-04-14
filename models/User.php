<?php

class User
{

    public static function checkUserAuth($login, $password)
    {

        $db = Db::getConnection();
        $result = $db->prepare("SELECT id FROM testTask.Users WHERE login = :login AND password = :password");
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $pass = $result->fetchColumn();

        return $pass;
    }

    public static function authUser($id)
    {
        session_start();
        $_SESSION['user'] = $id;
    }

    public static function checkLogged()
    {
        session_start();
        if (isset($_SESSION['user']))
            return true;
        return false;
    }

    public static function logout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }
}