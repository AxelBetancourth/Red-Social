<?php
session_start();

$nombre_usuario = $_POST["nombre_usuario"];
$password_reg = $_POST["password_reg"];

$conn = new mysqli("localhost", "root", "", "ecovida");

// Utilizamos una sentencia preparada para evitar inyección SQL
$consulta = "SELECT * FROM registro WHERE nombre_usuario = ? and password_reg = ?";
$stmt = $conn->prepare($consulta);
$stmt->bind_param("ss", $nombre_usuario, $password_reg);
$stmt->execute();
$resultado = $stmt->get_result();

$filas = mysqli_num_rows($resultado);

if ($filas) {
    $_SESSION['nombre_usuario'] = $nombre_usuario; // Guardar el nombre de usuario en la variable de sesión
    header("Location: feedback.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}

$stmt->close();
$conn->close();
