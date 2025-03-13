<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function indexAction()
    {
        return $this->renderHTML('../app/views/about_view.php');
    }
}
?>