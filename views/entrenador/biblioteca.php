<?php include 'views/layouts/header.php'; ?>

<div class="dashboard-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0">Patín Carrera</h4>
        </div>
        <ul class="nav flex-column nav-menu">
            <li class="nav-item"><a href="index.php?action=panel_entrenador" class="nav-item-custom"><i class="fas fa-home me-2"></i> Inicio</a></li>
            <li class="nav-item"><a href="index.php?action=ver_entrenamientos" class="nav-item-custom"><i class="fas fa-list me-2"></i> Entrenamientos</a></li>
            <li class="nav-item"><a href="index.php?action=ver_biblioteca" class="nav-item-custom active"><i class="fas fa-book me-2"></i> Biblioteca</a></li>
            <li class="nav-item"><a href="index.php?action=registrar_entrenamiento" class="nav-item-custom"><i class="fas fa-plus-circle me-2"></i> Registrar Sesión</a></li>
            <li class="nav-item mt-auto"><a href="index.php?action=logout" class="nav-item-custom nav-logout"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="panel-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold m-0">Biblioteca de Sesiones</h2>
                <p class="text-muted small">Tus entrenamientos maestros</p>
            </div>
            <a href="index.php?action=registrar_entrenamiento" class="btn-custom text-decoration-none">
                <i class="fas fa-plus me-2"></i> Nueva Plantilla
            </a>
        </header>

        <div class="row">
            <?php if (!empty($biblioteca)): ?>
                <?php foreach ($biblioteca as $sesion): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card-figma h-100 shadow-sm border-top border-primary border-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary-light text-primary"><?php echo htmlspecialchars($sesion['tipo_entrenamiento']); ?></span>
                                <button class="btn btn-sm btn-outline-warning border-0" 
                                        onclick="abrirModalEditarPlantilla(<?php echo htmlspecialchars(json_encode($sesion)); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            
                            <h5 class="fw-bold text-dark"><?php echo htmlspecialchars($sesion['tipo_entrenamiento']); ?></h5>
                            <p class="text-muted small" style="min-height: 40px;"><?php echo nl2br(htmlspecialchars($sesion['observaciones'])); ?></p>
                            
                            <div class="mt-auto pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold text-primary"><?php echo $sesion['distancia']; ?> km</span>
                                    <span class="text-muted small"><?php echo $sesion['duracion']; ?> min</span>
                                </div>
                                <button type="button" class="btn-custom w-100" 
                                        onclick="abrirModalAsignar(<?php echo htmlspecialchars(json_encode($sesion)); ?>)">
                                    <i class="fas fa-user-plus me-2"></i> Asignar a Atleta
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-book-open fa-3x mb-3 text-muted"></i>
                    <p class="text-muted">No hay plantillas guardadas.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<div class="modal fade" id="modalEditarPlantilla" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <form action="index.php?action=editar_entrenamiento" method="POST">
                <input type="hidden" name="id" id="edit_plt_id">
                <input type="hidden" name="atleta_id" value=""> <input type="hidden" name="fecha" id="edit_plt_fecha"> <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="fas fa-edit me-2"></i>Editar Plantilla Maestra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label-figma">Tipo de Entrenamiento</label>
                            <input type="text" name="tipo_entrenamiento" id="edit_plt_tipo" class="form-control-figma" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label-figma">Duración (min)</label>
                            <input type="number" name="duracion" id="edit_plt_duracion" class="form-control-figma" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label-figma">Distancia (km)</label>
                            <input type="number" step="0.01" name="distancia" id="edit_plt_distancia" class="form-control-figma">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="label-figma">Observaciones Técnicas</label>
                            <textarea name="observaciones" id="edit_plt_obs" class="form-control-figma" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn-custom">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Función para llenar el modal de edición de plantilla
function abrirModalEditarPlantilla(sesion) {
    document.getElementById('edit_plt_id').value = sesion.id;
    document.getElementById('edit_plt_tipo').value = sesion.tipo_entrenamiento;
    document.getElementById('edit_plt_duracion').value = sesion.duracion;
    document.getElementById('edit_plt_distancia').value = sesion.distancia;
    document.getElementById('edit_plt_obs').value = sesion.observaciones;
    document.getElementById('edit_plt_fecha').value = sesion.fecha; // Mantenemos la fecha original de creación

    new bootstrap.Modal(document.getElementById('modalEditarPlantilla')).show();
}

function abrirModalAsignar(sesion) {
    document.getElementById('titulo_sesion').innerText = sesion.tipo_entrenamiento;
    document.getElementById('asig_tipo').value = sesion.tipo_entrenamiento;
    document.getElementById('asig_duracion').value = sesion.duracion;
    document.getElementById('asig_distancia').value = sesion.distancia;
    document.getElementById('asig_obs').value = sesion.observaciones;
    
    new bootstrap.Modal(document.getElementById('modalAsignar')).show();
}
</script>

<?php include 'views/layouts/footer.php'; ?>