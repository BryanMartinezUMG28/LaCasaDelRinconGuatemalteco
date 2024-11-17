<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Proveedores</title>
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
        .btn-agregar {
            margin-bottom: 15px;
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
        <h2>Catálogo de Proveedores</h2>

        <!-- Botones de navegación -->
        <div class="mb-3">
            <a href="{{ route('catalogos') }}" class="btn btn-info">Proveedores</a>
            <a href="{{ route('catalogosClientes') }}" class="btn btn-info">Clientes</a>
        </div>

        <!-- Buscador de proveedores -->
        <div class="form-group">
            <label for="buscadorProveedores">Buscar Proveedor</label>
            <input type="text" class="form-control" id="buscadorProveedores" placeholder="Escribe el nombre del proveedor" oninput="buscarProveedores()">
        </div>

        <!-- Botón para agregar proveedor -->
        <button class="btn btn-success btn-agregar" data-toggle="modal" data-target="#agregarProveedorModal">Agregar Proveedor</button>

        <!-- Tabla de proveedores -->
        <table class="table table-bordered" id="tablaProveedores">
            <thead>
                <tr>
                    <th>Código Proveedor</th>
                    <th>Nombre Proveedor</th>
                    <th>Producto Venta</th>
                    <th>Fecha de Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="proveedoresBody">
                <!-- Ejemplo de proveedor -->
                <tr>
                   
                </tr>
                <!-- Más proveedores según sea necesario -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar proveedor -->
<div class="modal fade" id="agregarProveedorModal" tabindex="-1" role="dialog" aria-labelledby="agregarProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProveedorModalLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAgregarProveedor">
                    <div class="form-group">
                        <label for="codigoProveedor">Código Proveedor</label>
                        <input type="text" class="form-control" id="codigoProveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreProveedor">Nombre Proveedor</label>
                        <input type="text" class="form-control" id="nombreProveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="productoVenta">Producto Venta</label>
                        <input type="text" class="form-control" id="productoVenta" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaIngreso">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="fechaIngreso" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Función para buscar proveedores
    function buscarProveedores() {
        const input = document.getElementById('buscadorProveedores').value.toLowerCase();
        const rows = document.querySelectorAll('#tablaProveedores tbody tr');

        rows.forEach(row => {
            const providerName = row.cells[1].textContent.toLowerCase();
            row.style.display = providerName.includes(input) ? '' : 'none';
        });
    }

    // Manejo del formulario de agregar proveedor
    document.getElementById('formAgregarProveedor').addEventListener('submit', function(event) {
        event.preventDefault();

        const codigo = document.getElementById('codigoProveedor').value;
        const nombre = document.getElementById('nombreProveedor').value;
        const producto = document.getElementById('productoVenta').value;
        const fecha = document.getElementById('fechaIngreso').value;

        const proveedoresBody = document.getElementById('proveedoresBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${codigo}</td>
            <td>${nombre}</td>
            <td>${producto}</td>
            <td>${fecha}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editarProveedor(this)">Editar</button>
                <button class="btn btn-danger btn-sm" onclick="eliminarProveedor(this)">Eliminar</button>
            </td>
        `;
        proveedoresBody.appendChild(newRow);

        // Limpiar el formulario
        document.getElementById('formAgregarProveedor').reset();
        $('#agregarProveedorModal').modal('hide'); // Cerrar modal
    });

    // Función para eliminar proveedor
    function eliminarProveedor(button) {
        const row = button.closest('tr');
        row.remove();
    }

    // Función para editar proveedor
    function editarProveedor(button) {
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td');

        document.getElementById('codigoProveedor').value = cells[0].textContent;
        document.getElementById('nombreProveedor').value = cells[1].textContent;
        document.getElementById('productoVenta').value = cells[2].textContent;
        document.getElementById('fechaIngreso').value = cells[3].textContent;

        $('#agregarProveedorModal').modal('show');

        // Eliminar el registro original
        eliminarProveedor(button);
    }
</script>

</body>
</html>