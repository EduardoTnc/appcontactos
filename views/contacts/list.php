<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<div class="container">
    <h2>Contactos</h2>
    <button class="btn btn-success" data-modal-target="#modalAddContact">Agregar Contacto</button>
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
            <!-- Aquí se rellenarán los contactos con PHP -->
        </tbody>
    </table>
</div>
<?php include '../../includes/modals.php'; ?>
<?php include '../../includes/footer.php'; ?>
