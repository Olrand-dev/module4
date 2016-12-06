<?php

$ads_model = new \Model\AdsModel();

$ads_left = $ads_model->leftBlock();
$ads_right = $ads_model->rightBlock();

?>

<!DOCTYPE html>

<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Fresh News Portal</title>
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="/m4/">
    <link rel="shortcut icon" href="favicon.png" />
    <link rel="stylesheet" href="Lib/libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
    <link rel="stylesheet" href="Lib/libs/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="Lib/libs/fancybox/jquery.fancybox.css" />
    <link rel="stylesheet" href="Lib/libs/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="Lib/libs/countdown/jquery.countdown.css" />
    <link rel="stylesheet" href="Lib/css/fonts.css" />
    <link rel="stylesheet" href="Lib/css/main.css" />
    <link rel="stylesheet" href="Lib/css/media.css" />
</head>

<body>

<header class="top-header">
    <div class="header-topline">
        <div class="container">
            <!--блок во всю ширину страницы-->
            <div class="col-md-12">
                <!--верт. секция верстки-->
                <div class="row">
                    <button class="auth-buttons hidden-sm hidden-md hidden-lg">
                        <i class="fa fa-user"></i>
                    </button>
                    <div class="top-links">
                        <?php if ($_SESSION["isLogged"]) { ?>
                            <a href="user/login?logout=1">Выйти</a>
                        <?php } else { ?>
                            <a href="user/login">Вход</a> /
                            <a href="user/reg">Регистрация</a>
                        <?php } ?>
                    </div>
                    <div class="soc-buttons">
                        <a href="#"><i class="fa fa-vk"></i></a>
                        <a href="#"><i class="fa fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <a href="#" class="logo">Site Logo</a>

                <nav id="menu" class="clearfix">
                    <ul>
                        <li><a href="">Главная</a></li>

                        <li><a href="#">Menu Item 1</a>
                            <ul>
                                <li><a href="#">Menu Item 1_2</a></li>
                                <li><a href="#">Menu Item 1_3</a></li>
                                <li><a href="#">Menu Item 1_4</a>
                                    <ul>
                                        <li><a href="#">Menu Item 1_4_2</a></li>
                                        <li><a href="#">Menu Item 1_4_3</a></li>
                                        <li><a href="#">Menu Item 1_4_4</a></li>
                                        <li><a href="#">Menu Item 1_4_5</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Menu Item 1_5</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Menu Item 2</a>
                            <ul>
                                <li><a href="#">Menu Item 2_2</a></li>
                                <li><a href="#">Menu Item 2_3</a></li>
                                <li><a href="#">Menu Item 2_4</a></li>
                                <li><a href="#">Menu Item 2_5</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Menu Item 3</a>
                            <ul>
                                <li><a href="#">Menu Item 3_2</a></li>
                                <li><a href="#">Menu Item 3_3</a></li>
                                <li><a href="#">Menu Item 3_4</a></li>
                                <li><a href="#">Menu Item 3_5</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>


<div class="container">

    <div class="col-md-2">
        <?php foreach ($ads_left as $item) { ?>
            <div class="col-md-12 side-ads">

                <h4><?php echo $item['title']?></h4>

                <div class="ads-img col-md-12">
                    <img src="<?php echo $item['image']?>" alt="">
                </div>
                <div class="col-md-12">
                    <?php echo $item['seller']?>
                </div>
                <div class="col-md-12">
                    <p><?php echo $item['text']?></p>
                </div>
                <div class="col-md-12">
                    <span>$ <?php echo $item['price']?></span>
                </div>

            </div>
        <?php } ?>
    </div>

    <div class="col-md-8">

        <?php echo $content ?>

    </div>

    <div class="col-md-2">
        <?php foreach ($ads_right as $item) { ?>
            <div class="col-md-12 side-ads">

                <h4><?php echo $item['title']?></h4>

                <div class="ads-img col-md-12">
                    <img src="<?php echo $item['image']?>" alt="">
                </div>
                <div class="col-md-12">
                    <?php echo $item['seller']?>
                </div>
                <div class="col-md-12">
                    <p><?php echo $item['text']?></p>
                </div>
                <div class="col-md-12">
                    <span>$ <?php echo $item['price']?></span>
                </div>

            </div>
        <?php } ?>
    </div>

</div>

<footer>

    <a href="#" id="go">PopUp</a>

    <div id="modal_form">
        <span id="modal_close">X</span>

        <form method="post">
            <h3>Подписаться на рассылку:</h3>

            <label for="firstname">Имя:</label>
            <input type="text" name="first-name" id="firstname"> <br>
            <label for="lastname">Фамилия:</label>
            <input type="text" name="last-name" id="lastname"> <br><br>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email"> <br><br>

            <input type="hidden" name="action" value="subscribe">
            <input type="submit" value="Подписаться">
        </form>

    </div>
    <div id="overlay"></div>

    <div class="container">
        <div class="row">
            <div class="site-footer col-md-12">
                &copy; 2016. Все права защищены.
            </div>
        </div>
    </div>
</footer>


<!--[if lt IE 9]>
<script src="Lib/libs/html5shiv/es5-shim.min.js"></script>
<script src="Lib/libs/html5shiv/html5shiv.min.js"></script>
<script src="Lib/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="Lib/libs/respond/respond.min.js"></script>
<![endif]-->
<script src="Lib/libs/jquery/jquery-1.11.1.min.js"></script>
<script src="Lib/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
<script src="Lib/libs/fancybox/jquery.fancybox.pack.js"></script>
<script src="Lib/libs/waypoints/waypoints-1.6.2.min.js"></script>
<script src="Lib/libs/scrollto/jquery.scrollTo.min.js"></script>
<script src="Lib/libs/owl-carousel/owl.carousel.min.js"></script>
<script src="Lib/libs/countdown/jquery.plugin.js"></script>
<script src="Lib/libs/countdown/jquery.countdown.min.js"></script>
<script src="Lib/libs/countdown/jquery.countdown-ru.js"></script>
<script src="Lib/libs/landing-nav/navigation.js"></script>
<script src="Lib/js/common.js"></script>

<!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
<!-- Google Analytics counter --><!-- /Google Analytics counter -->

</body>
</html>