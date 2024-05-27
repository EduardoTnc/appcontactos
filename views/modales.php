<!-- Modal Agregar Contacto -->
<div class="modal fade" id="modalAddContact" tabindex="-1" aria-labelledby="modalAddContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formAddContact" method="POST" action="../controllers/contactController.php?action=add" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddContactLabel">Agregar Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                <label for="nombre">Nombre:</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                                <label for="apellido">Apellido:</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico">
                        <label for="email">Correo Electrónico:</label>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                        <label for="telefono">Teléfono:</label>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                        <label for="direccion">Dirección:</label>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" for="fecha_nacimiento">Fecha de nacimiento:</span>
                        <input type="date" class="form-control" placeholder="Fecha nacimiento" id="fecha_nacimiento" name="fecha_nacimiento" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="foto_perfil">Foto</label>
                        <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="etiqueta" name="etiqueta" placeholder="Etiqueta">
                        <label for="etiqueta">Etiqueta:</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Contacto</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Modal Editar Contacto -->
<div class="modal fade" id="modalEditContact" tabindex="-1" aria-labelledby="modalEditContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditContact" method="POST" action="../controllers/contactController.php?action=edit" enctype="multipart/form-data" >
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditContactLabel">Editar Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-contact-id" name="contact_id">
                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" id="edit-nombre" name="nombre" placeholder="Nombre" required>
                                <label for="edit-nombre">Nombre:</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" id="edit-apellido" name="apellido" placeholder="Apellido">
                                <label for="edit-apellido">Apellido:</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="email" class="form-control" id="edit-email" name="email" placeholder="Correo Electrónico">
                        <label for="edit-email">Correo Electrónico:</label>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="edit-telefono" name="telefono" placeholder="Teléfono">
                        <label for="edit-telefono">Teléfono:</label>
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="edit-direccion" name="direccion" placeholder="Dirección">
                        <label for="edit-direccion">Dirección:</label>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" for="edit-fecha_nacimiento">Fecha de nacimiento:</span>
                        <input type="date" class="form-control" placeholder="Fecha nacimiento" id="edit-fecha_nacimiento" name="fecha_nacimiento" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="edit-foto_perfil">Foto</label>
                        <input type="file" class="form-control" id="edit-foto_perfil" name="foto_perfil" accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" id="edit-etiqueta" name="etiqueta" placeholder="Etiqueta">
                        <label for="edit-etiqueta">Etiqueta:</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Eliminar Contacto -->
<div class="modal fade" id="modalDeleteContact" tabindex="-1" aria-labelledby="modalDeleteContactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formDeleteContact" method="POST" action="../controllers/contactController.php?action=delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteContactLabel">Eliminar Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar este contacto?</p>
                    <input type="hidden" id="deleteContactId" name="contact_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
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