<?php include 'views/layouts/header.php'; ?>

<?php
// 1. Procesar datos para las tarjetas
$totalAtletas = count($atletas);

// Procesar cantidad de plantillas (opcional, si quieres mostrarlo en una tarjeta)
// $totalPlantillas = count($plantillas); 

// 2. Procesar datos para el gráfico
$labels = [];
$minutos = [];

if (!empty($resumenSemanal)) {
    foreach ($resumenSemanal as $dato) {
        $labels[] = date('d/m', strtotime($dato['dia']));
        $minutos[] = $dato['total_minutos'];
    }
} else {
    $labels = ['Sin datos'];
    $minutos = [0];
}
?>

<div class="dashboard-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0">Patín Carrera</h4>
        </div>
        <ul class="nav flex-column nav-menu">
            <li class="nav-item">
                <a href="index.php?action=panel_entrenador" class="nav-item-custom active">
                    <i class="fas fa-home me-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?action=ver_entrenamientos" class="nav-item-custom">
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
        <header class="panel-header">
            <div>
                <h2 class="fw-bold m-0">Dashboard</h2>
                <p class="text-muted small">Resumen de actividad reciente</p>
            </div>
            <div class="user-greeting">
                <i class="fas fa-user-circle me-2" style="color: var(--azul-pizarra);"></i>
                <span><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
            </div>
        </header>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card-figma border-start border-primary border-4 shadow-sm">
                    <h6 class="text-muted small text-uppercase fw-bold">Atletas Activos</h6>
                    <h3 class="fw-bold m-0"><?php echo $totalAtletas; ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-figma border-start border-warning border-4 shadow-sm">
                    <h6 class="text-muted small text-uppercase fw-bold">Biblioteca</h6>
                    <p class="m-0 text-muted small">Sesiones guardadas para asignar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-figma border-start border-success border-4 shadow-sm">
                    <h6 class="text-muted small text-uppercase fw-bold">Estado del Equipo</h6>
                    <h3 class="fw-bold m-0 text-success">Activo</h3>
                </div>
            </div>
        </div>

        <div class="card-figma shadow-sm">
            <h5 class="card-title-figma">Carga de Entrenamiento Semanal (Minutos)</h5>
            <div style="height: 300px;">
                <canvas id="graficoProgreso"></canvas>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoProgreso').getContext('2d');
    
    const labelsReal = <?php echo json_encode($labels); ?>;
    const datosReal = <?php echo json_encode($minutos); ?>;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelsReal,
            datasets: [{
                label: 'Minutos Totales',
                data: datosReal,
                fill: true,
                backgroundColor: 'rgba(93, 109, 133, 0.1)',
                borderColor: 'rgb(93, 109, 133)',
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 8,
                pointBackgroundColor: 'rgb(93, 109, 133)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#edf2f7' },
                    title: { display: true, text: 'Minutos' }
                },
                x: { 
                    grid: { display: false } 
                }
            }
        }
    });
</script>

<?php include 'views/layouts/footer.php'; ?>