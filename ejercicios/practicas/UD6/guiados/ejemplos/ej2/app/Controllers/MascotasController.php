<?php

namespace App\Controllers;

use App\Models\Mascotas;

class MascotasController extends BaseController{


    public function indexAction(){
        $mascotas = Mascotas::getInstancia();

        $data['mascotas'] = $mascotas->getAll();

    }

    public function addMascotas(){
        $procesaForm = false;
        $data = array();
        $data['nombre'] = $data['peso'] = $data['raza'] = '';
        $data['mensaje'] = $data['msgError'] = '';



        if(!empty($data($_POST))){
            $procesaForm = true;


            if(empty($_POST['nombre'])){
                $data['msgError'] = 'El nombre es obligatorio';
                $procesaForm = false;
            } else {
                $data['nombre'] = $_POST['nombre'];
            }


            if(empty($_POST['peso'])){
                $data['msgError'] = 'El peso es obligatorio';
                $procesaForm = false;
            } else {
                $data['peso'] = $_POST['peso'];
            }

            if(empty($_POST['raza'])){
                $data['msgError'] = 'La raza es obligatoria';
                $procesaForm = false;
            } else {
                $data['raza'] = $_POST['raza'];
            }

            if($procesaForm){
                $mascotas = Mascotas::getInstancia();
                $mascotas->setNombre($data['nombre']);
                $mascotas->setPeso($data['peso']);
                $mascotas->setRaza($data['raza']);
                $mascotas->set();
                header('Location:'.DIRBASEURL.'/');
            } else {
                $this->renderHTML('../view/add_mascotas_view.php', $data);
            }
        }
    }
}



?>