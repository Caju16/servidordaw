<?php

namespace App\Controllers;
use App\Models\Mascotas;

class PerrosController extends BaseController
{
    public function IndexAction()
    {
        // Creamos una instancia de mascotas
        $mascota = Mascotas::getInstancia();

        // Alamacenamos los datos en $data
        $data['mascotas'] = $mascota->getAll();

        // Llamamos a la función renderHTML
        $this->renderHTML('../app/view/index_view.php', $data);
    }

    public function AddAction()
    {
        $lprocesaFormulario = false;
        $data = array();
        $data['nombre'] = $data['raza'] = $data['peso']=  '';
        $data['msjErrorNombre'] = $data['msjErrorRaza'] = $data['msjErrorPeso']=  '';

        if(!empty($_POST)){
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['raza'] = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);
            $data['peso'] = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            // Validamos que el campo nombre no esté vacío
            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = "El nombre no puede estar vacío";
            }

            // Validamos que el campo raza no esté vacío
            if (empty($data['raza'])) {
                $lprocesaFormulario = false;
                $data['msjErrorRaza'] = "La raza no puede estar vacía";
            }

            // Validamos que el campo peso no esté vacío
            if (empty($data['peso'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPeso'] = "El peso no puede estar vacía";
            }
        }

        if ($lprocesaFormulario) {
            // Guardar la mascota en la base de datos
            $objMascota = Mascotas::getInstancia();
            $objMascota->setNombre($data['nombre']);
            $objMascota->setRaza($data['raza']);
            $objMascota->setPeso($data['peso']);
            $objMascota->set();
            header('Location: ..');
        } else {
            // Mostrar la vista de agregar mascota con los datos y errores
            $this->renderHTML('../app/view/addMascotas_view.php', $data);
        }
    }

    public function DeleteAction()
    {
        // Obtenemos el id de la mascota desde la url
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


        // Creamos la instancia de mascotas
        $mascota = Mascotas::getInstancia();

        // Verificamos que la mascota exista
        $mascota->get($id);

        // Borramos la mascota
        $data['mascotas'] = $mascota->delete($id);
        
        // Reenviamos a la lista 
        header('Location: /');
    }

    public function EditAction(){
        $lprocesaFormulario = false;


        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $mascota = Mascotas::getInstancia();

        $data['mascotas'] = $mascota->get($id);
        $data['msjErrorNombre'] = $data['msjErrorRaza'] = $data['msjErrorPeso']=  '';

        if (!empty($_POST)) {

            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['raza'] = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);
            $data['peso'] = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            // Validamos que el campo nombre no esté vacío
            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = "El nombre no puede estar vacío";
            }

            // Validamos que el campo raza no esté vacío
            if (empty($data['raza'])) {
                $lprocesaFormulario = false;
                $data['msjErrorRaza'] = "La raza no puede estar vacía";
            }

            // Validamos que el campo peso no esté vacío
            if (empty($data['peso'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPeso'] = "El peso no puede estar vacía";
            }


            
        }
        
        if ($lprocesaFormulario) {
            $mascota = Mascotas::getInstancia();
            $mascota->setNombre($_POST['nombre']);
            $mascota->setPeso($_POST['peso']);
            $mascota->setRaza($_POST['raza']);
            $mascota->edit();

            header('Location: /');
            exit;
        } else {
            // Mostrar la vista de agregar mascota con los datos y errores
            $this->renderHTML('../app/view/editMascotas_view.php', $data);
        }
        

    }
}