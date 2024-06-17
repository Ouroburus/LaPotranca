<div class="main-container">

    <form class="box login" action="" method="POST" autocomplete="off" >
    	<p class="has-text-centered">
            <i class="fas fa-user-circle fa-5x"></i>
        </p>
		<h5 class="title is-5 has-text-centered">Inicia sesión con tu cuenta</h5>

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				$insLogin->iniciarSesionControlador();
			}
		?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        body {
            background-color: #03111B;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #2E3A42;
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(4, 6, 8, 0.5);
            max-width: 1100px;
            width: 100%;
            display: flex;
        }
        .login-container .field {
            margin-bottom: 2.1rem;
        }
        .login-container .label {
            font-weight: bold;
            display: flex;
            align-items: center;
            color: #ffffff;
        }
        .login-container .label i {
            font-size: 3rem;
            color: #000000;
            margin-right: 0.5rem;
        }
        .login-container .input {
            border-radius: 4px;
        }
        .login-container .button {
            width: 100%;
            padding: 1.00rem;
        }
        .login-image {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }
        .login-image img {
            max-width: 200%;
            border-radius: 8px;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5rem;
        }
        .logo-container img {
            max-width: 300px; /* Ajusta el tamaño máximo del logo */
            border-radius: 100%; /* Redondea el logo */
            box-shadow: 0 6px 20px rgba(1, 3, 0, 0.3); /* Agrega una sombra */
        }
		/*.input{
			padding: 1rem;
		}*/
		.img{
			flex: 50;
		}
	
    </style>
    <title>Login</title>
</head>
<body>

<div class="login-container">
    <div class="columns is-vcentered">
        <div class="column is-half">
            <form>
                <div class="field">
                    <label class="label"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
                    <div class="control">
                        <input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="300" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fas fa-key"></i> &nbsp; Clave</label>
                    <div class="control">
                        <input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="300" required>
                    </div>
                </div>

                <p class="has-text-centered mb-4 mt-3">
                    <button type="submit" class="button is-info is-rounded">LOG IN</button>
                </p>
            </form>
        </div>
		<div class="">
			<figure class="image mb-6" >
			  	<img class="is-rounded is-photo" src="<?php echo APP_URL; ?>app/views/fotos/img.png">
			</figure>
			</div>
	</div>
    </div>
</div>

</body>
</html>



