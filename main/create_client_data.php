<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Dados Básicos | Vitória Lanches</title>
</head>
<body>
    <?php
        session_start();
    // Verifica se o nosso usuário está logado...

        if(!isset($_SESSION['EMAIL'])){
            header('Location: signup_user.php');
            exit();
        }
    ?>
    

    <form method="POST">
        <h1>Seus Dados!</h1><br>
        <input name="nome" type="text" placeholder="Nome" required>
        <input name="sobrenome" type="text" placeholder="Sobrenome" required><br>
        <input name="telefone" type="tel" placeholder="(XX) XXXXX-XXXX"><br>

        <select id="UF" name="UF">
            <option value="">Selecione</option>
            <option value="AC">AC</option>
            <option value="AL">AL</option>
            <option value="AP">AP</option>
            <option value="AM">AM</option>
            <option value="BA">BA</option>
            <option value="CE">CE</option>
            <option value="DF">DF</option>
            <option value="ES">ES</option>
            <option value="GO">GO</option>
            <option value="MA">MA</option>
            <option value="MS">MS</option>
            <option value="MT">MT</option>
            <option value="MG">MG</option>
            <option value="PA">PA</option>
            <option value="PB">PB</option>
            <option value="PR">PR</option>
            <option value="PE">PE</option>
            <option value="PI">PI</option>
            <option value="RJ">RJ</option>
            <option value="RN">RN</option>
            <option value="RS">RS</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="SC">SC</option>
            <option value="SP">SP</option>
            <option value="SE">SE</option>
            <option value="TO">TO</option>
        </select>

        <input name="cidade" type="text" placeholder="Cidade"><br>
        <input name="bairro" type="text" placeholder="Bairro"><br>
        <input name="endereco" type="text" placeholder="Endereço">
        <input name="numero_endereco" type="text" placeholder="Número"><br>

        <input name="btn_inscrever-se" type="submit" value="INscrever-se"><br>
    </form>

    <?php
        include ('../database/config.php');

        if(isset($_POST['btn_inscrever-se'])){
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $telefone = $_POST['telefone'];
            $uf = $_POST['UF'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
            $endereco = $_POST['endereco'];
            $endereco_num = $_POST['numero_endereco'];

            $email = $_SESSION['EMAIL'];


            $select_fk_cliente = "SELECT ID_TB_USUARIO FROM TB_USUARIO WHERE EMAIL_TB_USUARIO = '$email';";
            $retorno_fk_cliente = $conn -> query($select_fk_cliente);
            $fk_id_user = $retorno_fk_cliente -> fetch_column();


            $insert_cliente = "INSERT INTO TB_CLIENTE(TB_CLIENTE_NOME, TB_CLIENTE_SOBRENOME, TB_CLIENTE_TEL, TB_CLIENTE_UF, TB_CLIENT_CIDADE, TB_CLIENTE_BAIRRO, TB_CLIENTE_ENDERECO, TB_CLIENTE_ENDERECO_NUM, FK_USER_ID) VALUES('$nome', '$sobrenome', '$telefone', '$uf', '$cidade', '$bairro', '$endereco', '$endereco_num', $fk_id_user);";

            if ($conn->query($insert_cliente)){
                echo "<p id='cad_cli_sucess'>Dados Cadastrados com Sucesso!</p>";
                $conn -> close();
                session_start();
                session_unset();
                session_destroy();
                header("Location: login_client.php");
                exit();
            } else {
                echo ("<p id='query_error'>Erro ao tentar criar os dados do cliente. Tente novamente.</p>");
            }
        } else {
            echo "<p id='empty_alert'>*Preencha todos os campos.</p>";
        }
    ?>
    <button id="btn_voltar_user"><a href="signup_user.php">Voltar</a></button>
</body>
</html>