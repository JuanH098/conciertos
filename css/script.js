document.addEventListener("DOMContentLoaded", () => {
    const carritoBtn = document.getElementById("carrito-btn");
    const desplegable = document.getElementById("desplegable");
    if (carritoBtn) {
        carritoBtn.addEventListener("click", () => {
            desplegable.style.display = desplegable.style.display === "none" ? "block" : "none";
        });
    }
});

function cerrarDesplegable() {
    const desplegable = document.getElementById("desplegable");
    desplegable.style.display = "none";
}

function agregarAlCarrito(event, nombre, artista, localizacion, fechaEvento, precio, imgsource) {
    let cantidad = event.target.previousElementSibling.value;
    if (cantidad > 0) {
        const nuevoElemento = document.createElement("div");
        nuevoElemento.classList.add('divdesplegable', 'small-entry');

        nuevoElemento.innerHTML = `
        
            <div class='imgcerrar'>
            <button onclick='borrarEvento(event)'><img src='../img/x.svg' style='width: 15px; height: 15px;'></button>
            </div>
            <div class='middlediv'>
            <div>
            <img class='imgCompra' src='${imgsource}' alt='Cartel' style='width: 80px; height: 80px; object-fit: cover;'>
            </div>
                <div class='divnombre'>
                    <h2 class='evento-text nombre' style='font-size: 16px;'>${nombre}</h2>
                    <p class='evento-text artista'>${artista}</p>
                    <p class='evento-text localizacion' style='display:none;'>${localizacion}</p>
                    <p class='evento-text fechaEvento'>${fechaEvento}</p>
                    <p class='evento-text cantidad'>${cantidad} entradas</p>
                    <p class='evento-text precio'>${precio * cantidad} €</p>
                </div>
            </div>
           
        `;

        const primerHijo = desplegable.firstChild;

        desplegable.insertBefore(nuevoElemento, primerHijo);


    } else {
        alert("La cantidad debe ser mayor que 0");
    }


}
function borrarEvento(event) {

    const padre = event.target.parentElement.parentElement.parentElement;
    padre.remove();
}


function pagCompra() {
     
    //selecionar los elementos que hay en el carrito mediante sus clases
    
    const nombreEvento = document.querySelectorAll(".divnombre .nombre");
    const nombreArtista = document.querySelectorAll(".divnombre .artista");
    const fechaEvento = document.querySelectorAll(".divnombre .fechaEvento");
    const cantidad = document.querySelectorAll(".divnombre .cantidad");
    const localizacion = document.querySelectorAll(".divnombre .localizacion");
    const precioTotal = document.querySelectorAll(".divnombre .precio");
    const img = document.querySelectorAll(".imgCompra");

    console.log(localizacion);
    //creo arrays para meter esos datos dentro 

    let nombreEventoArr = []
    let nombreArtistaArr = []
    let fechaEventoArr = []
    let cantidadArr = []
    let localizacionArr = []
    let precioTotalArr = []
    let imgArr = []

    //meto los datos mediante a un for que recorre el array (tienen todos la misma longitud por el numero de entradas)

    for (let i = 0; i < nombreEvento.length; i++) {
        nombreEventoArr.push(nombreEvento[i].innerHTML);
        nombreArtistaArr.push(nombreArtista[i].innerHTML);
        fechaEventoArr.push(fechaEvento[i].innerHTML);
        cantidadArr.push(cantidad[i].innerHTML);
        localizacionArr.push(localizacion[i].innerHTML);
        precioTotalArr.push(precioTotal[i].innerHTML);
        imgArr.push(img[i].src);
    }

    //convierto esos datos a un json para poder mandarlos a otro lao

    nombreEventoArr = JSON.stringify(nombreEventoArr);
    nombreArtistaArr = JSON.stringify(nombreArtistaArr);
    fechaEventoArr = JSON.stringify(fechaEventoArr);
    cantidadArr = JSON.stringify(cantidadArr);
    localizacionArr = JSON.stringify(localizacionArr);
    precioTotalArr = JSON.stringify(precioTotalArr);
    imgArr = JSON.stringify(imgArr);

    let jsonparams = {
        'nombre': nombreEventoArr,
        'artista': nombreArtistaArr,
        'fecha': fechaEventoArr,
        'cantidad': cantidadArr,
        'localizacion': localizacionArr,
        'precio': precioTotalArr,
        'img': imgArr
    }
    

    //cosas del guiri de stackoverflow

    //Create form 
    const hidden_form = document.createElement('form');

    // Set method to post by default 
    hidden_form.method = 'post';

    // Set path 
    hidden_form.action = "../Vista/paginaCompra.php";
  

    for (const key in jsonparams) {
        if (jsonparams.hasOwnProperty(key)) {
            const hidden_input = document.createElement
                ('input');
            hidden_input.type = 'hidden';
            hidden_input.name = key;
            hidden_input.value = jsonparams[key];

            hidden_form.appendChild(hidden_input);
        }
    }

    document.body.appendChild(hidden_form);
    hidden_form.submit();


    // if (nombreEventoArr.length == 0) {
    //     console.log("Carrito vacio.");
    // } else {
    //     nombreEventoArr = JSON.stringify(nombreEventoArr);
    //     nombreArtistaArr = JSON.stringify(nombreArtistaArr);
    //     fechaEventoArr = JSON.stringify(fechaEventoArr);
    //     localizacionArr = JSON.stringify(localizacionArr);
    //     precioTotalArr = JSON.stringify(precioTotalArr);

    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function () {
    //         if (this.readyState == 4 && this.status == 200) {
    //             window.location="../Vista/paginaCompra.php";
    //         }
    //     };
    //     let urlparams=`?nombre=${nombreEventoArr}&artista=${nombreArtistaArr}&fechaEvento=${fechaEventoArr}&localizacion=${localizacionArr}&precio=${precioTotalArr}`
    //     xmlhttp.open("POST", "../Vista/paginaCompra.php" + urlparams, true);
    //     xmlhttp.send();
    // }
}




