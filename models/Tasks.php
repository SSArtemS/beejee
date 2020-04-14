<?php

class Tasks
{
    const SHOW_BY_DEFAULT = 3;

    public static function getTaskItemById($id)
    {

        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM testTask.Tasks WHERE id =' . $id . ' ORDER by id asc');
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $item = $result->fetch();

        return $item;
    }

    public static function getTasksList($page, $sort, $order)
    {

        $count = self::SHOW_BY_DEFAULT;
        $page = intval($page);

        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $taskList = array();
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM testTask.Tasks ORDER by ' . $sort . ' ' . $order . ' LIMIT ' . $count . ' OFFSET ' . $offset);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['name'] = $row['name'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['task'] = $row['task'];
            $taskList[$i]['status'] = $row['status'];
            $taskList[$i]['edited'] = $row['edited'];

            $i++;
        }

        return $taskList;
    }

    public static function getAmoutn()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) as count FROM testTask.Tasks ');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];

    }

    public static function addTask($name, $email, $task)
    {
        $db = Db::getConnection();

        $status = FALSE;
        $edited = FALSE;

        $sql = 'INSERT INTO testTask.Tasks (name, email, task, status, edited) VALUES (:name, :email, :task, :status, :edited)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':task', $task, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_BOOL);
        $result->bindParam(':edited', $edited, PDO::PARAM_BOOL);

        return $result->execute();
    }

    public static function check($id)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE testTask.Tasks SET status = "1" WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function changeText($id, $text)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE testTask.Tasks SET task = :task, edited = "1" WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':task', $text, PDO::PARAM_STR);

        return $result->execute();
    }


    public static function getLastTaskId()
    {

        $db = Db::getConnection();
        $result = $db->query('SELECT id FROM testTask.Tasks ORDER BY id DESC LIMIT 1');
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $item = $result->fetchColumn();

        return $item;
    }

}