<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Clientes</title>
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
        <h2>Catálogo de Clientes</h2>

        <!-- Botones de navegación -->
        <div class="mb-3">
            <a href="{{ route('catalogos') }}" class="btn btn-info">Proveedores</a>
            <a href="{{ route('catalogosClientes') }}" class="btn btn-info">Clientes</a>
        </div>

        <!-- Buscador de clientes -->
        <div class="form-group">
            <label for="buscadorClientes">Buscar Cliente</label>
            <input type="text" class="form-control" id="buscadorClientes" placeholder="Escribe el nombre del cliente" oninput="buscarClientes()">
        </div>

        <!-- Botón para agregar cliente -->
        <button class="btn btn-success btn-agregar" data-toggle="modal" data-target="#agregarClienteModal">Agregar Cliente</button>

        <!-- Tabla de clientes -->
        <table class="table table-bordered" id="tablaClientes">
            <thead>
                <tr>
                    <th>NIT Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>DPI Cliente</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="clientesBody">
                <!-- Ejemplo de cliente -->
                <tr>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar cliente -->
<div class="modal fade" id="agregarClienteModal" tabindex="-1" role="dialog" aria-labelledby="agregarClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarClienteModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAgregarCliente">
                    <div class="form-group">
                        <label for="nitCliente">NIT Cliente</label>
                        <input type="text" class="form-control" id="nitCliente" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreCliente">Nombre Cliente</label>
                        <input type="text" class="form-control" id="nombreCliente" required>
                    </div>
                    <div class="form-group">
                        <label for="dpiCliente">DPI Cliente</label>
                        <input type="text" class="form-control" id="dpiCliente" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaRegistro">Fecha de Registro</label>
                        <input type="date" class="form-control" id="fechaRegistro" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Cliente</button>
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
    // Función para buscar clientes
    function buscarClientes() {
        const input = document.getElementById('buscadorClientes').value.toLowerCase();
        const rows = document.querySelectorAll('#tablaClientes tbody tr');

        rows.forEach(row => {
            const clientName = row.cells[1].textContent.toLowerCase();
            row.style.display = clientName.includes(input) ? '' : 'none';
        });
    }

    // Manejo del formulario de agregar cliente
    document.getElementById('formAgregarCliente').addEventListener('submit', function(event) {
        event.preventDefault();

        const nit = document.getElementById('nitCliente').value;
        const nombre = document.getElementById('nombreCliente').value;
        const dpi = document.getElementById('dpiCliente').value;
        const fecha = document.getElementById('fechaRegistro').value;

        const clientesBody = document.getElementById('clientesBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${nit}</td>
            <td>${nombre}</td>
            <td>${dpi}</td>
            <td>${fecha}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editarCliente(this)">Editar</button>
                <button class="btn btn-danger btn-sm" onclick="eliminarCliente(this)">Eliminar</button>
            </td>
        `;
        clientesBody.appendChild(newRow);

        // Limpiar el formulario
        document.getElementById('formAgregarCliente').reset();
        $('#agregarClienteModal').modal('hide'); // Cerrar modal
    });

    // Función para eliminar cliente
    function eliminarCliente(button) {
        const row = button.closest('tr');
        row.remove();
    }

    // Función para editar cliente
    function editarCliente(button) {
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td');

        document.getElementById('nitCliente').value = cells[0].textContent;
        document.getElementById('nombreCliente').value = cells[1].textContent;
        document.getElementById('dpiCliente').value = cells[2].textContent;
        document.getElementById('fechaRegistro').value = cells[3].textContent;

        $('#agregarClienteModal').modal('show');

        // Eliminar el registro original
        eliminarCliente(button);
    }
</script>

</body>
</html>