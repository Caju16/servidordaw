<?php

/**
 * 
 * Creación del array de exámenes
 * 
 * @Author: Miguel Carmona
 * @Date: 19/11/2024
 * 
 * @param mixed
 */


 $aExamen = array(
                array(    
                    "idExamen" => 0,
                    "aNombre" => "Examen A",
                    "Respuestas" => array(
                        array("a","c"),
                        array("a","b"),
                        array("a","c"),
                        array("b","d"),
                        array("Falso")
                        
                    ),
                    "Preguntas" => array(
                        array(
                            "idPregunta" => 1,
                            "Tipo" => 0,
                            "Pregunta" => "¿Cuáles de los siguientes países están en América del Sur?",
                            "Respuestas" => array("a) Brasil", "b) México", "c) Argentina", "d) España")
                        ),

                        array(
                            "idPregunta" => 2,
                            "Tipo" => 0,
                            "Pregunta" => "¿Qué océanos rodean al continente africano?",
                            "Respuestas" => array("a) Atlántico", "b) Índico", "c) Pacífico", "d) Ártico")
                        ),
                        
                        array(
                            "idPregunta" => 3,
                            "Tipo" => 0,
                            "Pregunta" => "¿Cuáles de las siguientes son montañas o sistemas montañosos?",
                            "Respuestas" => array("a) Himalaya", "b) Amazonas", "c) Andes", "d) Río Nilo")
                        ),

                        array(
                            "idPregunta" => 4,
                            "Tipo" => 0,
                            "Pregunta" => "¿Qué continentes cruzan la línea del Ecuador?",
                            "Respuestas" => array("a) América del Norte", "b) África", "c) Asia", "d) Oceanía")
                        ),

                        array(
                            "idPregunta" => 5,
                            "Tipo" => 1,
                            "Pregunta" => "El río Amazonas es el más largo del mundo",
                            "Respuestas" => array("Falso", "Verdadero")
                        ),
                    )),
                array(    
                    "idExamen" => 1,
                    "aNombre" => "Examen B",
                    "Respuestas" => array(
                        array("Falso"),
                        array("Verdadero"),
                        array("Verdadero"),
                        array("Tokio"),
                        array("País Vasco", "Euskadi")
                        
                    ),
                    "Preguntas" => array(
                        array(
                            "idPregunta" => 1,
                            "Tipo" => 1,
                            "Pregunta" => "El desierto del Sahara es el más grande del mundo",
                            "Respuestas" => array("Verdadero", "Falso")
                        ),

                        array(
                            "idPregunta" => 2,
                            "Tipo" => 1,
                            "Pregunta" => "Australia es tanto nu país como un continente",
                            "Respuestas" => array("Verdadero", "Falso")
                        ),
                        
                        array(
                            "idPregunta" => 3,
                            "Tipo" => 1,
                            "Pregunta" => "EL Monte Everest es la montaña más alta del mundo",
                            "Respuestas" => array("Verdadero", "Falso")
                        ),

                        array(
                            "idPregunta" => 4,
                            "Tipo" => 2,
                            "Pregunta" => "¿Cuál es la capital de Tokio?"
                        ),

                        array(
                            "idPregunta" => 5,
                            "Tipo" => 2,
                            "Pregunta" => "¿Cuál es la comunidad autónoma de España que tiene como lengua cooficial el euskera"
                        ),
                    ))
                );
?>