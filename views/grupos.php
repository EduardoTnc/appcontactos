<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Contactos</title>
    
    <!-- Bootstrap CSS -->
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
</nav
<div class="container">
    <h2>Grupos</h2>
    <button class="btn btn-success" data-modal-target="#modalAddGroup">Agregar Grupo</button>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Grupo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se rellenarán los grupos con PHP -->
        </tbody>
    </table>
</div>
<?php include 'modales.php'; ?>
<script src="abrir-cerrar-modales.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>