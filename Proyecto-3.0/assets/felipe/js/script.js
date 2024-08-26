const formulario = document.querySelector(".formulario")
const boton = document.querySelector("#boton")

let campos = {
   nombre_mascota: "",
   raza: "",
   peso: "",
   estatura: "",
   telefono: "",
   correo: "",
   nombre: "",
}
const camposValidados = document.querySelectorAll(".form-control")
console.log(camposValidados);

camposValidados.forEach((input) => {
 console.log(input);
})






// boton.addEventListener("click", (e) => {
//    e.preventDefault()
//    console.log(campos);
//    if (campos.nombre_mascota && campos.nombre_mascota !== "" && campos.raza && campos.raza !== "" && campos.peso && campos.peso !== "" && campos.estatura && campos.estatura !== "" && campos.telefono && campos.telefono !== "" && campos.correo && campos.correo !== "" && campos.nombre && campos.nombre !== "") {

//       fetch('procesar_formulario.php', {
//          method: 'POST',
//          headers: {
//             'Content-Type': 'application/json',
//          },
//          body: JSON.stringify(campos),
//       })
//          .then(response => response.json())
//          .then(data => {
//             console.log(data.message);
//             // Realizar cualquier acción adicional necesaria
//          })
//          .catch(error => {
//             console.log('Error:', error); // Verificar el contenido del error
//             console.error('Error:', error); // Imprimir el error en la consola
//         });

//    }
// });

formulario.onchange = function (e) {
   if (e.target.value === "") {
      console.log(e.target.nextElementSibling);
      e.target.nextElementSibling.style.display = "unset";
   } else {
      e.target.nextElementSibling.style.display = "none";
   }

   campos = {
      ...campos,
      [e.target.name]: e.target.value
   }
}
