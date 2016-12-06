<?php

if (count($data['news']) > PAGE_SHOW_LIMIT) {

    $model = new \Model\BaseModel();
    $items = $data['news'];
    $items_num = count($data['news']);

    $page = 1;

    if (isset($_POST['action']) && $_POST['action'] == 'show-page') {
        $keys = array_keys($_POST);

        $page = $_POST[$keys[0]];
    }

    $items_to_show = $model->paginate($items, $page);

    $pages_num = ceil($items_num / PAGE_SHOW_LIMIT);

} else {
    $items_to_show = $data['news'];
}

?>

<div class="row">

    <div class="col-md-12">

        <div class="col-md-12">
            <h2><?php echo $data['cat_name'] ?></h2>
        </div>

        <div class="col-md-12">
            <?php foreach ($items_to_show as $item) { ?>

                <div class="col-md-12">
                    <a href="news/show/<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a>
                </div>

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

    </div>

</div>