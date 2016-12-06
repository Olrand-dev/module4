<?php

if (count($data['comm_data']) > PAGE_SHOW_LIMIT) {

    $model = new \Model\BaseModel();
    $items = $data['comm_data'];
    $items_num = count($data['comm_data']);

    $page = 1;

    if (isset($_POST['action']) && $_POST['action'] == 'show-page') {
        $keys = array_keys($_POST);

        $page = $_POST[$keys[0]];
    }

    $items_to_show = $model->paginate($items, $page);

    $pages_num = ceil($items_num / PAGE_SHOW_LIMIT);

} else {
    $items_to_show = $data['comm_data'];
}

?>

<div class="row">

    <div class="col-md-12">

        <div class="col-md-12">
            <h3>Комментарии пользователя: <?php echo $data['user_login'] ?></h3>
        </div>

        <div class="col-md-12">
            <?php foreach ($items_to_show as $item) { ?>

                <div class="col-md-12">
                    <p><?php echo $item['text'] ?></p>
                </div>
                <div class="col-md-12">
                    <?php echo $item['date'] ?>
                    <span> | Рейтинг: </span>
                    <?php echo $item['rating'] ?>
                </div>
                <br><br>
            <?php } ?>
        </div>

        <?php if (isset($pages_num)) { ?>
            <div class="paginate-buttons col-md-12">
                <form method="post">
                    <?php for ($i = 1; $i <= $pages_num; $i++) { ?>
                        <input type="submit" name="<?php echo $i ?>" value="<?php echo $i ?>">
                    <?php } ?>
                    <input type="hidden" name="action" value="show-page">
                </form>
            </div>
        <?php } ?>

        <div class="home-link col-md-12">
            <a href="">Вернуться на главную</a>
        </div>

    </div>

</div>