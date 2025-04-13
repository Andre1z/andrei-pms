<?php
// register_user.php

// Incluir conexión a la base de datos
include_once("config/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encriptar contraseña
    $rol = $_POST["rol"];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre_usuario, email, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre_usuario, $email, $password, $rol);

    if ($stmt->execute()) {
        echo "Usuario registrado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registrar un nuevo usuario</h1>
    <form method="POST" action="">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="admin">Admin</option>
            <option value="operador">Operador</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>