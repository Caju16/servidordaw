<?php

namespace App\Controllers;

use App\Models\Animales;

class AnimalesController extends BaseController{

    public function IndexAction($filter){

        $data = array();

        $animales = Animales::getInstancia();

        $data = $animales->getMascotasByFilter($filter);

        // $filter = isset($_GET['filtro']) ? $_GET['filtro'] : null;

        // if(!isset($_GET['filtro'])){
        //     $_GET['filtro'] = '';
        // }

        // $data['animales'] = $animales->getMascotasByFilter($_GET['filtro']);

        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function getMascota($filter){

        $data = array();

        $animales = Animales::getInstancia();

        $data = $animales->getMascotasByFilter($filter);

        $this->renderHTML('../app/views/list_view.php', $data);
    }

}


?>