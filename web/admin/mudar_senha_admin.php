<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Mudar Senha</title>
</head>
<body>

    <?php
        session_start();
            // Verifica se o nosso usuário está logado...

        if(!isset($_SESSION['ADMIN'])){
            header('Location: ../../main/login_admin.php');
            exit();
        }
    ?>

    <form method="POST" style='margin-left: 500px;'>
        <h1>Mudar senha:</h1>

        <p>Digite sua senha atual:</p>
        <input type="password" name="senha_atual" required><br>
        <p>Digite sua nova senha:</p>
        <input type="password" name="nova_senha" required><br>
        <p>Confirme sua nova senha:</p>
        <input type="password" name="nova_senha_confirm" required><br><br>

        <input type="submit" name="mudar_senha" value="Mudar Senha">
        <button><a href='minha_conta_admin.php' style='color: black;'>Voltar</a></button><br>
    </form>


    <?php
        if(isset($_POST['mudar_senha'])){

            $senha_atual = $_POST["senha_atual"];
            $nova_senha = $_POST["nova_senha"];
            $nova_senha_confirm = $_POST["nova_senha_confirm"];

            if($senha_atual == $_SESSION['ADMIN']['senha'] && $nova_senha == $nova_senha_confirm){
                include("../../database/config.php");
                $sql_upd_psswd = "UPDATE TB_USUARIO SET SENHA_TB_USUARIO = '$nova_senha' WHERE ID_TB_USUARIO = '".$_SESSION['ADMIN']['id_usuario']."';";

                if($conn -> query($sql_upd_psswd)){
                    echo "<p>Senha atualizada com sucesso!</p>";
                }
                else {
                    echo "<p>Erro de conexão. Tente novamente mais tarde.</p>";
                }
            } 
            else if($nova_senha != $nova_senha_confirm){
                echo "<p>As senhas não correspondem. Verifique-as e tente novamente</p>";
            } else {
                echo "<p>Senha incorreta. Tente novamente</p>";
            }
        } else {
            echo "<p>* Preencha todos os campos.</p>";
        }
    ?>
</body>
</html>