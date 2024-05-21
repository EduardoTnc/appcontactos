<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="../controllers/authController.php?action=login">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
