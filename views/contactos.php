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
    </nav>
    <?php include '../controllers/authController.php'; ?> <div class="container">
    </nav>
     <h2>Contactos</h2>

<p>Bienvenido, <strong> admin</strong>, a su gestor de contactos.</p>
<div class="container lista-contactos">
        <h2>Contactos</h2>
        
        <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required="">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required="">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email" required="">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required="">
                    </div>
                    <div class="form-group">
                        <label for="direccion">direccion</label>
                        <input type="tel" class="form-control" id="direccion" name="direccion" required="">
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">fecha_nacimiento</label>
                        <input type="tel" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required="">
                    </div>
                    <div class="form-group">
                        <label for="etiqueta	">etiqueta	</label>
                        <input type="tel" class="form-control" id="etiqueta	" name="etiqueta	" required="">
                    </div>
                </div><div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   
                    <button class="btn btn-success" data-modal-target="#modalAddContact">Agregar Contacto</button>
                </div><table class="table">
           
            <tbody>
            <form id="formAgregarContacto" action="../controllers/agregar_contacto.php" method="post"></form>
                
                
            
                <!-- Aquí se rellenarán los contactos con PHP -->
            </tbody>
        </table>
    </div>

    <?php include 'modales.php'; ?>
    <script src="abrir-cerrar-modales.js"></script>

    
    
    
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



</body>

</html>

