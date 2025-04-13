<?php
// admin_panel.php

// Incluir la conexión a la base de datos
include_once("config/db_connection.php");

// Consultar todos los usuarios
$sql = "SELECT id, nombre_usuario, email, rol, creado_en FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Panel de Administración</h1>
    <h2>Gestión de Usuarios</h2>

    <!-- Tabla para mostrar usuarios -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre_usuario"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["rol"] . "</td>
                        <td>" . $row["creado_en"] . "</td>
                        <td>
                            <a href='edit_user.php?id=" . $row["id"] . "'>Editar</a> |
                            <a href='delete_user.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\");'>Eliminar</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay usuarios registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>