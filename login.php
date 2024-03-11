<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="login.css" />
    <style>
        .error-message {
            text-align: center;
            color: red;
            margin-top: 40%;
        }
    </style>
</head>

<body>
    <main>
        <section>
            <div class="login-box">
                <p>Iniciar sesión</p>
                <br />
                <form action="validate.php" method="post">
                    <div class="user-box">
                        <input required="" placeholder="Nombre de Usuario" name="nombre_usuario" type="text" />
                    </div>
                    <div class="user-box">
                        <input required="" placeholder="Contraseña" name="password_reg" type="password" />
                    </div>
                    <input type="submit" value="Enviar" style="background-color: #4169E1;color: #fff;padding: 10px 20px;text-decoration: none;display: inline-block;border-radius: 5px;">
                </form>
                <br />

                <p>
                    ¿No tienes una cuenta?
                    <a href="register.php" class="a2">¡Regístrate!</a>
                </p>
            </div>
        </section>
        <?php
        // Verificar si se ha proporcionado un error en la URL
        $error = isset($_GET['error']) ? $_GET['error'] : null;
        ?>

        <br>
        <?php
        if ($error === '1') {
            echo '<p class="error-message">Error en la autenticación. Por favor, verifica tus credenciales.</p>';
        }
        ?>
    </main>
</body>

</html>