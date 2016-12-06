<?php

namespace Controller;

use Model\TagsModel;

class TagsController extends BaseController
{
    protected $name = 'Tags';

    public function show($id) {

        $model = new TagsModel();

        $this->data['news'] = $model->newsByTag($id);
        $this->data['tag_name'] = $model->getTagName($id);

        $this->render('tag');
    }

}