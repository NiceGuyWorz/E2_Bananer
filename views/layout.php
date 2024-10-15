<?php
// views/layout.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Aplicación Académica'; ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Aplicación Académica</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <nav>
                <ul>
                    <li><a href="../controllers/ReportController.php">Menú Principal</a></li>
                    <li><a href="../controllers/AuthController.php?action=logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </header>

    <main>
        <?php
        // This is where the content of each view will be injected.
        // In your views, you include this layout and set the content accordingly.
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Universidad XYZ</p>
    </footer>
</body>
</html>
