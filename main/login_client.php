<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Login como Cliente</title>
    <link rel="stylesheet" href="../style/main_styles/login_client.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&display=swap" rel="stylesheet">

</head>
<body>
    <form method="POST" align="center" id="login_client_form">
        <h1 id="titulo">Login como Cliente</h1>

        <input name="e-mail" type="email" placeholder="E-mail" id="input_email" class="input" required><br><br>
        <input name="senha" type="password" placeholder="Senha" id="input_senha" class="input" required><br><br>
        <input type="submit" name="btn_login" value="Login" id="btn_login"><br><br>

    </form>

    <?php
        if(isset($_POST['btn_login'])){

            $email = $_POST['e-mail'];
            $senha = $_POST['senha'];

            include ("../database/config.php");

            $select_user = "SELECT * FROM TB_USUARIO WHERE EMAIL_TB_USUARIO = '$email' AND SENHA_TB_USUARIO = '$senha';";
            $retorno_user = $conn -> query($select_user);
            $dados_user = $retorno_user -> fetch_assoc();
            

            if(mysqli_num_rows($retorno_user) == 1){
                $id_usuario = $dados_user['ID_TB_USUARIO'];

                $selecionar_cliente = "SELECT * FROM TB_CLIENTE WHERE FK_USER_ID = $id_usuario";
                $retorno_cliente = $conn -> query($selecionar_cliente);
                $dados_cliente = $retorno_cliente -> fetch_assoc();

                $id_cliente = $dados_cliente['TB_CLIENTE_ID'];
                $nome_cliente = $dados_cliente['TB_CLIENTE_NOME'];
                $sobrenome_cliente = $dados_cliente['TB_CLIENTE_SOBRENOME'];
                $telefone_cliente = $dados_cliente['TB_CLIENTE_TEL'];
                $endereco_cliente = $dados_cliente['TB_CLIENTE_ENDERECO'];
                $num_endereco_cliente = $dados_cliente['TB_CLIENTE_ENDERECO_NUM'];
                $bairro_cliente = $dados_cliente['TB_CLIENTE_BAIRRO'];
                $cidade_cliente = $dados_cliente['TB_CLIENT_CIDADE'];
                $uf_cliente = $dados_cliente['TB_CLIENTE_UF'];

                session_start();


                $_SESSION['user'] = [
                    'id_cliente' => $id_cliente,
                    'id_usuario' => $id_usuario,
                    'nome' => $nome_cliente,
                    'sobrenome' => $sobrenome_cliente,
                    'email' => $email,
                    'senha' => $senha,
                    'telefone' => $telefone_cliente,
                    'endereco' => $endereco_cliente,
                    'num_endereco' => $num_endereco_cliente,
                    'bairro' => $bairro_cliente,
                    'cidade' => $cidade_cliente,
                    'uf' => $uf_cliente
                ];

                header("Location: ../web/client/home_client.php");
                exit();

            } else {
                echo "<p id='alert_no_user' align='center'>Usuário ou senha inválidos. Tente novamente.</p>";
            }
            
        }
    ?>

    <button id="btn_voltar"><a href="main.php">Voltar à Página Principal</a></button>
    
</body>
</html>