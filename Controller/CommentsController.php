<?php

namespace Controller;

use Model\CommentsModel;
use Model\UserModel;

class CommentsController extends BaseController
{
    protected $name = 'Comments';

    public function user($id) {

        $model = new CommentsModel();
        $u_model = new UserModel();

        $this->data['comm_data'] = $model->getUserComments($id);
        $this->data['user_login'] = $u_model->getUserLogin($id);

        $this->render('comments');
    }

}