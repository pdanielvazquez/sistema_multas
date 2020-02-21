<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('startbootstrap/materialize/css/materialize.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('startbootstrap/css/login.css') ?>">
    <title>Login</title>
</head>
<body>
    <div class="panel">
        <?php
            if(isset($msg)){
                echo "
                <div id='alerta'>
                    <p>$msg</p>
                </div>";
            }
        ?>
        <p id="title">
            Inicio de sesión
        </p>
        <form action="<?= base_url('login/verifica') ?>" method="post">
            
            <div class="input-field col s12">
                <input id="last_name" name="username" type="text" class="validate">
                <label for="last_name">Nombre de usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate">
                <label for="password">Contraseña</label>
            </div>
            
            <center>
                <button type="submit" class="btn boton">
                        Ingresar
                </button>
            </center>
        </form>
    </div>

    <script src="<?= base_url('startbootstrap/materialize/js/materialize.min.js') ?>"></script>
    <script>
        M.AutoInit();
    </script>

</body>

</html>