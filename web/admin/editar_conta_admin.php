<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Editar Dados da Conta</title>
</head>
<body>
    <?php
        session_start();
            // Verifica se o nosso usuário está logado...

        if(!isset($_SESSION['ADMIN'])){
            header('Location: ../../main/login_admin.php');
            exit();
        }

        echo "<form method='POST' style='margin-left: 500px;'>";
            echo "<h2>Editar Informações: </h2>";

            echo "<b>Endereço de E-mail:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['ADMIN']['email'])."' name='edt_email'><br><br>";

            echo "<b>CPF/CNPJ:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['ADMIN']['cpf_cnpj'])."' name='edt_cpf_cnpj'><br><br>";

            echo "<input type='submit' value='Salvar' name='btn_salvar'>";
            echo "<button><a href='minha_conta_admin.php' style='color: black;'>Voltar</a></button>";
        echo "</form>";

        if(isset($_POST['btn_salvar'])){
            $email = $_POST['edt_email'];
            $cpf_cnpj = $_POST['edt_cpf_cnpj'];
            

            include ('../../database/config.php');

            $upd_data_select = "UPDATE TB_USUARIO SET EMAIL_TB_USUARIO = '$email', CPF_CNPJ_TB_USUARIO = '$cpf_cnpj' WHERE ID_TB_USUARIO = '".$_SESSION['ADMIN']['id_usuario']."';";

            if ($conn -> query($upd_email_select)){
                echo "<p>Dados atualizados com sucesso!</p>";
                echo "<p> Saia de sua sessão e faça login novamente.</p>";
            } else {
                echo "<p>Erro de atualização. Verifique os campos e tente novamente.";
                echo "<p> Caso persistir, ligue para (11) 99508-2512. Falar com Asaf Ferreira.";
            }
        } else {
            echo "<p>* Preencha todos os campos</p>";
        }
    ?>
    
</body>
</html>