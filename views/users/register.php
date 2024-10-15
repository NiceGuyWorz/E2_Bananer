<?php
// views/users/register.php
session_start();

// Ensure the user is authenticated and is 'bananer@lamejor.com'
if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== 'bananer@lamejor.com') {
    header('Location: ../controllers/AuthController.php?action=login');
    exit();
}

// Include any necessary files or configurations
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Usuario - Bananer</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <div class="registration-container">
        <h2>Registrar Nuevo Usuario - Bananer</h2>
        <?php if (isset($success)): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="../controllers/UserController.php?action=register" method="post">
            <div class="form-group">
                <label for="email">Correo Institucional:</label>
                <input type="email" name="email" id="email" required placeholder="email@institucion.edu">
            </div>
            <div class="form-group">
                <label for="password">Clave:</label>
                <input type="password" name="password" id="password" required placeholder="Mínimo 8 caracteres alfanuméricos">
            </div>
            <div class="form-group">
                <label for="role">Rol:</label>
                <select name="role" id="role" required>
                    <option value="">Seleccione un rol</option>
                    <option value="professor">Profesor</option>
                    <option value="administrative">Administrativo</option>
                </select>
            </div>
            <button type="submit" class="btn">Registrar Usuario</button>
        </form>
        <a href="../controllers/ReportController.php">Volver al Menú</a>
    </div>
</body>
</html>
