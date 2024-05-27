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
$userId = $_SESSION['user_id'];

// Crear una instancia del modelo Contact
$contacto = new Contact($pdo);

// Obtener todos los contactos del usuario desde la base de datos
$contactos = $contacto->getAllByUserId($userId);

$dir = "fotos/";

?>

<!DOCTYPE html>
<html lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Contactos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    </nav>
    <h2>Contactos</h2>

    <p>Bienvenido <strong><?php echo ($_SESSION['user_name']); ?></strong>, a su gestor de contactos.</p>

    <div class="container lista-contactos">
        <h2>Contactos</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddContact">
            Agregar Contacto
        </button>

        <!-- Tabla de contactos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $contacto) : ?>
                    <tr>
                        <td>
                            <img src="<?php echo !empty($contacto['foto_perfil']) ? htmlspecialchars($contacto['foto_perfil']) : 'fotos/default-profile.png'; ?>" alt="Foto de perfil" width="50px" >
                            
                            <?php echo htmlspecialchars($contacto['nombre']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($contacto['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($contacto['email']); ?></td>
                        <td><?php echo htmlspecialchars($contacto['telefono']); ?></td>
                        <td>
                            <!-- Botón para editar contacto -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditContact" data-contact-id="<?php echo $contacto['contacto_id']; ?>">Editar</button>
                            <!-- Botón para eliminar contacto -->
                            <button class="btn btn-danger btn-sm btn-delete-contact" data-bs-toggle="modal" data-bs-target="#modalDeleteContact" data-contact-id="<?php echo $contacto['contacto_id']; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Incluir modales -->
    <?php include 'modales.php'; ?>

    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
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
    </script>


    <!-- Script para cargar datos en el modal de edición -->
    <script>
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
</body>

</html>