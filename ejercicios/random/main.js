

// DECLARAR VARIABLE ALUMNOS
let alumnos;

alumnos = ['Bermúdez González, Raúl', 'Borreguero Redondo, Carlos',
     'Cañas González, Álvaro', 'Carmona Cicchetti, Miguel', 'Carrasco Castellano, Alejandro', 
     'Cherif Mouaki Almabouada, Mostafa', 'Coronado Ortega, Alejandro', 'Delgado Morente, Juan Diego', 
  'Escoto, García, Marlon Jafet', 'Fernández Ariza, Ángel', 'Fernández Arrayás, Alejandro', 'Fernández Balsera, Daniel', 
  'Ferrer López,Jesús', 'Frías Rojas, Jesús', 'Galán Navas, Manuel', 'García Báez, Víctor', 'García Díaz, Lucía', 'Gonzalez Martínez, Adrián',
    'Mariño Jiménez, Enrique'];


// CON EL ARRAY YA ESTABLECIDO, AÑADIMOS INTERACTIVIDAD:

    
    function mostrarTodos() { // MÉTODO PARA EL BOTÓN DE MOSTRAR TODO
      var divAlumnos = document.getElementsByClassName('alumnos')[0]; // SELECCIONAMOS TODO LO QUE TENGA LA CLASE ALUMNOS, EMPEZANDO POR EL 0
      divAlumnos.innerHTML = alumnos.join('<hr>'); // AÑADIMOS SALTOS DE LÍNEA PARA QUE SEA LEGIBLE
  }


    function mostrarRandom() { // MÉTODO PARA RANDOMIZAR
      var divAlumnos = document.getElementsByClassName('alumnos')[0]; // VOLVEMOS A SELECCIONAR EL DIV CON CLASE ALUMNOS
      var alumnoAzar = alumnos[Math.floor(Math.random() * alumnos.length)]; // FUNCIÓN PARA RANDOMIZAR EL ALUMNO
      divAlumnos.innerHTML = alumnoAzar; // ESCRIBIR EN PANTALLA EL ALUMNO
  }


    window.onload = function() { //MÉTODO PARA CUANDO CARGA LA PÁGINA

      // SELECCIONAMOS EL DIV Y ESCRIBIMOS EN ÉL

      var mostrar = document.getElementsByClassName('alumnos')[0]; 
      mostrar.innerHTML = alumnos.join('<hr>'); 

      // SELECCIONAMOS AMBOS BOTONES

      var botonRandom = document.querySelector('button[value="azar"]'); 
      var botonRecargar = document.querySelector('button[value="recargar"]'); 

      // AÑADIMOS LOS EVENTLISTENER PARA HACER LA FUNCIÓN RESPECTIVA DE CADA BOTÓN

      botonRandom.addEventListener('click', mostrarRandom); 
      botonRecargar.addEventListener('click', mostrarTodos);
  };