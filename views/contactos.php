<?php
// Incluir archivos necesarios
require_once '../config/db.php';
require_once '../models/Contact.php';
require_once '../controllers/authController.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . 'views/login.php');
    exit();
}

// Obtener el ID del usuario de la sesión
$usuarioID = $_SESSION['user_id'];

// Crear una instancia del modelo Contact
$contacto = new Contact($conexion);

// Obtener todos los contactos del usuario
$contactos = $contacto->obtenerContactos($usuarioID);

// Obtener el número de contactos del usuario
$totalContactos = $contacto->obtenerTotalContactos($usuarioID);

$rutaFotosPerfil = "fotos/";

?>

<!DOCTYPE html>
<html lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Contactos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            background-color: #e3eaff !important;
        }

        .col-10 {
            background-color: #fff !important;
            padding: 20px;
            border-radius: 10px;
        }

        .col-2 {
            background-color: #fff !important;
            padding: 20px;
            border-radius: 10px;
        }

        label,
        .dt-search {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .btn_add {
            width: 100%;
            border: 1px solid #333 !important;
            background-color: #333 !important;
        }

        .btn_add:hover {
            opacity: 0.8;
        }



        hr {
            height: 1px !important;
            color: #157347 !important;
            width: 100% !important;
            background-color: red;
        }

        .bi-arrow-right-circle {
            font-size: 30px;
        }

        .titulo_modal {
            width: 100%;
            display: flex;
            justify-content: center;
            color: #444;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        thead tr th {
            text-align: start !important;
        }

        tr td {
            text-align: start !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-responsive::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            /* Oculta la barra lateral fuera de la vista inicialmente */
            background-color: #343a40;
            padding-top: 20px;
            color: #fff;
            transition: 0.3s;
            /* Transición suave para el despliegue */
            z-index: 1000;
            /* Asegurar que la barra lateral esté sobre otros elementos */
        }

        .sidebar.active {
            left: 0;
            /* Despliega la barra lateral */
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .main-content {
            margin-left: 250px;
            /* Espacio para el botón de toggle */
            padding: 20px;
            transition: 0.3s;
        }

        .toggle-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            /* Asegurar que el botón esté sobre otros elementos */
            transition: 0.3s;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            /* Justo debajo de la barra lateral */
            display: none;
        }

        .overlay.active {
            display: block;
        }

        .foto-perfil {
            aspect-ratio: 1;
            border-radius: 50%;
            width: 40px;
        }
    </style>
</head>

<body>



    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../views/contactos.php">App Contactos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="contactos.php">Contactos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="grupos.php">Grupos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/authController.php?action=logout">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav> -->

    <!-- Botón de toggle para la barra lateral -->
    <!-- <button class="btn btn-primary toggle-button" id="sidebarToggle">☰</button> -->

    <!-- Superposición para cerrar la barra lateral al hacer clic fuera -->
    <!-- <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <a href="#" class="navbar-brand">App Contactos</a>
        <nav class="nav flex-column">
            <a class="nav-link" href="contactos.php">Contactos</a>
            <a class="nav-link" href="grupos.php">Grupos</a>
            <a class="nav-link" href="../controllers/authController.php?action=logout">Cerrar Sesión</a>
        </nav>
    </div>
    <h2>Contactos</h2>

    <p>Bienvenido <strong><?php echo ($_SESSION['user_name']); ?></strong>, a su gestor de contactos.</p> -->
    <div class="container rounded-pill">
        <h1 class="text-center mt-4  fw-bold ">Bienvenido <strong><?php echo ($_SESSION['user_name']); ?></strong> a tu aplicación de contactos</h1>
    </div>
    <div class="container">
        <div class="row d-flex">
            <div class="col-10 ">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <h3 class="text-center">
                            <span class="float-start">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddContact">
                                    Nuevo Contacto
                                </button>
                            </span>
                            Tienes <?php echo $totalContactos ?> contactos registrados.
                            <span class="float-end">
                                <a href="exportar.php" class="btn btn-success" title="Exportar a CSV" download="empleados.csv"><i class="bi bi-filetype-csv"></i> Exportar</a>
                            </span>
                            <!-- <hr> -->
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-hover  table-light" id="tabla_contactos">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        
                                        <th scope="col">Email</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contactos as $contacto) : ?>
                                        <tr>
                                            <th scope="row" class="align-middle"><?php echo $contacto['contacto_id']; ?></th>
                                            <td class="align-middle">
                                                <img class="foto-perfil" src="<?php echo !empty($contacto['foto_perfil']) ? htmlspecialchars($contacto['foto_perfil']) : 'fotos/default-profile.png'; ?>" alt="Foto de perfil" >

                                                <?php echo htmlspecialchars($contacto['nombre']); ?> <?php echo htmlspecialchars($contacto['apellido']); ?>
                                            </td>
                                            
                                            <td class="align-middle"><?php echo htmlspecialchars($contacto['email']); ?></td>
                                            <td class="align-middle"><?php echo htmlspecialchars($contacto['telefono']); ?></td>
                                            <td class="align-middle">
                                                <!-- Botón para agregar contacto a grupos -->
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#" data-contact-id="<?php echo $contacto['contacto_id']; ?>"><i class="bi bi-plus-circle"></i></button>
                                                <!-- Botón para editar contacto -->
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditContact" data-contact-id="<?php echo $contacto['contacto_id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <!-- Botón para eliminar contacto -->
                                                <button class="btn btn-danger btn-delete-contact" data-bs-toggle="modal" data-bs-target="#modalDeleteContact" data-contact-id="<?php echo $contacto['contacto_id']; ?>"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <h3 class="text-center mt-4">
                    Grupos
                    <hr>
                </h3>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddGroup">
                    Agregar Grupo
                </button>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="table-light">
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se rellenarán los grupos con PHP -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <span class="float-end mt-2">
            <a href="../controllers/authController.php?action=logout" onclick="modalRegistrarEmpleado()" class="btn btn-danger" title="Registrar Nuevo Empleado">
                <i class="bi bi-door-open"> Cerrar Sesión</i>
            </a>
        </span>
    </div>
    <!-- Incluir modales -->
    <?php include 'modales.php'; ?>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('mainContent');
            var overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('shifted');
            overlay.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                this.style.display = 'none'; // Ocultar el botón de toggle cuando la barra lateral esté desplegada
            } else {
                this.style.display = 'block';
            }
        });

        document.getElementById('overlay').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.getElementById('mainContent');
            var overlay = document.getElementById('overlay');
            sidebar.classList.remove('active');
            mainContent.classList.remove('shifted');
            overlay.classList.remove('active');
            document.getElementById('sidebarToggle').style.display = 'block'; // Mostrar el botón de toggle nuevamente
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Capturar evento de clic en los botones de eliminar
            document.querySelectorAll('.btn-delete-contact').forEach(button => {
                button.addEventListener('click', function() {
                    // Obtener el contacto_id del atributo data-contact-id
                    const contactId = this.getAttribute('data-contact-id');
                    // Asignar el contacto_id al campo oculto del formulario del modal
                    document.getElementById('deleteContactId').value = contactId;
                });
            });
        });

        // Script para cargar datos en el modal de edición

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', () => {
                    const contactId = button.getAttribute('data-contact-id');
                    fetch(`../controllers/contactController.php?action=get&contact_id=${contactId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const contact = data.contact;
                                document.getElementById('edit-contact-id').value = contact.contacto_id;
                                document.getElementById('edit-nombre').value = contact.nombre;
                                document.getElementById('edit-apellido').value = contact.apellido;
                                document.getElementById('edit-email').value = contact.email;
                                document.getElementById('edit-telefono').value = contact.telefono;
                                document.getElementById('edit-direccion').value = contact.direccion;
                                document.getElementById('edit-fecha-nacimiento').value = contact.fecha_nacimiento;
                                document.getElementById('edit-etiqueta').value = contact.etiqueta;
                            }
                        })
                        .catch(error => console.error('Error fetching contact data:', error));
                });
            });
        });
    </script>

    <!-------------------------Librería  datatable para la tabla -------------------------->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $("#tabla_contactos").DataTable({
                pageLength: 10,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                },
            });
        });
    </script>

</body>

</html>