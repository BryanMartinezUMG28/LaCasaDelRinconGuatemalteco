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
        .table img {
            width: 50px;
            height: auto;
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
    <div class="dashboard">
        <h2>Ingreso/Revision Productos</h2>
        
        <!-- Campo de búsqueda -->
        <div class="form-group">
            <label for="busqueda">Buscar Producto:</label>
            <input type="text" class="form-control" id="busqueda" placeholder="Buscar por nombre" oninput="filtrarProductos()">
        </div>

        <form id="formularioCRUD" class="mb-4">
            <div class="form-group">
                <label for="item">Ítem:</label>
                <input type="text" class="form-control" id="item" placeholder="Ingrese un ítem" required>
            </div>
            <div class="form-group">
                <label for="nombreProducto">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombreProducto" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="form-group">
                <label for="imagen">URL de la Imagen:</label>
                <input type="text" class="form-control" id="imagen" placeholder="Ingrese la URL de la imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>

        <table class="table table-bordered" id="tablaProductos">
            <thead>
                <tr>
                    <th>Ítem</th>
                    <th>Nombre del Producto</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="listaProductos">
                <!-- Los productos se agregarán aquí -->
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const formularioCRUD = document.getElementById('formularioCRUD');
    const listaProductos = document.getElementById('listaProductos');
    const campoBusqueda = document.getElementById('busqueda');
    let productos = [];

    function renderizarLista(productosFiltrados) {
        listaProductos.innerHTML = '';
        const itemsARenderizar = productosFiltrados || productos;

        itemsARenderizar.forEach((producto, indice) => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${producto.item}</td>
                <td>${producto.nombreProducto}</td>
                <td><img src="${producto.imagen}" alt="Imagen de ${producto.nombreProducto}"></td>
                <td>
                    <button class="btn btn-warning" onclick="editarProducto(${indice})">Editar</button>
                    <button class="btn btn-danger" onclick="eliminarProducto(${indice})">Eliminar</button>
                </td>
            `;
            listaProductos.appendChild(fila);
        });
    }

    formularioCRUD.addEventListener('submit', function(event) {
        event.preventDefault();
        const nuevoProducto = {
            item: document.getElementById('item').value,
            nombreProducto: document.getElementById('nombreProducto').value,
            imagen: document.getElementById('imagen').value,
        };
        productos.push(nuevoProducto);
        formularioCRUD.reset();
        renderizarLista();
    });

    function editarProducto(indice) {
        const producto = productos[indice];
        const nuevoItem = prompt("Editar ítem:", producto.item);
        const nuevoNombreProducto = prompt("Editar nombre del producto:", producto.nombreProducto);
        const nuevaImagen = prompt("Editar URL de la imagen:", producto.imagen);
        
        if (nuevoItem && nuevoNombreProducto && nuevaImagen) {
            productos[indice] = { item: nuevoItem, nombreProducto: nuevoNombreProducto, imagen: nuevaImagen };
            renderizarLista();
        }
    }

    function eliminarProducto(indice) {
        productos.splice(indice, 1);
        renderizarLista();
    }

    function filtrarProductos() {
        const terminoBusqueda = campoBusqueda.value.toLowerCase();
        const productosFiltrados = productos.filter(producto =>
            producto.nombreProducto.toLowerCase().includes(terminoBusqueda)
        );
        renderizarLista(productosFiltrados);
    }
</script>

</body>
</html>