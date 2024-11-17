<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/b/b6/Antigua_-_Arco.jpg'); /* Cambia esta URL por la de tu imagen */
            background-size: cover; /* Para cubrir toda la pantalla */
            background-position: center; /* Centrar la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
            height: 100vh; /* Altura completa de la ventana */
        }
        .contenido {
            background-color: white; /* Fondo blanco para el contenido */
            border: 2px solid #ddd; /* Marco ligero */
            border-radius: 10px; /* Bordes redondeados */
            padding: 30px; /* Espaciado interno */
            max-width: 600px; /* Ancho máximo para el marco */
            margin: auto; /* Centrar el marco */
            text-align: center; /* Centrar el texto */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra alrededor del marco */
            margin-top: 100px; /* Espacio desde la parte superior */
        }
        button {
            margin: 10px; /* Espacio entre botones */
        }

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}


.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px;
}


.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; 
  border: 1px solid #888;
  width: 80%; 
}


.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}


@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<center>
<div class="contenido">
    <h1>Bienvenido a la Casa del Rincón Guatemalteco</h1>
    <h2>Ingresemos a una innovación de compra</h2>

    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Iniciar sesión</button>
    <button onclick="document.getElementById('id02').style.display='block'" style="width:auto; background-color:darksalmon">Crear usuario</button>
</div>
</center>
<div id="id01" class="modal">
    <form class="modal-content animate" onsubmit="return handleLogin(event)" method="post">
        <div class="imgcontainer">
            <span onclick="closeModal('id01')" class="close" title="Close Modal">&times;</span>
            <h2>Iniciar Sesión</h2>
        </div>

        <div class="container">
            <div class="input-group">
                <label for="uname"><b>Usuario</b></label>
                <input type="text" placeholder="Ingrese su usuario" name="uname" required>
            </div>
            <div class="input-group">
                <label for="psw"><b>Contraseña</b></label>
                <input type="password" placeholder="Ingrese su contraseña" name="psw" required>
            </div>
        </div>

        <div class="container" style="text-align: center;">
            <button type="submit">Ingresar</button>
            <button type="button" onclick="closeModal('id01')" class="cancelbtn">Cancelar</button>
        </div>
    </form>
</div>

<script>
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function handleLogin(event) {
    event.preventDefault(); // Evita el envío del formulario

    // Muestra un alert de éxito (opcional)
    alert('Inicio de sesión exitoso.');

    // Redirecciona a otra página (cambia 'pagina_deseada.html' por la URL real)
    window.location.href = "{{ route('Inicio') }}";

    return false; // Previene el envío del formulario
}
</script>

<div id="id02" class="modal">
    <form class="modal-content animate" onsubmit="return handleSubmit(event)" method="post">
        <div class="imgcontainer">
            <span onclick="closeModal()" class="close" title="Close Modal">&times;</span>
            <h2>Crear Usuario</h2>
        </div>

        <div class="container">
            <div class="input-group">
                <label for="new_username"><b>Nombre de Usuario</b></label>
                <input type="text" placeholder="Ingrese su nombre de usuario" name="new_username" required>
            </div>
            <div class="input-group">
                <label for="dob"><b>Fecha de Nacimiento</b></label>
                <input type="date" name="dob" required>
            </div>
            <div class="input-group">
                <label for="email"><b>Correo Electrónico</b></label>
                <input type="email" placeholder="Ingrese su correo electrónico" name="email" required>
            </div>
            <div class="input-group">
                <label for="new_psw"><b>Contraseña</b></label>
                <input type="password" placeholder="Ingrese su contraseña" name="new_psw" required>
            </div>
        </div>

        <div class="container" style="text-align: center;">
            <button type="submit">Crear Usuario</button>
            <button type="button" onclick="closeModal()" class="cancelbtn">Cancelar</button>
        </div>
    </form>
</div>

<style>
.input-group {
    display: flex;
    align-items: center;
    margin: 10px 0; /* Espacio entre campos */
}

.input-group label {
    flex: 1; /* Toma el 1/3 del espacio disponible */
    margin-right: 10px; /* Espacio a la derecha del label */
}

.input-group input {
    flex: 2; /* Toma el 2/3 del espacio disponible */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>

<script>
function closeModal() {
    document.getElementById('id02').style.display='none';
}

function closeModal() {
    document.getElementById('id01').style.display='none';
}

function handleSubmit(event) {
    event.preventDefault(); // Evita el envío del formulario

    // Muestra un alert de éxito
    alert('Usuario creado con éxito.');

    // Redirecciona a otra página (cambia 'pagina_deseada.html' por la URL real)
    window.location.href = "{{ route('welcome') }}";

    return false; // Previene el envío del formulario
}
</script>

<script>

var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var modal = document.getElementById('id02');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>

</body>
</html>