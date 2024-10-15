<?php
// views/auth/login.php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: ../controllers/ReportController.php');
    exit();
}

// Include any necessary files or configurations
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="../controllers/AuthController.php?action=login" method="post">
            <div class="form-group">
                <label for="email">Correo Institucional:</label>
                <input type="email" name="email" id="email" required placeholder="email@institucion.edu">
            </div>
            <div class="form-group">
                <label for="password">Clave:</label>
                <input type="password" name="password" id="password" required placeholder="Ingrese su clave">
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
    </div>
</body>
</html>
