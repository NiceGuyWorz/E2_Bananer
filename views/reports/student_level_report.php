<?php
// views/reports/student_level_report.php
session_start();

// Ensure the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: ../controllers/AuthController.php?action=login');
    exit();
}

// Include header and navigation if applicable
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Estudiantes Dentro y Fuera de Nivel</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Reporte de Estudiantes Dentro y Fuera de Nivel</h2>

    <?php if (isset($data)): ?>
        <table border="1">
            <tr>
                <th>Total de Estudiantes Vigentes</th>
                <th>Dentro de Nivel</th>
                <th>Fuera de Nivel</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($data['total_estudiantes']); ?></td>
                <td><?php echo htmlspecialchars($data['dentro_nivel']); ?></td>
                <td><?php echo htmlspecialchars($data['fuera_nivel']); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>No hay datos disponibles para mostrar.</p>
    <?php endif; ?>

    <a href="../controllers/ReportController.php">Volver al Menú</a>
</body>
</html>
