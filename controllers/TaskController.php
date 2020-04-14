<?php

include(ROOT . '/models/Tasks.php');

Class TaskController
{

    public function actionAddTask()
    {
        $userName = htmlspecialchars($_POST['userName'], ENT_QUOTES);
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
        $task = htmlspecialchars($_POST['task'], ENT_QUOTES);

        if (Tasks::addTask($userName, $email, $task)) {
            echo(Tasks::getLastTaskId());
        }

        return true;
    }

    public function actionCheck()
    {
        $id = $_POST['id'];
        Tasks::check($id);
        return true;
    }

    public function actionUpdateTask()
    {
        $id = $_POST['id'];
        $newText = $_POST['text'];
        echo(Tasks::changeText($id, $newText));
        return true;
    }
}