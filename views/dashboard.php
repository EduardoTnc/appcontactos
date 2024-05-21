<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../controllers/authController.php'; ?>

<div class="container">
    <h2>Dashboard</h2>
    <?php if (isset($_SESSION['user_name'])): ?>
        <p>Bienvenido, <?php echo ($_SESSION['user_name']); ?>, al gestor de contactos. Utilice el menú de navegación para gestionar sus contactos y grupos.</p>
    <?php else: ?>
        <p>Bienvenido al gestor de contactos. Utilice el menú de navegación para gestionar sus contactos y grupos.</p>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>
