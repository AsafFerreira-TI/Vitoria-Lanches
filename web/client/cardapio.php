<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Cardápio</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
</head>
<body>
    <div class="container">
        <?php
            session_start();
            // Verifica se o nosso usuário está logado...

            if(!isset($_SESSION['user'])){
                header('Location: ../../main/login_client.php');
                exit();
            }
        ?>
        <div class="menu_principal" align="left">
            <button class="buttons btn_vitoria_lanches"><a href="home_client.php">Vitória Lanches</a></button><br>
            <button class="buttons btn_cardapio"><a href="cardapio.php">Ver Cardápio</a></button><br>
            <button class="buttons btn_minha_conta"><a href="minha_conta_cliente.php">Minha Conta</a></button><br>
            <form method="POST">
                <input type="submit" name="btn_sair" id="btn_sair" class="buttons" value="Sair">
            </form>
        </div>

        <?php
        if (isset($_POST['btn_sair'])){
            session_start();
            session_unset();
            session_destroy();
            header('Location: ../../main/login_client.php');
            exit();
        }
        ?>

        <div class="cardapio">
            <h1 align="center">Nosso Cardápio:</h1>
            <?php
                include ("../../database/config.php");

                $selecionar_categorias = "SELECT * FROM TB_TIPO_PRODUTO";
                $retorno_categorias = $conn -> query($selecionar_categorias);

                $i = 0;
                echo "<table>";
                while ($row = $retorno_categorias -> fetch_assoc()){
                    $id_cats[$i] = $row["TB_TIPO_PRODUTO_ID"];
                    $nome_cats[$i] = $row["TB_TIPO_PRODUTO_DESC"];

                    $selecionar_produtos = "SELECT TB_PRODUTO_NOME, TB_PRODUTO_DESC, TB_PRECO_PRODUTO_UNIT FROM TB_PRODUTO WHERE TB_TIPO_PRODUTO_ID = ".$row["TB_TIPO_PRODUTO_ID"].";";
                    $retorno_produtos = $conn -> query($selecionar_produtos);

                    echo "<th>".$nome_cats[$i]."</th>";

                    while ($linha = $retorno_produtos -> fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$linha['TB_PRODUTO_NOME']."   .............................................................................................</td>";
                        echo "<td>R$ ".$linha['TB_PRECO_PRODUTO_UNIT']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Descrição: ".$linha['TB_PRODUTO_DESC']."</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>----------------------------------------------------------</td><br>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            ?>
        </div>
    </div>
</body>
</html>