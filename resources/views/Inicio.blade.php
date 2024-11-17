<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Rincón Guatemalteco</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('https://example.com/tu-imagen-de-fondo.jpg'); /* Cambia esta URL por la de tu imagen */
            background-size: cover; /* Para cubrir toda la pantalla */
            background-position: center; /* Centrar la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
            height: 100vh; /* Altura completa de la ventana */
        }
        .navbar {
            margin-bottom: 20px;
        }
        .bg-verde {
            background-color: #28a745; /* Color verde */
        }
        .contenido {
            background-color: white; /* Fondo blanco para el contenido */
            border: 2px solid #ddd; /* Marco ligero */
            border-radius: 10px; /* Bordes redondeados */
            padding: 30px; /* Espaciado interno */
            max-width: 800px; /* Ancho máximo para el marco */
            margin: auto; /* Centrar el marco */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra alrededor del marco */
            margin-top: 20px; /* Espacio desde la parte superior */
        }
        .grafico {
            width: 100%; /* Ancho del gráfico */
            height: 400px; /* Altura del gráfico */
        }
        .empleado {
            background-color: #f8f9fa; /* Fondo claro para el empleado */
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center; /* Centrar el texto */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Sombra alrededor del marco */
            margin-bottom: 20px; /* Espacio inferior */
        }
        .empleado img {
            width: 50%; /* Ancho ajustado para la imagen */
            max-width: 200px; /* Ancho máximo para la imagen */
            border-radius: 10px; /* Bordes redondeados para la imagen */
            margin-bottom: 10px; /* Espacio debajo de la imagen */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-verde">
    <a class="navbar-brand" href="{{ route('welcome') }}">Casa del Rincón Guatemalteco</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Inicio') }}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('despacho') }}">Despacho</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('catalogos') }}">Catalogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('gestiones') }}">Gestiones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('productos') }}">Productos</a>
            </li>
            
        </ul>
    </div>
</nav>

<div class="container">
    <!-- Sección de empleado -->
    <div class="contenido empleado">
        <img src="https://png.pngtree.com/png-vector/20221203/ourmid/pngtree-cartoon-style-male-user-profile-icon-vector-illustraton-png-image_6489287.png" alt="Empleado del Mes"> <!-- Cambia la URL por la imagen del empleado -->
        <h4>Nombre del Empleado</h4>
        <p>Código de Empleado: 12345</p>
        <h5>¡Felicidades al Empleado del Mes!</h5>
    </div>

    <!-- Sección para gráficos -->
    <div class="contenido">
        <h3>Gráfico de Ventas</h3>
        <canvas id="graficoVentas" class="grafico"></canvas>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Datos del gráfico
    const ctx = document.getElementById('graficoVentas').getContext('2d');
    const graficoVentas = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Ventas',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(40, 167, 69, 0.6)', // Color verde claro
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>