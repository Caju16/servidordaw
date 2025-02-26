<?php 

require '../vendor/autoload.php';
require_once "../bootstrap.php";


use App\Controllers\AnimalesController;

$q = $_GET['q'];

$animales = new AnimalesController();

$animales->getMascota($q);


?>