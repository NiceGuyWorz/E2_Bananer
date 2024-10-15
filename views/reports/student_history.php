<?php
// views/reports/student_history.php
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
    <title>Historial Académico del Estudiante</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Historial Académico del Estudiante</h2>

    <?php if (isset($studentData)): ?>
        <p><strong>Número de Estudiante:</strong> <?php echo htmlspecialchars($studentData['Numero_Estudiante']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($studentData['Nombres'] . ' ' . $studentData['Apellido_Paterno'] . ' ' . $studentData['Apellido_Materno']); ?></p>
        <p><strong>Estado:</strong> <?php echo htmlspecialchars($data['status']); ?></p>

        <?php if (!empty($data['history'])): ?>
            <?php foreach ($data['history'] as $period => $courses): ?>
                <h3>Período: <?php echo htmlspecialchars($period); ?></h3>
                <table border="1">
                    <tr>
                        <th>Código del Curso</th>
                        <th>Nombre del Curso</th>
                        <th>Nota</th>
                        <th>Calificación</th>
                        <th>Resultado</th>
                    </tr>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['Codigo_Curso']); ?></td>
                            <td><?php echo htmlspecialchars($course['Nombre_Curso']); ?></td>
                            <td><?php echo htmlspecialchars($course['Nota']); ?></td>
                            <td><?php echo htmlspecialchars($course['Calificacion']); ?></td>
                            <td><?php echo htmlspecialchars($course['Resultado']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <!-- Period Summary -->
                <p><strong>Resumen del Período:</strong></p>
                <ul>
                    <li>Cursos Aprobados: <?php echo $data['summaries'][$period]['approved']; ?></li>
                    <li>Cursos Reprobados: <?php echo $data['summaries'][$period]['failed']; ?></li>
                    <li>Cursos Vigentes: <?php echo $data['summaries'][$period]['current']; ?></li>
                    <li>Promedio del Período (PPS): <?php echo number_format($data['summaries'][$period]['pps'], 2); ?></li>
                </ul>
            <?php endforeach; ?>

            <!-- Overall Summary -->
            <h3>Resumen Total</h3>
            <ul>
                <li>Total de Cursos Aprobados: <?php echo $data['overallSummary']['approved']; ?></li>
                <li>Total de Cursos Reprobados: <?php echo $data['overallSummary']['failed']; ?></li>
                <li>Total de Cursos Vigentes: <?php echo $data['overallSummary']['current']; ?></li>
                <li>Promedio General (PPA): <?php echo number_format($data['overallSummary']['ppa'], 2); ?></li>
            </ul>
        <?php else: ?>
            <p>No hay registros académicos para este estudiante.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>No se encontró información para el número de estudiante proporcionado.</p>
    <?php endif; ?>

    <a href="../controllers/ReportController.php?action=academic_history">Consultar otro estudiante</a><br>
    <a href="../controllers/ReportController.php">Volver al Menú</a>
</body>
</html>
