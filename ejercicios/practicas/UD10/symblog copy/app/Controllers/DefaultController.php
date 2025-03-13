<?php

namespace App\Controllers;
use Laminas\Diactoros\Response\HTMLResponse;

class DefaultController
{
    public function IndexAction()
    {
        $this->renderHTML('../app/views/index_view.twig');
    }
}
?>