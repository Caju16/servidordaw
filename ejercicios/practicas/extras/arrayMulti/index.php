<?php

$paises = array(
    "Africa" => array(
        array(
            "country" => "Nigeria",
            "capital" => "Abuja",
            "flag" => "🇳🇬"
        ),
        array(
            "country" => "South Africa",
            "capital" => "Pretoria",
            "flag" => "🇿🇦"
        )
    ),
    "Asia" => array(
        array(
            "country" => "China",
            "capital" => "Beijing",
            "flag" => "🇨🇳"
        ),
        array(
            "country" => "Japan",
            "capital" => "Tokyo",
            "flag" => "🇯🇵"
        )
    ),
    "Europe" => array(
        array(
            "country" => "Germany",
            "capital" => "Berlin",
            "flag" => "🇩🇪"
        ),
        array(
            "country" => "France",
            "capital" => "Paris",
            "flag" => "🇫🇷"
        )
    ),
    "North America" => array(
        array(
            "country" => "United States",
            "capital" => "Washington, D.C.",
            "flag" => "🇺🇸"
        ),
        array(
            "country" => "Canada",
            "capital" => "Ottawa",
            "flag" => "🇨🇦"
        )
    ),
    "South America" => array(
        array(
            "country" => "Brazil",
            "capital" => "Brasilia",
            "flag" => "🇧🇷"
        ),
        array(
            "country" => "Argentina",
            "capital" => "Buenos Aires",
            "flag" => "🇦🇷"
        )
    ),
    "Australia" => array(
        array(
            "country" => "Australia",
            "capital" => "Canberra",
            "flag" => "🇦🇺"
        ),
        array(
            "country" => "New Zealand",
            "capital" => "Wellington",
            "flag" => "🇳🇿"
        )
    )
);

foreach($paises as $indice => $valor){
    foreach($valor as $indice2 => $valor2){
        // foreach($valor2 as $indice3 => $valor3){
        //     if($indice3 == "capital"){
        //         echo $valor3 . "<br/>";
        //     }
        // }

        var_dump($valor2);

        // echo $valor2['capital'];
    }
}

?>