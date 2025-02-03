<?php

namespace App\Config;

class Config{

    public static function capitalizarTexto(string $texto): string // : string sirve para especificar lo que se va a retornar
    {
         // Convertimos todo el texto a minúsculas con soporte para caracteres UTF-8
         $texto = mb_strtolower($texto, 'UTF-8');
        
         // Capitalizamos la primera letra, conservando el resto del texto en minúsculas
         $primeraLetra = mb_substr($texto, 0, 1, 'UTF-8');
         $restoTexto = mb_substr($texto, 1, null, 'UTF-8');
 
         // Retornamos el texto capitalizado
         return mb_strtoupper($primeraLetra, 'UTF-8') . $restoTexto;
    }

    public static function quitarTildes(string $texto): string
    {
        // Reemplazamos los caracteres con tildes por su versión sin tilde
        $trans = array(
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ä' => 'a', 'ë' => 'e', 'ï' => 'i', 'ö' => 'o', 'ü' => 'u',
            'Ä' => 'A', 'Ë' => 'E', 'Ï' => 'I', 'Ö' => 'O', 'Ü' => 'U'
        );
        return strtr($texto, $trans);
    }
    
}


?>