<?php
// edit_user.php

include_once("config/db_connection.php");

// Verificar si se recibió el ID del usuario
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("Usuario no encontrado.");
    }
}

// Actualizar los datos del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $email = $_POST["email"];
    $rol = $_POST["rol"];

    $sql = "UPDATE usuarios SET nombre_usuario = ?, email = ?, rol = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre_usuario, $email, $rol, $id);

    if ($stmt->execute()) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST" action="">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo $user['nombre_usuario']; ?>" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="admin" <?php if ($user['rol'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="operador" <?php if ($user['rol'] == 'operador') echo 'selected'; ?>>Operador</option>
        </select><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>