<?php

namespace Model;

class CommentsModel extends BaseModel
{
    protected $table = 'comments';

    public function addComment($msg, $data) {
        $comment_msg = $msg;
        $user_id = $data['user_id'];
        $news_id = $data['id'];

        if ($data['category_name'] == 'Политика') {
            $sql = 'insert into ' . $this->table . ' (`text`, author_id, news_id, `show`)' .
                ' values (?, ?, ?, ?)';
        } else {
            $sql = 'insert into ' . $this->table . ' (`text`, author_id, news_id)' .
                ' values (?, ?, ?)';
        }

        $stmt = $this->db->prepare($sql);

        if ($data['category_name'] == 'Политика') {
            $show = 0;
            $stmt->bind_param("siii", $comment_msg, $user_id, $news_id, $show);
        } else {
            $stmt->bind_param("sii", $comment_msg, $user_id, $news_id);
        }

        $result = $stmt->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function rateComm($id, $curr_rating, $mode) {
        if ($mode == '+') {
            $rating = $curr_rating + 1;
        } else {
            $rating = $curr_rating - 1;
        }

        $this->db->query('update ' . $this->table .
            ' set rating = ' . $rating .
            ' where `id` = ' . $id);
    }

    public function commByNews($id) {

        $result = $this->db->query(
            'select * from ' . $this->table .
            ' where news_id = ' . $id . ' order by `rating` desc');

        foreach ($result as &$item) {
            $item['author_login'] = $this->db->query(
                'select `login` from `users` where `id` = ' .
                $item['author_id']);
            $item['author_login'] = $item['author_login'][0]['login'];

            $item['author_avatar'] = $this->db->query(
                'select `avatar` from `users` where `id` = ' .
                $item['author_id']);
            $item['author_avatar'] = $item['author_avatar'][0]['avatar'];
        }

        return $result;
    }

    public function getUserComments($id) {

        $result = $this->db->query(
            'select `text`,`date`,rating from ' . $this->table .
            ' where author_id = ' . $id .
            ' order by `date` desc');

        return ($result) ? $result : false;
    }

}