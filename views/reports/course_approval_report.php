<?php
// views/reports/course_approval_report.php
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
    <title>Reporte de Porcentaje de Aprobación por Curso y Período</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Reporte de Porcentaje de Aprobación por Curso y Período</h2>

    <?php if (isset($data) && !empty($data)): ?>
        <table border="1">
            <tr>
                <th>Código del Curso</th>
                <th>Nombre del Curso</th>
                <th>Profesor</th>
                <th>Porcentaje de Aprobación (%)</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Codigo_Curso']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nombre_Curso']); ?></td>
                    <td><?php echo htmlspecialchars($row['Profesor']); ?></td>
                    <td><?php echo number_format($row['Porcentaje_Aprobacion'], 2); ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($period)): ?>
        <p>No hay datos disponibles para el período <?php echo htmlspecialchars($period); ?>.</p>
    <?php else: ?>
        <p>No se ha especificado un período.</p>
    <?php endif; ?>

    <a href="../controllers/ReportController.php?action=course_approval_period">Consultar otro período</a><br>
    <a href="../controllers/ReportController.php">Volver al Menú</a>
</body>
</html>
