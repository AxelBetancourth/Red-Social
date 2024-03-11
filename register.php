<?php
$mensajeExito = '';
$mensajeError = '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="register.css" />
</head>

<body>
    <main>
        <section class="container">
            <form action="register.php" method="post" class="form">
                <p class="title">Registro</p>
                <p class="message">
                    Regístrate ahora y obtén acceso completo a nuestra Red Social
                    Ecológica.
                </p>
                <div class="flex">
                    <label style="padding-right: 20px">
                        <input required="" placeholder="Nombre" type="text" name="nombre" class="input" />
                    </label>

                    <label style="padding-right: 5px">
                        <input required="" placeholder="Apellido" type="text" name="apellido" class="input" />
                    </label>
                </div>

                <label style="padding-right: 5px">
                    <input required="" placeholder="Nombre de Usuario" type="text" name="nombre_usuario" class="input" />
                </label>
                </div>

                <label style="padding-right: 5px">
                    <input required="" placeholder="Correo Electronico" type="email" name="email" class="input" />
                </label>

                <label style="padding-right: 5px">
                    <input required="" placeholder="Contraseña" type="password" name="password_reg" class="input" />
                </label>
                <button class="submit">Enviar</button>
                <p class="signin">
                    ¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a>
                </p>
                <br>
                <?php if ($mensajeExito !== '') : ?>
                    <p style="color: green;"><?php echo $mensajeExito; ?></p>
                <?php endif; ?>

                <?php if ($mensajeError !== '') : ?>
                    <p style="color: red;"><?php echo $mensajeError; ?></p>
                <?php endif; ?>
            </form>
            <br>
        </section>
    </main>
</body>

</html>

<?php

$conn = new mysqli("localhost", "root", "", "ecovida");
$conn->select_db("ecovida");

if ($_POST) {

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo = $_POST["email"];
    $password_reg = $_POST["password_reg"];
    // $confirmar_password = $_POST["confirmar_password"];

    $consulta = "INSERT INTO registro (nombre, apellido, nombre_usuario, correo, password_reg) 
    VALUES ('$nombre', '$apellido', '$nombre_usuario', '$correo', '$password_reg')";

    if ($conn->query($consulta) === TRUE) {
        $mensajeExito = "Datos enviados correctamente.";
    } else {
        $mensajeError = "Error al enviar los datos.";
    }
}

?>