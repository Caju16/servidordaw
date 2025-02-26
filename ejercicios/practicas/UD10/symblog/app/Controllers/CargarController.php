<?php

namespace App\Controllers;

use App\Models\Blog;
use App\Models\Comment;

class CargarController extends BaseController
{
    public function IndexAction()
    {
        include('../app/Config/datos.php');

        // var_dump($blogs); die();
        foreach ($blogs as $blog) {
            $blog->set();

        }

        $data['mensaje'] = 'Datos cargados correctamente';

        $this->renderHTML('../app/views/datos_view.php', $data);
    }
}

?>