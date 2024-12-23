<?php

    /** Definir espacio de nombres */
    namespace App\Controllers;
    
    use App\Models\Mascotas;
    
    class PerrosController extends BaseController
    {
        public function renderHTML($fileName, $data=[])
        {
            include($fileName);
        }
    };



?>