<?php
// Incluir archivos necesarios para la configuración de la base de datos y los modelos
require_once '../config/db.php';
require_once '../models/Contact.php';
require_once '../models/Group.php';

// Iniciar sesión para acceder a las variables de sesión
session_start();

// Verificar si el usuario está logueado, si no, redirigir al formulario de login
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . APP_URL . 'views/login.php');
    exit();
}

// Obtener el ID del usuario de la sesión actual
$usuarioID = $_SESSION['user_id'];

// Crear una instancia del modelo Contact para interactuar con la base de datos
$contacto = new Contact($conexion);

// Obtener todos los contactos del usuario actual usando el ID de la sesión
$contactos = $contacto->obtenerContactos($usuarioID);

// Obtener el número total de contactos del usuario actual
$totalContactos = $contacto->obtenerTotalContactos($usuarioID);

$rutaFotosPerfil = "fotos/";

// Crear una instancia del modelo Group para interactuar con la base de datos
$grupo = new Group($conexion);
// Obtener los grupos del usuario actual
$grupos = $grupo->obtenerGruposPorUsuarioID($_SESSION['user_id']);

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
    <!-- links de scripts necesarios para el cargado de datos -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            background-color: #bccae3 !important;
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

        .btn_add:hover {
            opacity: 0.8;
        }

        hr {
            height: 1px !important;
            color: #157347 !important;
            width: 100% !important;
            background-color: red;
        }


        .titulo_modal {
            width: 100%;
            display: flex;
            justify-content: center;
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


        .foto-perfil {
            aspect-ratio: 1;
            border-radius: 50%;
            width: 40px;
        }
    </style>
</head>

<body>

    <div class="container rounded-pill">
        <h1 class="text-center mt-4  fw-bold ">Bienvenido <strong><?php echo ($_SESSION['user_name']); ?></strong> a tu aplicación de contactos</h1>
    </div>
    <div class="container-xxl">
        <div class="row">
            <div class="col-10 ">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <h3>
                            <span class="float-start">

                            </span>
                            Tienes <?php echo $totalContactos ?> contactos registrados.
                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAddContact">
                                Nuevo Contacto
                            </button>
                            <!-- <span class="float-end">
                                <a href="exportar.php" class="btn btn-success" title="Exportar a CSV" download="empleados.csv"><i class="bi bi-filetype-csv"></i> Exportar</a>
                            </span> -->
                            <!-- <hr> -->
                        </h3>

                        <!-- TABLA CONTACTOS -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabla_contactos">
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
                                                <img class="foto-perfil" src="<?php echo !empty($contacto['foto_perfil']) ? htmlspecialchars($contacto['foto_perfil']) : 'fotos/default-profile.png'; ?>" alt="Foto de perfil">
                                                <?php echo htmlspecialchars($contacto['nombre']); ?> <?php echo htmlspecialchars($contacto['apellido']); ?>
                                            </td>

                                            <td class="align-middle"><?php echo htmlspecialchars($contacto['email']); ?></td>
                                            <td class="align-middle"><?php echo htmlspecialchars($contacto['telefono']); ?></td>
                                            <td class="align-middle d-flex">
                                                <div class="dropdown">
                                                    <!-- Botón para agregar contacto a grupos -->
                                                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-contact-id="<?php echo $contacto['contacto_id']; ?>" aria-expanded="false">
                                                        <i class="bi bi-plus-circle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark">
                                                        <?php foreach ($grupos as $grupo) : ?>
                                                            <li>
                                                                <form action="../controllers/grupoContactosController.php" method="POST">
                                                                    <input type="hidden" name="contacto_id" value="<?php echo $contacto['contacto_id']; ?>">
                                                                    <input type="hidden" name="grupo_id" value="<?php echo $grupo['creacion_grupo_id']; ?>">
                                                                    <button type="submit" class="dropdown-item"><?php echo htmlspecialchars($grupo['nombre_grupo']); ?></button>
                                                                </form>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        <li><a class="dropdown-item bg-success text-white btn" data-bs-toggle="modal" data-bs-target="#modalAddGroup">Crear un nuevo grupo</a></li>
                                                    </ul>
                                                </div>

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
            <div class="col-2 text-center">

                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalAddGroup">
                    Nuevo Grupo
                </button>

                <h3 class="mt-4">
                    Grupos
                </h3>
                <!-- TABLA GRUPOS -->

                <table class="table table-hover table-dark" id="tabla_grupos">
                    <thead class="table-dark">
                        <tr>
                            <!-- <th scope="col">#</th> -->
                            <!-- <th scope="col">Nombre</th> -->
                            <!-- <th scope="col">Acciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grupos as $grupo) : ?>
                            <tr>
                                <!-- <th scope="row" class="align-middle"><?php echo $grupo['creacion_grupo_id']; ?></th> -->
                                <td class="align-middle"><?php echo htmlspecialchars($grupo['nombre_grupo']); ?></td>
                                <td class="align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" type="button" id="dropdownMenuButton<?php echo $grupo['creacion_grupo_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $grupo['creacion_grupo_id']; ?>">
                                            <li><a class="dropdown-item btn-edit-group" href="#" data-group-id="<?php echo $grupo['creacion_grupo_id']; ?>" data-bs-toggle="modal" data-bs-target="#modalEditGroup">Editar</a></li>
                                            <li><a class="dropdown-item btn-delete-group" href="#" data-group-id="<?php echo $grupo['creacion_grupo_id']; ?>" data-bs-toggle="modal" data-bs-target="#modalDeleteGroup">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
        // Script para cargar datos en el modal de edición

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-warning').forEach(button => {
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
                            } else {
                                console.error('Error fetching contact data:', data.message);
                            }
                        })
                        .catch(error => console.error('Error fetching contact data:', error));
                });
            });
        });

        // Script para cargar datos en el modal de eliminación de contactos
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


        // Script para cargar datos en el modal de edición y eliminación de grupos
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-edit-group').forEach(button => {
                button.addEventListener('click', () => {
                    const groupId = button.getAttribute('data-group-id');
                    fetch(`../controllers/groupController.php?action=get&group_id=${groupId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const group = data.group;
                                document.getElementById('edit-group-id').value = group.creacion_grupo_id;
                                document.getElementById('edit-nombre-grupo').value = group.nombre_grupo;
                            } else {
                                console.error('Error fetching group data:', data.message);
                            }
                        })
                        .catch(error => console.error('Error fetching group data:', error));
                });
            });

            document.querySelectorAll('.btn-delete-group').forEach(button => {
                button.addEventListener('click', () => {
                    const groupId = button.getAttribute('data-group-id');
                    document.getElementById('delete-group-id').value = groupId;
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