<?php

namespace Controller;

use Model\CategoryModel;

class CategoryController extends BaseController
{
    protected $name = 'Category';

    public function catlist() {

        $model = new CategoryModel();

        $this->data['categories'] = $model->getCatList();

        $this->render('categories');
    }

    public function show($id) {

        $model = new CategoryModel();

        $this->data['news'] = $model->showCat($id);
        $this->data['cat_name'] = $model->getCatName($id);

        $this->render('category');
    }
    
}