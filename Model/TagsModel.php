<?php

namespace Model;

class TagsModel extends BaseModel
{
    protected $table = 'news';

    public function newsByTag($id) {
        $id = intval($id);
        $news = array();

        $news = $this->db->query(
            'select `title`,`id`,`tags`,`date` from ' .
            $this->table . ' order by `date` desc');

        $tag_news = array();
        foreach ($news as $article) {
            $tags = explode(',', $article['tags']);

            foreach ($tags as $tag) {
                if ($tag == $id) {
                    $tag_news[] = $article;
                    break;
                }
            }
        }

       return $tag_news;
    }

    public function getTagName($id) {
        $id = intval($id);
        $tag_name = array();

        $tag_name = $this->db->query(
            'select `name` from `tags` 
            where `id` = ' . $id);

        return $tag_name[0]['name'];
    }
}