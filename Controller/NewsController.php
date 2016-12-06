<?php

namespace Controller;

use Model\NewsModel;
use Model\CommentsModel;

class NewsController extends BaseController
{
    protected $name = 'News';

    public function show($id) {

        $model = new NewsModel();
        $comm_model = new CommentsModel();

        $this->data['news_data'] = $model->showNews($id);

        if ($this->data['news_data']['analytics'] && !$_SESSION['isLogged']) {
            $text = &$this->data['news_data']['text'];
            $text = substr($text, 0, 300);
            $text .= '...';
        }

        $this->data['news_data']['comments'] = null;
        $comments = $comm_model->commByNews($id);

        if ($comments) {
            $this->data['news_data']['comments'] = $comments;
        }

        $this->render('news');
    }

}