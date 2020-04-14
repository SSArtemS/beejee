<?php
include(ROOT . '/views/header.php');
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal" id="form">
                    <span class="heading">АВТОРИЗАЦИЯ</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputLogin" placeholder="Login">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group text-danger">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-auth btn-primary">ВХОД</button>
                    </div>
                    <div>
                        <a href="/" class="btn btn-back btn-primary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?
include(ROOT . '/views/footer.php');
?>