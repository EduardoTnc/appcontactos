<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Contactos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- ESTILOS CSS -->
<style>
    *,
    *::after,
    *::before {
        font-family: Segoe UI;
        box-sizing: border-box;
    }

    body {
        margin: 0;
    }

    h1 {
        text-align: center;
        font-size: 35px;
        margin: 15px 0px 30px;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;

        background: url("paisaje.jpg") no-repeat;
        background-position: center;
        background-size: cover;
    }

    .form-section {
        color: rgb(255, 255, 255);
        max-width: 450px;
        margin: 0 auto;
        padding: 40px;

        background: rgba(0, 0, 0, 0.74);
        box-shadow: 0 0 0px rgba(0, 0, 0, 0.993);
        border-radius: 14px;
        backdrop-filter: blur(5px);
    }

    .form-box p {
        font-size: 18px;

        & input[type="checkbox"] {
            transform: scale(1.2);
        }
    }

    .form-box p input {
        margin-top: 10px;
    }

    .form-box input[type="text"],
    .form-box input[type="password"],
    .form-box input[type="email"] {
        width: 100%;
        padding: 6px;
        border-radius: 6px;
        border: 0 solid transparent;
    }

    .form-box button[type*="submit"] {
        margin: 5px 0px 20px 0px;
        width: 100%;
        padding: 10px;
        font-size: 18px;
        background-color: #327cf1;
        color: white;
        border: 0;
        border-radius: 6px;
        transition: background-color 0.4s, color 0.4s;
    }

    .form-box button[type="submit"]:hover {
        color: white;
        background-color: #0174cb;
        transition: background-color 0.4s, color 0.4s;
    }

    .form-box input[name="info"]:first-child {
        margin-top: 30px;
    }

    /* Div con Mensaje de envio */
    #mensaje-envio {
        position: absolute;

        background-color: white;
        color: black;
        border-radius: 16px;
        padding: 12px;
        box-shadow: 0 0px 5px rgba(0, 0, 0, 0.233);
        opacity: 0;

        transition: opacity .30s;
    }

    /* Video-background */
    /* #fondo-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    } */

    #login-form {
        display: none;
    }

    .login {
        transform: translate(0%);
        transition: transform 1s;
    }

    .register {
        transform: translate(0%);
        transition: transform 1s;
    }

    .hide {
        position: absolute;
        transform: translateY(-300%);
        transition: transform 1s;
    }

    .cambioFormulario {
        display: flex;
        justify-content: center;
        align-items: center;

        & button {
            padding: 5px;
            border-radius: 5px;
            background-color: rgb(255, 255, 255);
            margin-left: 5px;
            border: 0px;
            font-size: 16px;
        }
    }

    .special-color {
        color: cornflowerblue;
        text-shadow: 2px 2px 3px rgb(0, 0, 0);
    }

    .alert-container {
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1050;
        width: 30%;
    }
</style>

<body>

    <!-- Contenedor de la alerta -->
    <div id="alert-container" class="alert-container"></div>

    <!-- <video src="fondo-video2.mp4" autoplay muted loop id="fondo-video"></video> -->

    <section class="form-container">

        <div class="form-section  login" id="login-box">
            <form action="../controllers/authController.php?action=login" method="POST" class="form-box">

                <h1>APP CONTACTOS <span class="special-color">INICIO DE SESIÓN</span></h1>
                <p>Correo :<input type="email" name="email" id="email-login" maxlength="50" required /></p>
                <p>Contraseña :<input type="password" name="password" id="password-login" maxlength="50" required /></p>
                <button type="submit" class="boton-enviar">Ingresar</button>

                <section class="cambioFormulario">
                    ¿No tienes una cuenta? →
                    <button type="button" id="sign-up">Registrarse</button>
                </section>

            </form>

        </div>

        <div class="form-section hide register" id="form-box">
            <form action="../controllers/authController.php?action=register" method="POST" class="form-box">

                <h1>APP CONTACTOS <span class="special-color">REGISTRO</span></h1>

                <p>Ingresa tu nombre de usuario:<input type="text" name="nombre" id="nombre" maxlength="60" required /></p>
                <p>Ingresa tu correo:<input type="email" name="email" id="email-register" maxlength="60" required /></p>
                <p>Crea tu contraseña:<input type="password" name="password" id="password-register" maxlength="50" required /></p>
                <p>
                    <input type="checkbox" name="info" checked="checked" />
                    Deseo recibir información sobre novedades y ofertas.
                </p>
                <p>
                    <input type="checkbox" name="condiciones" required /> Declaro haber leído y
                    aceptado las condiciones generales del programa y la normativa sobre
                    protección de datos.
                </p>
                <button type="submit" class="boton-enviar">Registrarse</button>
                <section class="cambioFormulario">
                    ¿Ya tienes una cuenta? →
                    <button type="button" id="sign-in">Iniciar Sesión</button>
                </section>
            </form>
        </div>


    </section>
</body>

<!-- Incluyendo jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluir Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- SCRIPT JS PARA CAMBIAR ENTRE FORMULARIOS DE REGISTRO Y INICIO DE SESIÓN -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const btnSignIn = document.getElementById("sign-in"),
            btnSignUp = document.getElementById("sign-up"),
            formRegister = document.querySelector(".register"),
            formLogin = document.querySelector(".login");

        btnSignIn.addEventListener("click", e => {
            formRegister.classList.add("hide");
            formLogin.classList.remove("hide");
        })

        btnSignUp.addEventListener("click", e => {
            formLogin.classList.add("hide");
            formRegister.classList.remove("hide");
        })
    });
</script>

<!-- SCRIPT JS PARA ALERTA DE CREDENCIALES INCORRECTAS o ERROR AL REGISTRARSE-->
<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['mensaje'])) : ?>
            var errorMessage = "<?php echo $_SESSION['mensaje'];
                                unset($_SESSION['mensaje']); ?>";
            var alertaHTML = `
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    ${errorMessage}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('#alert-container').html(alertaHTML);

            // Desvanecer la alerta después de 3 segundos
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000); // 3 segundos
        <?php endif; ?>
    });
</script>