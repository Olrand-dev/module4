<?php

namespace Controller;

use Model\UserModel;

class UserController extends BaseController
{
    protected $name = 'User';

    public function login() {
        $this->render('login');
    }

    public function reg() {
        $this->render('reg');
    }

    public function regc() {

        $model = new UserModel();

        echo $_POST['login'];
    }
}