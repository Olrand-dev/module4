<?php

namespace Model;

class UserModel extends BaseModel
{
    protected $table = 'users';

    public function checkUserData($login, $password) {

        $users = $this->getUsers();
        $login = strtolower($login);
        $password = md5($password);

        foreach ($users as $user) {
            if ($user['login'] == $login && $user['password'] == $password) {
                return true;
                break;
            }
        }

        return false;
    }

    protected function getUsers() {
        $users = $this->db->query(
            'select * from ' . $this->table);
        return $users;
    }

    public function newUser($login, $pass, $first_name, $last_name, $email) {

        $sql = 'insert into ' . $this->table . ' (`login`, `password`, firstname, lastname, `email`)' .
            ' values (?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssss", $login, $pass, $first_name, $last_name, $email);
        $result = $stmt->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function getUserLogin($id) {
        $login = $this->db->query(
            'select `login` from ' . $this->table .
            ' where id = ' . $id);
        $login = $login[0]['login'];

        return $login;
    }

    public function top5() {
        $users = $this->db->query('select `id` from ' . $this->table);
        $result = array();

        foreach ($users as $user) {
            $comments = $this->db->query('select `id` from comments where author_id = ' .
                $user['id']);

            if (count($comments) > 0) {
                $result[$user['id']] = count($comments);
            }
        }

        arsort($result);
        $result = array_keys($result);

        $logins = array();
        foreach ($result as $item) {
            $logins[] = $this->db->query('select `login` from ' . $this->table .
                ' where `id` = ' . $item);
        }
        $i = 0;
        foreach ($logins as &$login) {
            $login['login'] = $login[0]['login'];
            $login['id'] = $result[$i];
            $i++;
        }

        return $logins;
    }
}