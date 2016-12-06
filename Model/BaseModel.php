<?php

namespace Model;


use Common\DB;

class BaseModel
{
    protected $db;
    protected $table;
    protected $validations = array();


    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAll()
    {
        $result = $this->db->query('select * from ' . $this->table);
        return $result;
    }

    public function get($id)
    {
        $id = intval($id);

        $result = $this->db->query('select * from ' . $this->table . ' where id= ' . $id );

        if(!$result) {
            return array();
        }

        return $result[0];
    }

    public function paginate($items, $page) {
        $start_item = ($page-1) * PAGE_SHOW_LIMIT;
        $end_item = $start_item + (PAGE_SHOW_LIMIT-1);

        $items_to_show = array();
        for ($i = $start_item; $i <= $end_item; $i++) {
            if (array_key_exists($i, $items)) {
                $items_to_show[] = $items[$i];
            }
        }

        return $items_to_show;
    }

    public function validate($array) {

        foreach($this->validations as $field =>$rules) {
            foreach($rules as $rule => $value ){
                switch ($rule) {
                    case 'min':
                        if(isset($array[$field]) && strlen($array[$field]) < $value) {
                            return "Field {$field} must be greater than {$value}";
                        }
                    break;

                    case 'max':
                        if(isset($array[$field]) && strlen($array[$field]) > $value) {
                            return "Field {$field} must be less than {$value}";
                        }
                    break;

                    case 'pattern':
                        if(isset($array[$field]) && !preg_match($value, $array[$field] )) {
                            return "Field {$field} doesn't match pattern";
                        }
                    break;
                }
            }

        }

        return true;

    }

    protected function getXML($url) {

        $cacheKey = SITE_DIR . DS . 'cache' . DS . md5(urlencode($url)) . '.txt';

        if(file_exists($cacheKey)) {
            $result = file_get_contents($cacheKey);
            return new \SimpleXMLElement($result);
        }

        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        file_put_contents($cacheKey, $result);

        $object = new \SimpleXMLElement($result);

        return $object;
    }

    protected function getJSON($url) {

        $cacheKey = SITE_DIR . DS . 'cache' . DS . md5(urlencode($url)) . '.txt';

        if(file_exists($cacheKey)) {
            $result = file_get_contents($cacheKey);
            return json_decode($result, true);
        }

        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        file_put_contents($cacheKey, $result);

        $object = json_decode($result, true);

        return $object;
    }

}