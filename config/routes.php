<?php
return array(
    'page=([0-9]+)' => 'site/index/$1',
    'addAjax' => 'task/addTask',
    'auth/auth' => 'user/auth',
    'auth' => 'user/index',
    'logout' => 'user/logout',
    'changeTaskText' => 'task/updateTask',
    'checked' => 'task/check',
    '' => 'site/index',
);