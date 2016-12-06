<?php
/*echo '<pre>';
print_r($data['news_data']);
echo '</pre>';*/

$data = $data['news_data'];

$p = explode(DS, SITE_DIR);
$p = $p[count($p) - 1];

$message = null;

if (@ $_COOKIE['msg']) {
    $message = $_COOKIE['msg'];
}

if (isset($_POST['action']) && $_POST['action'] == 'add-comment') {

    $model = new \Model\CommentsModel();

    if ($model->addComment($_POST['comment-msg'], $data)) {

        if ($data['category_name'] == 'Политика') {
            setcookie('msg', 'Ваш комментарий будет добавлен после проверки модератором.', time() + 3);
        } else {
            setcookie('msg', 'Ваш комментарий добавлен.', time() + 3);
        }

        header('Location: /'.$p.'/news/show/' . $data['id']);
        exit;

    } else {
        $message = 'Ошибка при добавлении комментария.';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'comm-rate') {

    $model = new \Model\CommentsModel();

    $id = $_POST['comm-id'];
    $rating = $_POST['comm-rating'];

    $mode = '+';
    if (isset($_POST['rate-'])) {
        $mode = '-';
    }

    $model->rateComm($id, $rating, $mode);

    setcookie('r', true, time() + (60*30));

    header('Location: /'.$p.'/news/show/' . $data['id']);
    exit;
}
?>

<div class="row">

    <div class="col-md-12">
        <div class="col-md-12">
            <h2><?php echo $data['title'] ?></h2>
        </div>

        <div class="col-md-12">
            <i><?php echo $data['date'] ?></i>
            <span> | Автор: </span>
            <i><?php echo $data['author'] ?></i>
            <span> | Категория: </span>
            <a href="category/show/<?php echo $data['category'] ?>"><?php echo $data['category_name'] ?></a>

            <?php if ($data['analytics']) { ?>
                <span> , </span>
                <a href="category/show/7">Аналитика</a>
            <?php } ?>
        </div>

        <div class="news-img col-md-12">
            <img src="<?php echo $data['image'] ?>" alt="">
        </div>

        <div class="news-text col-md-12">
            <?php echo $data['text'] ?>

            <?php if ($data['analytics'] && !$_SESSION['isLogged']) { ?>
                <p>Читать полный текст новостей категории "Аналитика"
                    могут только <a href="user/login">авторизованные</a> пользователи.</p>
            <?php } ?>
        </div>

        <div class="col-md-12">
            <span>Читают: </span>
            <i>0</i>
            <span> | Просмотров: </span>
            <i><?php echo $data['hits'] ?></i>
        </div>
        <div class="col-md-12">
            <span>Теги: </span>
            <?php for ($i = 0; $i < count($data['tags_names']); $i++) { ?>
                <a href="tags/show/<?php echo $data['tags'][$i] ?>"><?php echo $data['tags_names'][$i] ?></a>
                <?php if ($i < count($data['tags_names']) - 1) { ?><span>, </span><?php } ?>
            <?php } ?>
        </div>

        <div class="col-md-12">

            <div class="col-md-12">
                <h4>Комментарии: </h4>
            </div>

            <?php if ($_SESSION['isLogged']) { ?>
                <div class="comm-form col-md-12">

                    <form method="post">

                        <textarea name="comment-msg" cols="60" rows="8" placeholder="Введите ваш комментарий..."></textarea><br><br>

                        <input type="hidden" name="action" value="add-comment">
                        <input type="submit" value="Cохранить">

                    </form>

                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    Писать комментарии могут только <a href="user/login">авторизованные</a> пользователи.
                </div>
            <?php } ?>

            <?php if ($message) { ?>
                <div class="col-md-12">
                    <?php echo $message ?>
                </div>
            <?php } ?>

            <br><br>

            <?php if ($data['comments']) { ?>

                <?php foreach ($data['comments'] as $comment) { ?>

                    <?php if ($comment['show']) { ?>

                        <div class="comm-block col-md-12">
                            <div class="col-md-2">
                                <div class="col-md-12">
                                    <img class="user-avatar" src="<?php echo $comment['author_avatar'] ?>" alt="">
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <a href="comments/user/<?php echo $comment['author_id'] ?>">
                                            <?php echo $comment['author_login'] ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="comm-text col-md-12">
                                    <p><?php echo $comment['text'] ?></p>
                                </div>
                                <div class="col-md-12">
                                    <?php echo $comment['date'] ?>
                                    <span> | Рейтинг: </span>

                                        <form method="post">
                                            <?php echo $comment['rating'] ?>

                                            <?php if (!isset($_COOKIE['r'])) { ?>
                                            <input type="submit" name="rate+" value="+">
                                            <input type="submit" name="rate-" value="-">
                                            <input type="hidden" name="action" value="comm-rate">
                                            <input type="hidden" name="comm-id" value="<?php echo $comment['id'] ?>">
                                            <input type="hidden" name="comm-rating" value="<?php echo $comment['rating'] ?>">
                                            <?php } ?>
                                        </form>

                                </div>
                            </div>
                        </div>

                    <?php } ?>

                <?php } ?>
            <?php } ?>

        </div>
    </div>

</div>
