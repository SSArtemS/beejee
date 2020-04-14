<?php

include(ROOT . '/models/User.php');

Class UserController
{

    public function actionAuth()
    {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $result = User::checkUserAuth($login, $password);

        if ($result) {
            User::authUser($result);
        }

        echo($result);

        return true;

    }

    public function actionIndex()
    {
        require_once(ROOT . '/views/user/auth.php');

        return true;
    }

    public function actionLogout()
    {
        User::logout();

        return true;
    }

}