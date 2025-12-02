<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Login como Administrador</title>
    <link rel="stylesheet" href="../style/main_styles/login_admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST" align="center" id="login_admin_form">
        <h1 id="titulo">Login como Administrador</h1>

        <input name="e-mail" type="email" placeholder="E-mail" id="input_email" class="input" required><br><br>
        <input name="senha" type="password" placeholder="Senha" id="input_senha" class="input" required><br><br>
        <input name="cpf_cnpj" type="text" placeholder="Digite seu CPF/CNPJ" id="input_cpf_cnpj" class="input" required><br><br>
        <input type="submit" name="btn_login" value="Login" id="btn_login"><br><br>

    </form>

    <?php
        if(isset($_POST['btn_login'])){

            $email = $_POST['e-mail'];
            $senha = $_POST['senha'];
            $cpf_cnpj = $_POST['cpf_cnpj'];

            include ("../database/config.php");

            $select_user = "SELECT * FROM TB_USUARIO WHERE EMAIL_TB_USUARIO = '$email' AND SENHA_TB_USUARIO = '$senha' AND CPF_CNPJ_TB_USUARIO = '$cpf_cnpj';";
            $retorno_usuario = $conn -> query($select_user);
            $dados_user = $retorno_usuario -> fetch_assoc();

            if(mysqli_num_rows($retorno_usuario) == 1){
                // Soli Deo Gloria; Pausa para o Dia do Senhor!
                // VOLTEI. 29/09/2025

                $id_usuario = $dados_user['ID_TB_USUARIO'];

                session_start();
                $dados_admin = [
                    "id_usuario" => $id_usuario,
                    "email" => $email,
                    "senha" => $senha,
                    "cpf_cnpj" => $cpf_cnpj
                ];

                $_SESSION['ADMIN'] = $dados_admin;
                header("Location: ../web/admin/home_admin.php");
                exit();
            } 
            else {
                echo "<p id='alert_no_user' align='center'>Usuário, senha ou CPF/CNPJ inválidos. Tente novamente.</p>";
            }
        }
    ?>
    <button id="btn_voltar"><a href="main.php">Voltar à Página Principal</a></button>
</body>
</html>