<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
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
<?php include '../../includes/modals.php'; ?>
<?php include '../../includes/footer.php'; ?>
