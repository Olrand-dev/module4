<?php

namespace Model;

class AdsModel extends BaseModel
{
    protected $table = 'ads';

    public function leftBlock() {
        $ads = $this->db->query('select * from ' . $this->table);
        $result = array();

        $i = 0;
        foreach ($ads as $item) {
            if ($i % 2 == 0) {
                $result[] = $item;
            }
            $i++;
        }

        return $result;
    }

    public function rightBlock() {
        $ads = $this->db->query('select * from ' . $this->table);
        $result = array();

        $i = 0;
        foreach ($ads as $item) {
            if ($i % 2 != 0) {
                $result[] = $item;
            }
            $i++;
        }

        return $result;
    }

}