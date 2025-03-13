<?php

// namespace App\Controllers;

// class BaseController{
//     public function renderHTML($fileName, $data=[]){
//         include($fileName);
//     }
// }

    namespace App\Controllers;
    use Laminas\Diactoros\Response\HTMLResponse;
    
    class BaseController {

        protected $templateEngine;

        public function __construct() {
            $loader = new \Twig\Loader\FilesystemLoader("../views");
            
            $this->templateEngine = new \Twig\Environment($loader, [
                "debug" => true,
                "cache" => false
            ]);
        }        
        public function renderHTML($flieName, $data = []){
            return new HTMLResponse($this->templateEngine->render($flieName, $data));
        }

    }
?>
