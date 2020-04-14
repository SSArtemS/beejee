<?php
include(ROOT . '/views/header.php');
?>

    <div class="container">
        <div class="row justify-content-center">
            <a href="<?= $user ? '/logout/' : '/auth/' ?>"
               class="auth btn btn-primary"><?= $user ? 'Выход' : 'Авторизоваться' ?></a>
        </div>
        <div class="row">
            <table class="table" id='tableTasks'>
                <thead>
                <tr>
                    <th scope="col" class="sort" data-sort="name">Имя</th>
                    <th scope="col" class="sort" data-sort="email">Email</th>
                    <th scope="col">Задание</th>
                    <? if ($user): ?>
                        <th scope="col">Изменено</th>
                        <th scope="col">Выполнено</th>
                    <? endif ?>
                    <th scope="col" class="sort" data-sort="status">Статус</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($tasks as $task): ?>
                    <tr id="<?= $task['id'] ?>">
                        <td><?= $task['name'] ?></td>
                        <td><?= $task['email'] ?></td>
                        <? if ($user): ?>
                            <td><input class="textTask" type="text" value="<?= $task['task'] ?>" size="60"></td>
                            <td><?= $task['edited'] ? 'Отредактировано администратором' : '' ?></td>
                            <td><input class="checkTask" type="checkbox" <?= $task['status'] ? 'checked' : '' ?>></td>
                        <? else: ?>
                            <td><?= $task['task'] ?></td>
                        <? endif ?>
                        <td><?= $task['status'] ? 'Выполено' : 'Не выполнено' ?></td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <?= $pagination->get() ?>
        </div>
        <div class="row justify-content-center">
            <form id="form">
                <div class="row">
                    <div class="form-group col">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group col">
                        <label for="UserName">Name</label>
                        <input type="text" class="form-control" id="userName">
                    </div>
                    <div class="form-group col">
                        <label for="TaskText">Task</label>
                        <input type="text" class="form-control" id="taskText">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="alert text-danger"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="alert alert-success" style="display: none">Задание успешно сохранено</div>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="add-task btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
<?
include(ROOT . '/views/footer.php');
?>