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
                <a href="index.php?action=ver_entrenamientos" class="nav-item-custom">
                    <i class="fas fa-list me-2"></i> Entrenamientos
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=gestionar_atletas" class="nav-item-custom active">
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
                <h2 class="fw-bold m-0">Mi Equipo</h2>
                <p class="text-muted small">Administra a los atletas de tu club</p>
            </div>
            <button class="btn-custom" data-bs-toggle="modal" data-bs-target="#modalNuevoAtleta">
                <i class="fas fa-user-plus me-2"></i> Nuevo Atleta
            </button>
        </header>

        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
                <i class="fas fa-check-circle me-2"></i> Atleta registrado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card-figma">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($atletas)): ?>
                            <?php foreach($atletas as $at): ?>
                            <tr>
                                <td class="fw-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">
                                            <?php echo strtoupper(substr($at['nombre'] ?? 'A', 0, 1)); ?>
                                        </div>
                                        <?php echo htmlspecialchars($at['nombre']); ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($at['email']); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border me-1" title="Editar datos">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    
                                    <button class="btn btn-sm btn-light border opacity-50" title="Borrado inhabilitado para preservar historial" style="cursor: not-allowed;">
                                        <i class="fas fa-trash text-muted"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <i class="fas fa-users-slash d-block mb-2 text-muted" style="font-size: 2rem;"></i>
                                    <p class="text-muted">No tienes atletas registrados aún.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalNuevoAtleta" tabindex="-1" aria-labelledby="modalAtletaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <form action="index.php?action=registrar_atleta" method="POST">
                <div class="modal-header border-0">
                    <h5 class="fw-bold m-0" id="modalAtletaLabel">Registrar Nuevo Atleta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="label-figma">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control-figma" placeholder="Ej: Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label class="label-figma">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control-figma" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="label-figma">Contraseña Temporal</label>
                        <input type="password" name="password" class="form-control-figma" placeholder="Mínimo 6 caracteres" required>
                        <small class="text-muted">El atleta podrá cambiarla al iniciar sesión.</small>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light w-100 mb-2" data-bs-dismiss="modal" style="border-radius: 10px;">Cancelar</button>
                    <button type="submit" class="btn-custom w-100 m-0">Crear Cuenta de Atleta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        width: 32px;
        height: 32px;
        background-color: #5d6d85; /* Azul pizarra de tu paleta */
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .opacity-50 {
        opacity: 0.5;
    }
</style>

<?php include 'views/layouts/footer.php'; ?>