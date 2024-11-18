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
        .table th, .table td {
            text-align: center;
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
            <button type="button" class="btn btn-success" onclick="mostrarFormularioCliente()">Confirmar Pago</button>
        </form>
    </div>
</div>

<!-- Modal para ingresar datos del cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clienteModalLabel">Ingrese los Datos del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombreCliente">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="nombreCliente" required>
                </div>
                <div class="form-group">
                    <label for="nitCliente">Número de NIT</label>
                    <input type="text" class="form-control" id="nitCliente" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="generarFactura()">Generar Factura</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- jsPDF for PDF Generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
                { id: 1, nombre: 'Cebollas', precio: 1.50 },
                { id: 2, nombre: 'Tomates', precio: 2.00 },
                { id: 3, nombre: 'Zanahorias', precio: 1.20 },
                { id: 4, nombre: 'Papitas', precio: 0.80 },
                { id: 5, nombre: 'Lechuga', precio: 1.00 },
                { id: 6, nombre: 'Manzanas', precio: 3.00 },
                { id: 7, nombre: 'Plátanos', precio: 1.50 },
                { id: 8, nombre: 'Uvas', precio: 4.00 },
                { id: 9, nombre: 'Gaseosa Cola', precio: 1.50 },
                { id: 10, nombre: 'Gaseosa Naranja', precio: 1.50 },
                { id: 11, nombre: 'Jugo de Naranja', precio: 2.50 },
                { id: 12, nombre: 'Agua Mineral', precio: 1.00 },
                { id: 13, nombre: 'Pan de Caja', precio: 2.00 },
                { id: 14, nombre: 'Arroz', precio: 1.80 },
                { id: 15, nombre: 'Frijoles', precio: 1.50 },
                { id: 16, nombre: 'Aceite de Oliva', precio: 6.00 },
                { id: 17, nombre: 'Sal', precio: 0.50 },
                { id: 18, nombre: 'Pasta', precio: 1.50 },
                { id: 19, nombre: 'Salsa de Tomate', precio: 2.00 },
                { id: 20, nombre: 'Queso', precio: 3.50 },
                { id: 21, nombre: 'Yogur', precio: 1.20 },
                { id: 22, nombre: 'Huevos', precio: 2.50 },
                { id: 23, nombre: 'Carne de Pollo', precio: 5.00 },
                { id: 24, nombre: 'Carne de Res', precio: 7.00 },
                { id: 25, nombre: 'Pescado', precio: 6.50 }

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

    // Actualizar el carrito en la tabla y el total a pagar
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
                    <input type="number" value="${item.cantidad}" min="1" class="form-control" onchange="actualizarCantidad(${item.id}, this.value)">
                </td>
                <td>$${item.precio.toFixed(2)}</td>
                <td>$${subtotal.toFixed(2)}</td>
                <td><button class="btn btn-danger" onclick="eliminarDelCarrito(${item.id})">Eliminar</button></td>
            `;
            carritoBody.appendChild(row);
        });

        // Actualizar total en la interfaz
        document.getElementById('totalAPagar').value = `$${total.toFixed(2)}`;
    }

    // Función para actualizar la cantidad de un producto
    function actualizarCantidad(id, cantidad) {
        const item = carrito.find(i => i.id === id);
        item.cantidad = parseInt(cantidad);
        actualizarCarrito();
    }

    // Eliminar producto del carrito
    function eliminarDelCarrito(id) {
        const index = carrito.findIndex(i => i.id === id);
        if (index !== -1) {
            carrito.splice(index, 1);
            actualizarCarrito();
        }
    }

    // Mostrar el formulario para ingresar los datos del cliente
    function mostrarFormularioCliente() {
        $('#clienteModal').modal('show');
    }

    // Generar factura en PDF
    function generarFactura() {
        const nombreCliente = document.getElementById('nombreCliente').value;
        const nitCliente = document.getElementById('nitCliente').value;

        if (!nombreCliente || !nitCliente) {
            alert("Por favor, ingrese todos los datos del cliente.");
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Factura electronica La Casa Del Rincon Guatemalteco", 10, 10);
        doc.text("Fecha: " + new Date().toLocaleString(), 10, 20);
        doc.text("Cliente: " + nombreCliente, 10, 30);
        doc.text("NIT: " + nitCliente, 10, 40);
        doc.text("Detalle de la compra:", 10, 50);

        let yPosition = 60;
        carrito.forEach(item => {
            doc.text(`${item.nombre} - Cantidad: ${item.cantidad} - Subtotal: $${(item.precio * item.cantidad).toFixed(2)}`, 10, yPosition);
            yPosition += 10;
        });

        doc.text(`Total a Pagar: $${total.toFixed(2)}`, 10, yPosition);

        doc.save("factura.pdf");
        $('#clienteModal').modal('hide'); // Cerrar el modal
    }
</script>
</body>
</html>
