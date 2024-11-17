<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con Estilo Verde</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .bg-verde {
            background-color: #28a745; /* Color verde */
        }
        .dashboard {
            padding: 20px;
            background-color: #f8f9fa; /* Fondo claro para el dashboard */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #17a2b8; /* Color del botón */
            color: white;
            border-radius: 30px; /* Bordes redondeados */
            padding: 10px 20px;
            margin: 10px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #138496; /* Color al pasar el mouse */
        }
        .carousel-item img {
            width: 100%;
            height: 400px; /* Altura del carrusel */
            object-fit: cover; /* Ajuste de imagen */
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
                <a class="nav-link" href="{{ route('catalogos') }}">Catálogo</a>
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
    <div class="dashboard">
        <h2>Gestiones</h2>

        <!-- Botones creativos -->
        <div class="text-center">
            <button class="btn btn-custom">Devolucion</button>
            <button class="btn btn-custom">Facturacion</button>
            <button class="btn btn-custom">Cierres de caja</button>
            <button class="btn btn-custom">Reporte clientes</button>
        </div>

        <!-- Carrusel de imágenes -->
        <div id="carouselExampleIndicators" class="carousel slide mt-4" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://unamglobal.unam.mx/wp-content/uploads/2023/12/destacada-buena-taza-de-cafe.jpg" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="https://fmchalet.org/wp-content/uploads/2018/12/Supermercado.jpg" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="https://www.rionegro.com.ar/wp-content/uploads/2023/04/inflacion-marzo.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>