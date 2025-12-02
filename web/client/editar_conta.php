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

        if(!isset($_SESSION['user'])){
            header('Location: ../../main/login_client.php');
            exit();
        }

        echo "<form method='POST' style='margin-left: 500px;'>";
            echo "<h1 style='margin-left: 30px;'> ". htmlspecialchars($_SESSION['user']['nome'])." ".htmlspecialchars($_SESSION['user']['sobrenome'])."</h1><br><br>";
            echo "<h2>Editar Informações: </h2>";

            echo "<b>Nome:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['nome'])."' name='edt_nome'><input type='text' value='".htmlspecialchars($_SESSION['user']['sobrenome'])."' name='edt_sobrenome'><br><br>";

            echo "<b>Endereço de E-mail:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['email'])."' name='edt_email'><br><br>";

            echo "<b>Telefone:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['telefone'])."' name='edt_tel'><br><br>";

            echo "<b>Endereço:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['endereco'])."' name='edt_endereco'><input type='text' value='".htmlspecialchars($_SESSION['user']['num_endereco'])."' name='edt_endereco_num'><br><br>";

            echo "<b>Bairro:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['bairro'])."' name='edt_bairro'><br><br>";

            echo "<b>Cidade:</b><br>";
            echo "<input type='text' value='".htmlspecialchars($_SESSION['user']['cidade'])."' name='edt_cidade'><br><br>";

            echo "<b>Estado:</b><br>";
            echo "<select id='edt_UF' name='edt_UF'>
                    <option value='".htmlspecialchars($_SESSION['user']['uf'])."'>".htmlspecialchars($_SESSION['user']['uf'])."</option>
                    <option value='AC'>AC</option>
                    <option value='AL'>AL</option>
                    <option value='AP'>AP</option>
                    <option value='AM'>AM</option>
                    <option value='BA'>BA</option>
                    <option value='CE'>CE</option>
                    <option value='DF'>DF</option>
                    <option value='ES'>ES</option>
                    <option value='GO'>GO</option>
                    <option value='MA'>MA</option>
                    <option value='MS'>MS</option>
                    <option value='MT'>MT</option>
                    <option value='MG'>MG</option>
                    <option value='PA'>PA</option>
                    <option value='PB'>PB</option>
                    <option value='PR'>PR</option>
                    <option value='PE'>PE</option>
                    <option value='PI'>PI</option>
                    <option value='RJ'>RJ</option>
                    <option value='RN'>RN</option>
                    <option value='RS'>RS</option>
                    <option value='RO'>RO</option>
                    <option value='RR'>RR</option>
                    <option value='SC'>SC</option>
                    <option value='SP'>SP</option>
                    <option value='SE'>SE</option>
                    <option value='TO'>TO</option>
                </select><br><br>";

            echo "<input type='submit' value='Salvar' name='btn_salvar'>";
            echo "<button><a href='minha_conta_cliente.php' style='color: black;'>Voltar</a></button>";
        echo "</form>";

        if(isset($_POST['btn_salvar'])){
            $nome = $_POST['edt_nome'];
            $sobrenome = $_POST['edt_sobrenome'];

            $email = $_POST['edt_email'];

            $telefone = $_POST['edt_tel'];
            $endereco = $_POST['edt_endereco'];
            $endereco_num = $_POST['edt_endereco_num'];
            $bairro = $_POST['edt_bairro'];
            $cidade = $_POST['edt_cidade'];
            $uf = $_POST['edt_UF'];

            // Por aqui parei. Feliz Dia do Senhor. Soli Deo Gloria! Senhor, meu Deus, sejas glorificado! Fracos somos, mas Tu és forte. Que Teu Nome seja glorificado perpetuamente. Em Cristo Jesus, meu Senhor, amém!

            include ('../../database/config.php');

            $upd_email_select = "UPDATE TB_USUARIO SET EMAIL_TB_USUARIO = '$email' WHERE ID_TB_USUARIO = '".$_SESSION['user']['id_usuario']."';";
            $upd_data_select = "UPDATE TB_CLIENTE SET TB_CLIENTE_NOME = '$nome', TB_CLIENTE_SOBRENOME = '$sobrenome', TB_CLIENTE_TEL = '$telefone', TB_CLIENTE_ENDERECO = '$endereco', TB_CLIENTE_ENDERECO_NUM = '$endereco_num', TB_CLIENTE_BAIRRO = '$bairro', TB_CLIENT_CIDADE = '$cidade', TB_CLIENTE_UF = '$uf' WHERE TB_CLIENTE_ID = '".$_SESSION['user']['id_cliente']."';";

            if ($conn -> query($upd_email_select) && $conn -> query($upd_data_select)){
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