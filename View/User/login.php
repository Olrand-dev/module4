<?php

$model = new \Model\UserModel();
$message = null;
$logout = false;

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $_SESSION["isLogged"] = '';
    $_SESSION["login"] = '';

    $logout = true;
}

if (isset($_POST["action"]) && $_POST["action"] == "login") {

    if($model->checkUserData($_POST["login"], $_POST["password"])) {

        $_SESSION["isLogged"] = true;
        $_SESSION["login"] = strtolower($_POST["login"]);

        $message = "Вы авторизованы.";

    } else {
        $message = "Неправильный логин или пароль.";
    }
}

?>

<div class="row">
    <div class="col-md-12">

        <?php if ($logout) { ?>
        <div class="exit-msg col-md-12">Вы вышли.</div>
        <?php } else { ?>

            <div class="col-md-12"><h3>Войти в аккаунт:</h3></div>

            <div class="col-md-12">
                <form method="post">

                    <label for="login">Логин:</label>
                    <input type="text" name="login" id="login"> <br>

                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password"> <br><br>

                    <?php if ($message) { ?>
                        <p><?php echo $message ?></p>
                    <?php } ?>

                    <input type="hidden" name="action" value="login">
                    <input type="submit" value="Войти">

                </form>
            </div>
        <?php } ?>

        <div class="home-link col-md-12">
            <a href="">Вернуться на главную</a>
        </div>

    </div>

</div>

