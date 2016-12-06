<?php

$model = new \Model\UserModel();
$message = null;

if (@ isset($_COOKIE["reg-msg"])) {
    $message = $_COOKIE["reg-msg"];
}

$p = explode(DS, SITE_DIR);
$p = $p[count($p) - 1];

if (isset($_POST["action"]) && $_POST["action"] == "registration") {

    if($_POST["password"] === $_POST["passwordconfirm"]) {

        $login = $_POST["login"];
        $login = trim($login);
        $login = strtolower($login);

        $pass = md5($_POST["password"]);

        $first_name = $_POST["first-name"];
        $last_name = $_POST["last-name"];
        $email = $_POST["email"];

        if ($model->newUser($login, $pass, $first_name, $last_name, $email)) {
            setcookie("reg-msg", 'Вы успешно зарегистрировались!', time() + 3);

            header('Location: /'.$p.'/user/reg');
            exit;

        } else {
            $message = 'Ошибка';
        }

    } else {

        $message = "Пароли не совпадают.";

        setcookie("reg-msg", $message);
    }
}

?>

<div class="row">

    <div class="col-md-12">

        <div class="col-md-12">
            <h3>Регистрация:</h3>
        </div>

        <div class="col-md-12">
            <form method="post">

                <label for="login">Логин:</label>
                <input type="text" name="login" id="login"> <br>

                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password"> <br>

                <label for="password-conf">Пароль еще раз:</label>
                <input type="password" name="passwordconfirm" id="password-conf"> <br><br>

                <label for="firstname">Имя:</label>
                <input type="text" name="first-name" id="firstname"> <br>

                <label for="lastname">Фамилия:</label>
                <input type="text" name="last-name" id="lastname"> <br>

                <label for="email">Email:</label>
                <input type="text" name="email" id="email"> <br><br>

                <?php if ($message) { ?>
                    <p><?php echo $message ?></p>
                <?php } ?>

                <input type="hidden" name="action" value="registration">
                <input type="submit" value="Регистрация">

            </form>
        </div>

        <div class="home-link col-md-12">
            <a href="">Вернуться на главную</a>
        </div>

    </div>

</div>
