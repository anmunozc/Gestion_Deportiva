<?php include 'views/layouts/header.php'; ?>

<div class="dashboard-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0">Patín Carrera</h4>
        </div>
        <ul class="nav flex-column nav-menu">
            <li class="nav-item">
                <a href="index.php?action=panel_entrenador" class="nav-item-custom">
                    <i class="fas fa-home me-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=ver_entrenamientos" class="nav-item-custom active">
                    <i class="fas fa-list me-2"></i> Entrenamientos
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=ver_biblioteca" class="nav-item-custom">
                    <i class="fas fa-book me-2"></i> Biblioteca
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=gestionar_atletas" class="nav-item-custom">
                    <i class="fas fa-users me-2"></i> Mi Equipo
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=registrar_entrenamiento" class="nav-item-custom">
                    <i class="fas fa-plus-circle me-2"></i> Registrar Sesión
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a href="index.php?action=logout" class="nav-item-custom nav-logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="panel-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold m-0">Historial de Sesiones</h2>
                <p class="text-muted small">Registro detallado de actividades por atleta</p>
            </div>
            <a href="index.php?action=registrar_entrenamiento" class="btn-custom text-decoration-none">
                <i class="fas fa-plus me-2"></i> Nueva Sesión
            </a>
        </header>

        <div class="card-figma shadow-sm">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Atleta</th> 
                            <th>Tipo</th>
                            <th>Duración</th>
                            <th>Distancia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lista)): ?>
                            <?php foreach ($lista as $entrenamiento): 
                                // Omitir plantillas (atleta_id NULL) de esta vista si prefieres que solo se vean en la biblioteca
                                if($entrenamiento['atleta_id'] == null) continue; 
                            ?>
                            <tr>
                                <td class="fw-bold text-dark">
                                    <?php echo date('d/m/Y', strtotime($entrenamiento['fecha'])); ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-light border rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                            <i class="fas fa-user text-muted" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <span class="fw-medium"><?php echo htmlspecialchars($entrenamiento['nombre_atleta']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border py-2 px-3">
                                        <?php echo htmlspecialchars($entrenamiento['tipo_entrenamiento']); ?>
                                    </span>
                                </td>
                                <td><?php echo $entrenamiento['duracion']; ?> min</td>
                                <td><?php echo $entrenamiento['distancia']; ?> km</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-light border" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetalle<?php echo $entrenamiento['id']; ?>"
                                                title="Ver Notas">
                                            <i class="fas fa-eye text-primary"></i>
                                        </button>
                                        
                                        <button type="button" class="btn btn-sm btn-light border" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditar<?php echo $entrenamiento['id']; ?>"
                                                title="Modificar">
                                            <i class="fas fa-edit text-warning"></i>
                                        </button>
                                    </div>

                                    <div class="modal fade" id="modalDetalle<?php echo $entrenamiento['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="fw-bold">Detalle de la Sesión</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <span class="label-figma">Atleta Asignado</span>
                                                        <p class="fw-bold text-primary"><?php echo htmlspecialchars($entrenamiento['nombre_atleta']); ?></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <span class="label-figma">Tipo de Entrenamiento</span>
                                                        <p class="fw-bold"><?php echo htmlspecialchars($entrenamiento['tipo_entrenamiento']); ?></p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <span class="label-figma">Observaciones Técnicas</span>
                                                        <div class="p-3 mt-1 rounded bg-light" style="white-space: pre-wrap; font-size: 0.9rem; color: #4a5a70; border: 1px solid #e2e8f0;">
                                                            <?php echo !empty($entrenamiento['observaciones']) ? htmlspecialchars($entrenamiento['observaciones']) : 'No hay observaciones.'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn-custom w-100" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalEditar<?php echo $entrenamiento['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                                <form action="index.php?action=editar_entrenamiento" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $entrenamiento['id']; ?>">
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="fw-bold">Editar Registro</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="label-figma">Reasignar Atleta</label>
                                                            <select name="atleta_id" class="form-control-figma" required>
                                                                <?php foreach ($atletas as $atleta): ?>
                                                                    <option value="<?php echo $atleta['id']; ?>" <?php echo ($atleta['id'] == $entrenamiento['atleta_id']) ? 'selected' : ''; ?>>
                                                                        <?php echo htmlspecialchars($atleta['nombre']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="label-figma">Fecha</label>
                                                                <input type="date" name="fecha" class="form-control-figma" value="<?php echo $entrenamiento['fecha']; ?>" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="label-figma">Duración (min)</label>
                                                                <input type="number" name="duracion" class="form-control-figma" value="<?php echo $entrenamiento['duracion']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="label-figma">Distancia (km)</label>
                                                                <input type="number" step="0.01" name="distancia" class="form-control-figma" value="<?php echo $entrenamiento['distancia']; ?>">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="label-figma">Tipo de Entrenamiento</label>
                                                                <input type="text" name="tipo_entrenamiento" class="form-control-figma" value="<?php echo htmlspecialchars($entrenamiento['tipo_entrenamiento']); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-0">
                                                            <label class="label-figma">Observaciones Técnicas</label>
                                                            <textarea name="observaciones" class="form-control-figma" rows="4"><?php echo htmlspecialchars($entrenamiento['observaciones']); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn-custom">Actualizar Datos</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                    No hay entrenamientos asignados aún.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php include 'views/layouts/footer.php'; ?>