<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Modo Admin | Gerenciar Clientes</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
    <link rel="stylesheet" href="../../style/admin_styles/gerenciar_clientes.css">
</head>
<body>
    <div class="container">
        <?php
            session_start();
            // Verifica se o nosso usuário está logado...

            if(!isset($_SESSION['ADMIN'])){
                header('Location: ../../main/login_admin.php');
                exit();
            }
        ?>

        <div class="menu_principal" align="left">
            <button class="buttons btn_vitoria_lanches"><a href="home_admin.php">Vitória Lanches</a></button><br>
            <button class="buttons btn_produtos"><a href="gerenciar_produtos.php">Gerenciar Produtos</a></button><br>
            <button class="buttons btn_categorias"><a href="gerenciar_categorias.php">Gerenciar Categorias</a></button><br>
            <button class="buttons btn_clientes"><a href="gerenciar_clientes.php">Gerenciar Clientes</a></button><br>
            <button class="buttons btn_minha_conta"><a href="minha_conta_admin.php">Minha Conta</a></button><br>
            <form method="POST">
                <input type="submit" name="btn_sair" id="btn_sair" class="buttons" value="Sair">
            </form>
        </div>

        <?php
        if (isset($_POST['btn_sair'])){
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../../main/login_admin.php");
            exit();
        }
        ?>

        <div class="painel_clientes" align="center">

            <h1>Painel de Clientes</h1>
            <?php
                include("../../database/config.php");

                $select_clientes = "SELECT TB_CLIENTE_ID, TB_CLIENTE_NOME, TB_CLIENTE_SOBRENOME, FK_USER_ID FROM TB_CLIENTE;";
                $retorno_clientes = $conn -> query($select_clientes);
                
                if(mysqli_num_rows($retorno_clientes)>0){
                    $i = 0;
                    echo "<table>";
                    while ($row = $retorno_clientes -> fetch_assoc()){
                        $clientes_id[$i] = $row['TB_CLIENTE_ID'];
                        echo "<form method='GET'>";
                        echo "<tr>";
                        echo "<td>".$row['TB_CLIENTE_NOME']."</td>";
                        echo "<td>".$row['TB_CLIENTE_SOBRENOME']."</td>";
                        echo "<input type='hidden' name='id_user' value='".$row['FK_USER_ID']."'>";
                        echo "<td><input type='submit' name='read_user$i' value='Ver Informações'>";
                        echo "<td><input type='submit' name='delete_user$i' value='Excluir'></td><br>";
                        echo "<tr>";
                        echo "</form>";
                        $i++;
                    }
                    echo "</table>";

                    for ($i = 0; $i <= count($clientes_id); $i++){
                        if(isset($_GET['delete_user'.$i])){
                            $fk_user_id = $_GET['id_user'];

                            $delete_cliente = "DELETE FROM TB_CLIENTE WHERE TB_CLIENTE_ID = ".$clientes_id[$i].";";
                            $delete_user = "DELETE FROM TB_USUARIO WHERE ID_TB_USUARIO = $fk_user_id";
                            if ($conn -> query ($delete_cliente)){
                                if ($conn -> query($delete_user)){
                                    echo "<p>Usuário deletado com sucesso!</p>";
                                } 
                                else 
                                {
                                    echo "<p>Algo deu errado, tente novamente.</p>";
                                }
                            } else {
                                echo "<p>Algo deu errado, tente novamente.</p>";
                            }
                        }

                        if (isset($_GET['read_user'.$i])){
                            echo "<div class='painel_mostrar_clientes' style='background-color: #FFF3AE'>";
                                $slct_cli = "SELECT * FROM TB_CLIENTE WHERE TB_CLIENTE_ID = '".$clientes_id[$i]."';";
                                $retorno_cli = $conn -> query($slct_cli);
                                $dados_cliente = $retorno_cli -> fetch_assoc();

                                $nome_cliente = $dados_cliente['TB_CLIENTE_NOME'];
                                $sobrenome_cliente = $dados_cliente['TB_CLIENTE_SOBRENOME'];
                                $telefone_cliente = $dados_cliente['TB_CLIENTE_TEL'];
                                $endereco_cliente = $dados_cliente['TB_CLIENTE_ENDERECO'];
                                $num_endereco_cliente = $dados_cliente['TB_CLIENTE_ENDERECO_NUM'];
                                $bairro_cliente = $dados_cliente['TB_CLIENTE_BAIRRO'];
                                $cidade_cliente = $dados_cliente['TB_CLIENT_CIDADE'];
                                $uf_cliente = $dados_cliente['TB_CLIENTE_UF'];

                                echo "<h2>$nome_cliente $sobrenome_cliente</h2>";
                            
                                echo "<b>Telefone:</b><br>";
                                echo "<p>$telefone_cliente</p>";

                                echo "<b>Endereço:</b><br>";
                                echo "<p>$endereco_cliente, $num_endereco_cliente</p>";

                                echo "<b>Bairro:</b><br>";
                                echo "<p>$bairro_cliente</p>";

                                echo "<b>Cidade:</b><br>";
                                echo "<p>$cidade_cliente</p>";

                                echo "<b>Estado:</b><br>";
                                echo "<p>$uf_cliente</p>";

                                echo "<button><a href='gerenciar_clientes.php'>OK</a></button>";
                            echo "</div";
                        }
                    }
                } else {
                    echo "<p>Nenhum cliente cadastrado ainda.</p>";
                }

            ?>

        </div>
    </div>
</body>
</html>