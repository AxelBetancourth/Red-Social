<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ecovida");
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    $query = "SELECT * FROM registro WHERE id = $usuario_id";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $nombre = $usuario['nombre'];
        $apellido = $usuario['apellido'];
        $nombre_usuario = $usuario['nombre_usuario'];
        $correo = $usuario['correo'];
    } else {
        echo "Usuario no encontrado o no registrado.";
    }
} else {
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi perfil</title>
    <link rel="stylesheet" href="profile.css" />
</head>

<body>
    <a href="feedback.php">
        <button class="button">
            <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                <g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5">
                    <path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path>
                    <path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path>
                </g>
            </svg>
            <span class="lable">Regresar</span>
        </button>
    </a>
    </header>

    <main class="contenido-perfil">

        <?php
        // Consulta para obtener todas las publicaciones
        $sql = "SELECT * FROM publicaciones";
        $result = $conn->query($sql);

        // Si hay resultados, imprimirlos en la página
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="publicacion">';
                echo '<h3>' . $row['titulo'] . '</h3>';
                echo '<p class="content-summary">' . $row['contenido'] . '</p>';
                echo '<img width=" 200px"  height=" 200px"  src="backend/imagenes/' . $row['imagen'] . '" alt="">';
                echo '<div id="' . $row['id'] . '" class="content-full">' . $row['contenido'] . '</div>'; // Contenido completo oculto

                echo " <br>";
                echo '<a href="#" onclick="toggleContent(\'' . $row['id'] . '\', \'button_' . $row['id'] . '\')" id="button_' . $row['id'] . '" class="enlace-ver-mas"><i class="bx bx-down-arrow-alt"></i> Ver menos</a>';
                echo '</div>';
            }
        } else {
            echo "No hay publicaciones";
        }
        $conn->close();
        ?>
        <br>
        <br>
        <br>

    </main>
</body>

</html>