<?php
session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];

// Establecer la conexión a la base de datos fuera del bloque de verificación POST
$conn = new mysqli("localhost", "root", "", "ecovida");
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Publicaciones</title>
    <link rel="stylesheet" href="feedback.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://unpkg.com/css.gg@2.0.0/icons/css/home.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="primero">
            <a href="index.html">
                <img src="img/ecovida2.png" alt="logo CrediBank" />
            </a>
        </div>

        <div class="segundo">
            <nav>
                <div class="icon">
                    <i class="gg-home"></i>
                    <a href="feedback.php">Home</a>
                </div>
                <div class="icon_2">
                    <img src="img/bx-male.svg" alt="" />
                    <a href="profile.php">Perfil</a>
                </div>
            </nav>
        </div>
    </header>
    <br />

    <!-- Agrega aquí el contenido del encabezado y el formulario de publicación -->
    <main class="contenido-publicaciones">
        <!-- Formulario para hacer una publicación -->
        <div class="hacer-publicacion">
            <h2>Hacer Publicación</h2>
            <form action="backend/subir.php" method="post" enctype="multipart/form-data">
                <div class="campo-publicacion">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required />
                </div>
                <div class="campo-publicacion">
                    <label for="contenido">Contenido:</label>
                    <textarea id="contenido" name="contenido" rows="4" required></textarea>
                </div>
                <div class="campo-publicacion">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" />
                </div>
                <button type="submit" name="publicar">Publicar</button>
            </form>
        </div>

        <!-- Publicaciones existentes -->
        <?php
        // Consulta para obtener todas las publicaciones
        $sql = "SELECT * FROM publicaciones";
        $result = $conn->query($sql);

        // Si hay resultados, imprimirlos en la página
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Imprimir cada publicación en la página
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

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
        <br>
        <br>
        <br>
    </main>

    <footer>
        <div class="container">
            <div class="footer-row">
                <div class="footer-links">
                    <h4>Enlaces útiles</h4>
                    <ul>
                        <li><a href="#">Publicaciones</a></li>
                        <li><a href="#">Grupos</a></li>
                        <li><a href="#">Eventos</a></li>
                        <li><a href="#">Ayuda</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Recursos</h4>
                    <ul>
                        <li><a href="#">Mi perfil</a></li>
                        <li><a href="#">Calendario</a></li>
                        <li><a href="#">Calculadora de huella ecológica</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="#">Preguntas frecuentes</a></li>
                        <li><a href="#">Soporte Técnico</a></li>
                        <li><a href="#">Términos y condiciones</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Síguenos</h4>
                    <div class="social-link">
                        <a href="#">
                            <img src="img/facebook.png" alt="logo Facebook" style="width: 40px; padding: 2px" />
                        </a>
                        <a href="#">
                            <img src="img/whatsapp.png" alt="logo Whatsapp" style="width: 40px; padding: 2px" />
                        </a>
                        <a href="#">
                            <img src="img/instagram.png" alt="logo Instagram" style="width: 40px; padding: 2px" />
                        </a>
                        <a href="#">
                            <img src="img/gmail.png" alt="logo Email" style="width: 40px; padding: 2px" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript para mostrar/ocultar contenido completo -->
    <script>
        function toggleContent(id, button) {
            var content = document.getElementById(id);
            var buttonText = document.getElementById(button);

            if (content.style.display === 'none') {
                content.style.display = 'block';
                buttonText.innerHTML = '<i class="bx bx-up-arrow-alt"></i> Ver menos';
            } else {
                content.style.display = 'none';
                buttonText.innerHTML = '<i class="bx bx-down-arrow-alt"></i> Ver más';
            }
        }
    </script>

</body>

</html>