// DECLARAR VARIABLE ALUMNOS
let alumnos;
let divAlumnos = document.getElementsByClassName('alumnos')[0];
let divTodos = document.getElementsByClassName('todos')[0];
let intervalo;
let velocidad = 100;
let velocidadInicial = 100;
let decremento = 20;


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



// CON EL ARRAY YA ESTABLECIDO, AÑADIMOS INTERACTIVIDAD:

  // MÉTODO PARA EL BOTÓN DE MOSTRAR TODO

  //   function mostrarTodos() { 
  //     clearInterval(intervalo);
  //     velocidad = velocidadInicial;
  //     divTodos.innerHTML = alumnos.join('<hr>');
  // }

  // MÉTODO PARA RANDOMIZAR

    function mostrarRandom() { 
      clearInterval(intervalo);
      velocidad = velocidadInicial;
      let alumnoAzar = alumnos[Math.floor(Math.random() * alumnos.length)]; 
      divAlumnos.innerHTML = alumnoAzar;


  }

  // MÉTODO PARA LA RULETA

  function ruleta(){
    clearInterval(intervalo);

    velocidad = Math.max(20, velocidad - decremento);

    intervalo = setInterval(() => {
          let alumnoAzar = alumnos[Math.floor(Math.random() * alumnos.length)];
          divAlumnos.innerHTML = alumnoAzar;
    }, velocidad);

    if (velocidad == 20){
      alert("No se puede aumentar más");
    }
    
  }

  // DETENER RULETA

  function detener(){
    clearInterval(intervalo);
    velocidad = velocidadInicial;
  }

  //MÉTODO PARA CUANDO CARGA LA PÁGINA

  window.onload = function() { 

    divTodos.innerHTML = alumnos.join('<hr>');

  };