// DECLARAR VARIABLE ALUMNOS
let alumnos;
let divAlumnos = document.getElementsByClassName('alumnos')[0];
let divTodos = document.getElementsByClassName('todos')[0];

// INSERTAR ALUMNOS EN ARRAY

alumnos = [
  'Raúl Bermúdez González', 'Carlos Borreguero Redondo', 
  'Álvaro Cañas González', 'Miguel Carmona Cicchetti', 
  'Alejandro Carrasco Castellano', 'Mostafa Cherif Mouaki Almabouada', 
  'Alejandro Coronado Ortega', 'Juan Diego Delgado Morente', 
  'Marlon Jafet Escoto García', 'Ángel Fernández Ariza', 
  'Alejandro Fernández Arrayás', 'Daniel Fernández Balsera', 
  'Jesús Ferrer López', 'Jesús Frías Rojas', 
  'Manuel Galán Navas', 'Víctor García Báez', 
  'Lucía García Díaz', 'Adrián González Martínez', 
  'Jesús López Funes', 'Enrique Mariño Jiménez',
  'Oscar Martín-Castaño Carrillo', 'José María Mayén Pérez',
  'Pablo Mérida Velasco', 'Héctor Mora Sánchez',
  'Luis Pérez Cantarero', 'Carlos Romero Romero',
  'Javier Ruiz Molero', 'Alejandro Vaquero Abad',
  'Luis Miguel Villén Moyano'
];


  //MÉTODO PARA CUANDO CARGA LA PÁGINA

  window.onload = function() { 

    // SE UTILIZA MAP PARA ENLAZAR LOS DOS DIVS,
    // EL ALEATORIO, Y EL QUE SALEN TODOS.

    divTodos.innerHTML = alumnos;

  };