<?php

namespace Model;


class MessageModel extends BaseModel
{
    protected $table = 'messages';

    protected $validations = array(
        'name' => array(
            'min' => 2,
            'max' => 10
        ),
        'message' => array(
            'min' => 5,
            'max' => 50
        ),
        'email' => array(
            'pattern' => '/^[a-zA-Z0-9\-\_\.]*@[a-zA-Z0-9\-\_\.]*[a-zA-Z]{2,5}$/i'
        )

    );
    public function save($data) {

        $data['name'] = $this->db->escape($data['name']);
        $data['email'] = $this->db->escape($data['email']);
        $data['message'] = $this->db->escape($data['message']);

        $query = " INSERT INTO messages
                    set `name` = '{$data['name']}',
                        email = '{$data['email']}',
                        message = '{$data['message']}'
        ";

        return $this->db->execute($query);
    }
}