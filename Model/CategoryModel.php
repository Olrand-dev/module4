<?php

namespace Model;

class CategoryModel extends BaseModel
{
    protected $table = 'categories';

    public function getCatList(){

        $cats = $this->getAll();
        foreach ($cats as &$cat) {
            $news = array();
            $news = $this->db->query(
                'select `title`,`id`,`date` from `news` 
                where `category` = ' . $cat['id']
                . ' order by `date` desc limit ' . PAGE_SHOW_LIMIT);
            $cat['news'] = $news;

            $analytics_articles = array();
            $analytics_articles = $this->db->query(
                'select `title`,`id`,`date` from `news` 
                where `analytics` = 1 order by `date` desc limit '
                . PAGE_SHOW_LIMIT);
            $cat['analytics'] = $analytics_articles;
        }

        return $cats;
    }

    public function showCat($id) {
        $id = intval($id);
        $cat_news = array();

        if ($id == 7) {
            $cat_news = $this->db->query(
                'select `title`,`id`,`date` from `news` 
            where `analytics` = 1 order by `date` desc');
        } else {
            $cat_news = $this->db->query(
                'select `title`,`id`,`date` from `news` 
            where `category` = ' . $id . ' order by `date` desc');
        }

        return $cat_news;
    }

    public function getCatName($id) {
        $id = intval($id);
        $cat_name = array();

        $cat_name = $this->db->query(
            'select `name` from `categories` 
            where `id` = ' . $id);

       return $cat_name[0]['name'];
    }
}