<?php

$model = new \Model\UserModel();
$users_top5 = $model->top5();

$news_model = new \Model\NewsModel();

$latest_news = $news_model->latestNews(6);

?>

<div class="row">

    <div class="col-md-12">

        <div class="slider-container">
            <div class="carousel">

                <?php foreach ($latest_news as $item) { ?>

                    <div class="slide_item">
                        <h4><?php echo $item['title']?></h4>
                        <img class="slide-img" src="<?php echo $item['image']?>" alt="slide_img">
                        <p><?php echo $item['text']?></p>
                        <a href="news/show/<?php echo $item['id']?>">Читать...</a>
                    </div>

                <?php } ?>

            </div>

            <div class="next-button anim-25"><i class="fa fa-angle-right"></i></div>
            <div class="prev-button anim-25"><i class="fa fa-angle-left"></i></div>
        </div>

    </div>

    <h1>Категории новостей:</h1>

    <?php foreach ($data['categories'] as $cat) { ?>

        <div class="col-md-6">

            <div class="thumbnail">

                <h3><a href="category/show/<?php echo $cat['id'] ?>"><?php echo $cat['name']?></a></h3>

                <div class="caption">

                    <ul>
                        <?php foreach ($cat['news'] as $article) { ?>

                            <li><a href="news/show/<?php echo $article['id'] ?>"><?php echo $article['title'] ?></a></li>

                        <?php } ?>

                        <?php if ($cat['name'] == 'Аналитика') { ?>
                            <?php foreach ($cat['analytics'] as $article) { ?>

                                <li><a href="news/show/<?php echo $article['id'] ?>"><?php echo $article['title'] ?></a></li>

                            <?php } ?>
                        <?php } ?>
                    </ul>

                </div>

            </div>

        </div>

    <?php } ?>

    <div class="col-md-12">
        <h4>Топ-5 комментаторов: </h4>
        <ul>
            <?php foreach ($users_top5 as $user) { ?>
                <li><a href="comments/user/<?php echo $user['id'] ?>"><?php echo $user['login'] ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>

