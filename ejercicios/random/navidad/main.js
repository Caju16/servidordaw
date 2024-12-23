// DECLARAR VARIABLE ALUMNOS
let alumnos;
let divAlumnos = document.getElementsByClassName('alumnos')[0];
let divTodos = document.getElementsByClassName('todos')[0];
let intervalo;
let velocidad = 100;
let velocidadInicial = 100;
let decremento = 20;
let audio = new Audio('ring.mp3');
let audio2 = new Audio('risa.mp3');
let seleccionados = []; 
let nombreSeleccionado;

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
  'Adrián González Martínez', 
  'Jesús López Funes', 'Enrique Mariño Jiménez',
  'Oscar Martín-Castaño Carrillo', 'José María Mayén Pérez',
  'Pablo Mérida Velasco', 'Héctor Mora Sánchez',
  'Luis Pérez Cantarero', 'Carlos Romero Romero',
  'Javier Ruiz Molero', 'Alejandro Vaquero Abad',
  'Luis Miguel Villén Moyano'
];



// CON EL ARRAY YA ESTABLECIDO, AÑADIMOS INTERACTIVIDAD:

  // MÉTODO PARA RANDOMIZAR MANUALMENTE

  function mostrarRandom() { 

    // DETIENE EL INTERVALO SI ESTE SE ENCUENTRA ACTIVO

    clearInterval(intervalo);
    velocidad = velocidadInicial;

    // DECLARA VARIABLE ALUMNOAZAR Y ALMACENA LO QUE GENERE
    // DE FORMA ALEATORIA EL ARRAY ALUMNOS

    let alumnoAzar = alumnos[Math.floor(Math.random() * alumnos.length)]; 
    divAlumnos.innerHTML = alumnoAzar;

    // DESACTIVA AUDIO 1
    // ACTIVA PISTA DE AUDIO 2
    
    audio.pause();
    audio2.play();

    // DECLARA VARIABLE PARA SELECCIONAR TODOS LOS ELEMENTOS
    // QUE ESTÉN DENTRO DE UN DIV

    let divTodosItems = divTodos.getElementsByTagName('div');

    // CREA UN BUCLE QUE ITERA POR LA VARIABLE PREVIAMENTE DECLARADA
    // COMPARA SI EL DIV ES EXACTAMENTE EL MISMO QUE EL QUE SE HA GENERADO
    // EN ALUMNOAZAR, TAMBIÉN SI NO ESTÁ SELECCIONADO PREVIAMENTE, SI CUMPLE
    // CON TODO ESO, LO RESALTA DE VERDE.
    // POR ÚLTIMO, SI EL DIV CONTIENE OTRO NOMBRE QUE NO HA SIDO SELECCIONADO,
    // SE QUITA LA CLASE

    for (let i = 0; i < divTodosItems.length; i++) {
        if (divTodosItems[i].innerText === alumnoAzar && !seleccionados.includes(alumnoAzar)) {
            divTodosItems[i].classList.add('seleccion'); 
        } else if (!seleccionados.includes(divTodosItems[i].innerText)) {
            divTodosItems[i].classList.remove('seleccion'); 
        }
    }

    // FUNCIÓN PARA GUARDAR AL ALUMNO DE VERDE EN CASO DE QUE NO HAYA SIDO SELECCIONADO
    // ANTES

    if (!seleccionados.includes(alumnoAzar)) {
        seleccionados.push(alumnoAzar);  
    }
}

  // MÉTODO PARA LA RULETA

  function ruleta(){

    // LIMPIA INTERVALO PARA QUE NO SE RETROALIMENTE
    // CREAMOS PISTA DE AUDIO INFINITO, SÓLO SE DETIENE
    // EN OTRO MÉTODOS

    clearInterval(intervalo);
    audio.loop = true;
    audio.play();

    // PARA QUEAUMENTE LA VELOCIDAD DE ALEATORIEDAD,
    // SE LE APLICA UN LÍMITE, UNA VELOCIDAD INICIAL
    // Y UN DECREMENTO

    velocidad = Math.max(20, velocidad - decremento);

    // BUCLE INFINITO, SELECCIONA UN ALUMNO AL AZAR 
    // Y LO INSERTA EN EL DIVALUMNOS.
    // LO IGUALA CON NOMBRESELECCIONADO PARA SABER
    // EL NOMBRE DEL OTRO ARRAY QUE HA SELECCIONADO

    intervalo = setInterval(() => {
          let alumnoAzar = alumnos[Math.floor(Math.random() * alumnos.length)];
          divAlumnos.innerHTML = alumnoAzar;
          nombreSeleccionado = alumnoAzar;

          // GENERA ESTA VARIABLE QUE IRÁ SELECCIONANDO AL ALUMNO DE VERDE
          // VISTA EN EL ANTERIOR MÉTODO PERO ESTA ES INFINITA.

          let divTodosItems = divTodos.getElementsByTagName('div');

          // BUCLE QUE RECORRE EL DIV DE TODOS LOS ALUMNOS
          // Y VA PREGUNTANDO SI ESA ITERACIÓN ES IGUAL QUE 
          // EL ALUMNOAZAR QUE HA GENERADO PREVIAMENTE Y A SU VEZ,
          // QUE EL ALUMNO NO ESTÉ SELECCIONADO, SI CUMPLE, LO MARCA
          // DE VERDE, Y SI NO, LO QUITA

          for (let i = 0; i < divTodosItems.length; i++) {
                if (divTodosItems[i].innerText === alumnoAzar && !seleccionados.includes(alumnoAzar)) {
                  divTodosItems[i].classList.add('seleccion');  
              } else if (!seleccionados.includes(divTodosItems[i].innerText)) {
                  divTodosItems[i].classList.remove('seleccion');
              }
          }
          
          // ESTABLECER LA VELOCIDAD DEL INTERVALO

    }, velocidad);

    // SI LLEGA AL LÍMITE, AVISAR

    if (velocidad == 20){
      alert("No se puede aumentar más");
    }

    // REMOVER ANIMACION QUE SE VERÁ MÁS ABAJO
    
    divAlumnos.classList.remove('animacion');
  }

  // DETENER RULETA

  function detener(){

    // PAUSA EL INTERVALO, DETIENE EL AUDIO1
    // Y REPRODUCE EL AUDIO 2

    clearInterval(intervalo);
    audio.pause(); 
    audio.currentTime = 0; 
    audio2.play();

    // IGUALAMOS LA VELOCIDAD DEL INTERVALO
    // PARA QUE NO SE ACUMULE
    
    velocidad = velocidadInicial;

    // AÑADE LA CLASE ANIMACION AL DIVALUMNOS

    divAlumnos.classList.add('animacion');

    // COMPROBACIÓN VISTA ANTERIORMENTE, SI 
    // EXISTE NOMBRESELECCIONADO Y SI NO HA SIDO
    // SELECCIONADO EL ALUMNO, LO GUARDA EN LA VARIABLE.

    if (nombreSeleccionado && !seleccionados.includes(nombreSeleccionado)) {
      seleccionados.push(nombreSeleccionado);

      // BUCLE VISTO EN VARIAS OCASIONES,
      // GENERA UNA VARIABLE PARA GUARDAR A TODOS EN UN DIV
      // E ITERA SOBRE ELLOS COMPROBANDO QUE NO HAYA SIDO SELECCIONADO
      // ANTES Y QUE SEA IGUAL A LO QUE HA SELECCIONADO EL OTRO DIV

      let divTodosItems = divTodos.getElementsByTagName('div');
      for (let i = 0; i < divTodosItems.length; i++) {
          if (divTodosItems[i].innerText === nombreSeleccionado) {
              divTodosItems[i].classList.add('seleccion');
          }
      }
  }
  }

  //MÉTODO PARA CUANDO CARGA LA PÁGINA

  window.onload = function() { 

    // SE UTILIZA MAP PARA ENLAZAR LOS DOS DIVS,
    // EL ALEATORIO, Y EL QUE SALEN TODOS.

    divTodos.innerHTML = alumnos.map(alumno => `<div>${alumno}</div>`).join('<hr>');

  };