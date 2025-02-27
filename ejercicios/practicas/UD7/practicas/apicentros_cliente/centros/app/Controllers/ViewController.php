<?php

namespace App\Controllers;

class ViewController extends BaseController
{
    public function indexAction()
    {
        $data = [];

        $this->renderHTML('../app/views/index_view.php', $data);
    }
}
?>