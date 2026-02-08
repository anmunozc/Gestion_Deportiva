<?php include 'views/layouts/header.php'; ?>

<div class="dashboard-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0">Patín Carrera</h4>
        </div>
        <ul class="nav flex-column nav-menu">
            <li class="nav-item"><a href="index.php?action=panel_entrenador" class="nav-item-custom"><i class="fas fa-home me-2"></i> Inicio</a></li>
            <li class="nav-item"><a href="index.php?action=ver_entrenamientos" class="nav-item-custom"><i class="fas fa-list me-2"></i> Entrenamientos</a></li>
            <li class="nav-item"><a href="index.php?action=ver_biblioteca" class="nav-item-custom"><i class="fas fa-book me-2"></i> Biblioteca</a></li>
            <li class="nav-item"><a href="index.php?action=registrar_entrenamiento" class="nav-item-custom active"><i class="fas fa-plus-circle me-2"></i> Registrar Sesión</a></li>
            <li class="nav-item mt-auto"><a href="index.php?action=logout" class="nav-item-custom nav-logout"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="panel-header">
            <h2 class="fw-bold m-0">Nueva Sesión</h2>
            <p class="text-muted small">Crea un entrenamiento para un atleta o guárdalo en la biblioteca</p>
        </header>

        <div class="card-figma shadow-sm">
            <form action="index.php?action=guardar_entrenamiento" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="label-figma text-primary fw-bold">Asignar a Atleta (Opcional)</label>
                        <select name="atleta_id" class="form-control-figma border-primary">
                            <option value="">-- DEJAR VACÍO PARA GUARDAR EN BIBLIOTECA --</option>
                            <?php foreach ($atletas as $atleta): ?>
                                <option value="<?php echo $atleta['id']; ?>">
                                    <?php echo htmlspecialchars($atleta['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Si no seleccionas un atleta, se guardará como una "Sesión Maestra" en tu biblioteca.</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="label-figma">Fecha</label>
                        <input type="date" name="fecha" class="form-control-figma" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="label-figma">Duración (min)</label>
                        <input type="number" name="duracion" class="form-control-figma" placeholder="Ej: 60" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="label-figma">Distancia (km)</label>
                        <input type="number" step="0.01" name="distancia" class="form-control-figma" placeholder="Ej: 15.5">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="label-figma">Tipo de Entrenamiento</label>
                        <input type="text" name="tipo_entrenamiento" class="form-control-figma" placeholder="Ej: Fondo, Intervalos, Técnica..." required>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="label-figma">Observaciones / Descripción del trabajo</label>
                        <textarea name="observaciones" class="form-control-figma" rows="5" placeholder="Describe las series, ritmos o ejercicios..."></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="index.php?action=ver_biblioteca" class="btn btn-light border">Cancelar</a>
                    <button type="submit" class="btn-custom">
                        <i class="fas fa-save me-2"></i> Guardar Registro
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include 'views/layouts/footer.php'; ?>