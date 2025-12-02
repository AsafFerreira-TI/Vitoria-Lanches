<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Cadastrar-se</title>
    <link rel="stylesheet" href="../style/main_styles/signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST" align="center" id="signup_user_form">
        <h1 id="titulo">Cadastrar-se</h1>
        <input name="email" type="email" placeholder="Insira seu e-mail" class="input" required><br><br>
        <input name="senha" type="password" placeholder="Nova senha" class="input" required><br><br>
        <input name="senha_confirm" type="password" placeholder="Confirme sua senha" class="input" required><br><br>
        <input name="btn_confirm" type="submit" value="Confirmar" id="btn_signup"><br>
    </form>

    <?php
        if(isset($_POST["btn_confirm"])){
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $senha_confirmacao = $_POST["senha_confirm"];
            session_start();

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if($senha == $senha_confirmacao){

                    include ('../database/config.php');

                    $insert_user = "INSERT INTO TB_USUARIO (EMAIL_TB_USUARIO, SENHA_TB_USUARIO, TIPO_TB_USUARIO) VALUES ('$email', '$senha', 'CLIENTE');";

                    if ($conn->query($insert_user)) {
                        echo "<p id='cad_user_sucess' align='center'>Sucesso!</p>";

                        $_SESSION['EMAIL'] = $email;

                        $conn->close();

                        header("Location: create_client_data.php");
                        exit();

                    } else {
                        echo "<p id='error_connection' class='alert' align='center'>Algo deu errado. Verifique os valores e tente novamente</p>";
                    }

                } else {
                    echo "<p id='error_password' align='center' class='alert'>As senhas não correspondem. Tente novamente.</p>";
                }
            } else {
                echo "<p id='error_email' align='center' class='alert'>E-mail inválido</p>";
            }
        }
    ?>

    <button id="btn_voltar"><a href="main.php">Voltar à Página Principal</a></button>
</body>
</html>

