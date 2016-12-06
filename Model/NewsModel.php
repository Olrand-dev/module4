<?php

namespace Model;

class NewsModel extends BaseModel
{
    protected $table = 'news';

    public function showNews($id) {

        $news_row = $this->get($id);

        $news_row['author'] = $this->db->query(
            'select `login` from `users` 
            where `id` = ' . $news_row['author_id']);
        $news_row['author'] = $news_row['author'][0]['login'];

        $news_row['category_name'] = $this->db->query(
            'select `name` from `categories` 
            where `id` = ' . $news_row['category']);
        $news_row['category_name'] = $news_row['category_name'][0]['name'];

        $news_row['tags'] = explode(',', $news_row['tags']);
        $news_row['tags_names'] = $news_row['tags'];
        foreach ($news_row['tags_names'] as &$tag) {
            $tag = $this->db->query(
            'select `name` from `tags`
            where `id` = ' . $tag);
            $tag = $tag[0]['name'];
        }

        if ($_SESSION['isLogged']) {

            $news_row['user_id'] = $this->db->query('select `id` from `users` 
                where `login` = "' . $_SESSION['login'] . '"');
            $news_row['user_id'] = $news_row['user_id'][0]['id'];
        }

        return $news_row;
    }

    public function latestNews($count) {
        $news = $this->db->query(
            'select `title`,`id`,`date`,`image`,`text` from ' . $this->table .
            ' order by `date` desc limit ' . $count);

        foreach ($news as &$item) {
            $item['text'] = substr($item['text'], 0, 100);
        }

        return $news;
    }
}