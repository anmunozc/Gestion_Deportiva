<?php include 'views/layouts/header.php'; ?>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card-figma" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <div style="background: var(--azul-pizarra); color: white; width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">
                <i class="fas fa-skating"></i>
            </div>
            <h3 class="mt-3 fw-bold">Bienvenido</h3>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger p-2 small text-center">Credenciales incorrectas</div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login">
            <div class="mb-3">
                <label class="form-label small">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label small">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-custom w-100">Ingresar</button>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>