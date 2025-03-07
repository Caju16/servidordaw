<?php

    namespace App\Controllers;

class PageController extends BaseController
{
    public function IndexAction()
    {
        $data = [];

        $this->renderHTML('../app/views/blogs_view.php', $data);
    }
}
?>