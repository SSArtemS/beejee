<?php

include(ROOT . '/models/Tasks.php');
include(ROOT . '/models/User.php');

Class SiteController
{

    public function actionIndex($page = 1)
    {
        if (count($_GET) > 0) {
            $sort = key($_GET);
            $order = current($_GET);
            $params = '?' . $sort . '=' . $order;
        } else {
            $sort = 'id';
            $order = 'asc';
            $params = '';
        }

        $tasks = Tasks::getTasksList($page, $sort, $order);

        $total = Tasks::getAmoutn();

        $pagination = new Pagination($total, $page, Tasks::SHOW_BY_DEFAULT, 'page=', $params);

        $user = User::checkLogged();

        $i = 1;

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

}