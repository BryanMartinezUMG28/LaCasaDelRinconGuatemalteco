<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despacho de Productos</title>
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
            background-color: #28a745;
        }
        .dashboard {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 10px;
        }
        .result-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }
        .result-item {
            padding: 10px;
            cursor: pointer;
        }
        .result-item:hover {
            background-color: #f1f1f1;
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
        <h2>Área de Despacho de Productos</h2>

        <!-- Buscador de productos -->
        <div class="form-group">
            <label for="buscador">Buscar Producto</label>
            <input type="text" class="form-control" id="buscador" placeholder="Escribe el nombre del producto" oninput="buscarProductos()">
        </div>

        <!-- Resultados de búsqueda -->
        <div class="result-list" id="resultList"></div>

        <!-- Sección del carrito -->
        <h3>Carrito de Compras</h3>
        <table class="table table-bordered" id="carrito">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="carritoBody"></tbody>
        </table>

        <!-- Sección de cobro -->
        <h3>Realizar Cobro</h3>
        <form id="cobroForm">
            <div class="form-group">
                <label for="totalAPagar">Total a Pagar</label>
                <input type="text" class="form-control" id="totalAPagar" value="$0.00" readonly>
            </div>
            <div class="form-group">
                <label for="metodoPago">Método de Pago</label>
                <select class="form-control" id="metodoPago" required>
                    <option value="" disabled selected>Seleccione un método</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Confirmar Pago</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let total = 0;
    const carrito = [];

    // Función para buscar productos (simulación de API)
    async function buscarProductos() {
        const query = document.getElementById('buscador').value;

        // Simulación de llamada a API
        const productos = await obtenerProductos(query);
        mostrarResultados(productos);
    }

    // Simulación de recuperación de productos de una base de datos
    async function obtenerProductos(query) {
        // Simulando un retardo de la API
        return new Promise(resolve => {
            const productos = [
                { id: 1, nombre: 'Producto 1', precio: 10.00 },
                { id: 2, nombre: 'Producto 2', precio: 20.00 },
                { id: 3, nombre: 'Producto 3', precio: 15.00 },
                { id: 4, nombre: 'Producto 4', precio: 25.00 },
                { id: 5, nombre: 'Producto 5', precio: 30.00 }
            ];

            const resultados = productos.filter(p => p.nombre.toLowerCase().includes(query.toLowerCase()));
            setTimeout(() => resolve(resultados), 500);
        });
    }

    // Mostrar resultados de búsqueda
    function mostrarResultados(productos) {
        const resultList = document.getElementById('resultList');
        resultList.innerHTML = '';

        productos.forEach(producto => {
            const item = document.createElement('div');
            item.className = 'result-item';
            item.innerHTML = `${producto.nombre} - $${producto.precio.toFixed(2)}`;
            item.onclick = () => agregarAlCarrito(producto.id, producto.nombre, producto.precio);
            resultList.appendChild(item);
        });
    }

    // Función para agregar productos al carrito
    function agregarAlCarrito(id, nombre, precio) {
        const cantidad = 1; // Cantidad inicial
        const item = { id, nombre, precio, cantidad };
        const existingItem = carrito.find(i => i.id === id);
        
        if (existingItem) {
            existingItem.cantidad += 1; // Aumentar cantidad si ya existe
        } else {
            carrito.push(item); // Agregar nuevo producto
        }

        actualizarCarrito();
    }

    // Actualizar el carrito en la tabla
    function actualizarCarrito() {
        const carritoBody = document.getElementById('carritoBody');
        carritoBody.innerHTML = ''; // Limpiar la tabla

        total = 0; // Reiniciar total

        carrito.forEach(item => {
            const subtotal = item.precio * item.cantidad;
            total += subtotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.nombre}</td>
                <td>
                    <input type="number" value="${item.cantidad}" min="1" onchange="actualizarCantidad(${item.id}, this.value)">
                </td>
                <td>$${item.precio.toFixed(2)}</td>
                <td>$${subtotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${item.id})">Eliminar</button>
                </td>
            `;
            carritoBody.appendChild(row);
        });

        document.getElementById('totalAPagar').value = "$" + total.toFixed(2);
    }

    // Actualizar cantidad de un producto en el carrito
    function actualizarCantidad(id, cantidad) {
        const item = carrito.find(i => i.id === id);
        if (item) {
            item.cantidad = parseInt(cantidad);
            actualizarCarrito();
        }
    }

    // Eliminar producto del carrito
    function eliminarDelCarrito(id) {
        const index = carrito.findIndex(i => i.id === id);
        if (index !== -1) {
            carrito.splice(index, 1); // Eliminar producto
            actualizarCarrito();
        }
    }

    // Manejo del formulario de cobro
    document.getElementById('cobroForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const metodoPago = document.getElementById('metodoPago').value;
        alert("Pago realizado: Total " + document.getElementById('totalAPagar').value + " con método " + metodoPago);
        // Aquí puedes agregar lógica para procesar el pago y resetear el carrito
        total = 0;
        document.getElementById('totalAPagar').value = "$0.00";
        document.getElementById('metodoPago').selectedIndex = 0; // Resetea el método de pago
        carrito.length = 0; // Vaciar carrito
        actualizarCarrito(); // Actualizar la tabla del carrito
    });
</script>

</body>
</html>