<!-- Modal Agregar Contacto -->
<div class="modal" id="modalAddContact">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Agregar Contacto</h2>
        <form id="formAddContact" method="POST" action="../../controllers/contactController.php?action=add">
            <!-- Campos del formulario -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Editar Contacto -->
<div class="modal" id="modalEditContact">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Editar Contacto</h2>
        <form id="formEditContact" method="POST" action="../../controllers/contactController.php?action=edit">
            <!-- Campos del formulario -->
            <input type="hidden" id="edit_contact_id" name="contact_id">
            <div class="form-group">
                <label for="edit_nombre">Nombre:</label>
                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="edit_apellido">Apellido:</label>
                <input type="text" class="form-control" id="edit_apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="edit_email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="edit_email" name="email">
            </div>
            <div class="form-group">
                <label for="edit_telefono">Teléfono:</label>
                <input type="text" class="form-control" id="edit_telefono" name="telefono">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Eliminar Contacto -->
<div class="modal" id="modalDeleteContact">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Eliminar Contacto</h2>
        <p>¿Estás seguro de que deseas eliminar este contacto?</p>
        <form id="formDeleteContact" method="POST" action="../../controllers/contactController.php?action=delete">
            <input type="hidden" id="delete_contact_id" name="contact_id">
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>

<!-- Modal Agregar Grupo -->
<div class="modal" id="modalAddGroup">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Agregar Grupo</h2>
        <form id="formAddGroup" method="POST" action="../../controllers/groupController.php?action=add">
            <!-- Campos del formulario -->
            <div class="form-group">
                <label for="nombre_grupo">Nombre del Grupo:</label>
                <input type="text" class="form-control" id="nombre_grupo" name="nombre_grupo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Editar Grupo -->
<div class="modal" id="modalEditGroup">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Editar Grupo</h2>
        <form id="formEditGroup" method="POST" action="../../controllers/groupController.php?action=edit">
            <!-- Campos del formulario -->
            <input type="hidden" id="edit_group_id" name="group_id">
            <div class="form-group">
                <label for="edit_nombre_grupo">Nombre del Grupo:</label>
                <input type="text" class="form-control" id="edit_nombre_grupo" name="nombre_grupo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Eliminar Grupo -->
<div class="modal" id="modalDeleteGroup">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Eliminar Grupo</h2>
        <p>¿Estás seguro de que deseas eliminar este grupo?</p>
        <form id="formDeleteGroup" method="POST" action="../../controllers/groupController.php?action=delete">
            <input type="hidden" id="delete_group_id" name="group_id">
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>
