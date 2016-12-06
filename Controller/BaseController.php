<?php

namespace Controller;


class BaseController
{
    protected $name = ''; //views folder name

    protected $layout = 'default';

    /* data for views */
    protected $data;

    protected $message;

    protected function render($templateName) {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS . "View" . DS . $this->name . DS . $templateName . '.php';
        //echo SITE_DIR . DS. "View" .DS . $this->name . DS. $templateName . '.php';
        $content = ob_get_clean();

        include SITE_DIR . DS . "View" . DS . "Layout" . DS . $this->layout . '.php';
        //echo SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }

    public function render404() {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS . "View" . DS .'404.php';
        $content = ob_get_clean();

        include SITE_DIR . DS . "View" . DS . "Layout" . DS . $this->layout . '.php';
    }
}