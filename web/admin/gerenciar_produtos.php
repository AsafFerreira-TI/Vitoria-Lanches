<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Modo Admin | Gerenciar Produtos</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
    <link rel="stylesheet" href="../../style/admin_styles/gerenciar_produtos.css">
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
        <div class="form_panel">
            <form method="POST" align="center">
                <h2>Cadastrar Produtos</h2>
                <input type="text" name="nm_produto" placeholder="Insira o nome do produto">
                <?php

                    include ("../../database/config.php");
                    // A Select que usaremos para buscar as categorias:
                    $select_cats = "SELECT TB_TIPO_PRODUTO_DESC, TB_TIPO_PRODUTO_ID FROM TB_TIPO_PRODUTO ORDER BY TB_TIPO_PRODUTO_ID;";
                    // Executando os comandos:
                    $retorno_cats = $conn -> query($select_cats);
                    //criando select com as opções:
                    echo "<p>Selecione uma categoria: </p>";
                    echo "<select name='selecionar_categoria'>";
                    while($linha = $retorno_cats -> fetch_assoc()){
                        echo "<option value='".$linha['TB_TIPO_PRODUTO_ID']."'>".$linha['TB_TIPO_PRODUTO_DESC']."</option>";
                    }
                    echo "</select>";

                
                    $conn->close();
                ?>
                <button><a href="gerenciar_categorias.php">Nova</a></button><br>
                <input type="text" name="desc_produto" placeholder="Descrição..."><br>
                <input type="text" name="preco_produto" placeholder="R$ 00.00"><br>
                <input type="submit" name="btn_create_product" value="Criar">
                <input type="submit" name="btn_show_products" value="Exibir produtos">
            </form>
        </div>

        <div class="create_products">

        <?php
            if(isset($_POST['btn_create_product'])){
                $nome = $_POST['nm_produto'];
                $id_categoria = $_POST['selecionar_categoria'];
                $desc = $_POST['desc_produto'];
                $preco_produto = $_POST['preco_produto'];


                $insert_data = "INSERT INTO TB_PRODUTO(TB_PRODUTO_NOME, TB_TIPO_PRODUTO_ID, TB_PRODUTO_DESC, TB_PRECO_PRODUTO_UNIT) VALUES ('$nome', $id_categoria, '$desc', $preco_produto);";

                include ("../../database/config.php");

                if ($conn -> query($insert_data)) {
                    echo "Produto cadastrado com sucesso!";
                    $conn -> close();
                } 
                else {
                    echo "Algum erro ocorreu. Tente novamente mais tarde.";
                    $conn -> close();
                }
            }

            echo "</div>";

            echo "<div class='painel_produtos'>";

            if (isset($_POST["btn_show_products"])){
                include("../../database/config.php");

                $select_produtos = "SELECT * FROM TB_PRODUTO;";

                $retorno_produtos = $conn->query($select_produtos);

                if(mysqli_num_rows($retorno_produtos)>0){
                    $i = 0;
                    echo "<table class='lista_produtos'>";
                    while ($row = $retorno_produtos -> fetch_assoc()){
                        $id_produto[$i] = $row["TB_PRODUTO_ID"];
                        $nome_produto[$i] = $row["TB_PRODUTO_NOME"];
                        $id_categoria_fk[$i] = $row["TB_TIPO_PRODUTO_ID"];
                        $descricao_produto[$i] = $row["TB_PRODUTO_DESC"];
                        $preco_unit_produto[$i] = $row["TB_PRECO_PRODUTO_UNIT"];

                        $select_categoria_produto = "SELECT TB_TIPO_PRODUTO_DESC FROM TB_TIPO_PRODUTO WHERE TB_TIPO_PRODUTO_ID = ".$id_categoria_fk[$i].";";
                        $retorno_categoria_produto = $conn -> query($select_categoria_produto);

                        $nome_categoria = $retorno_categoria_produto -> fetch_column();

                        echo "<tr>";
                        echo "<form method='get'>";
                        echo "<td>".$row["TB_PRODUTO_NOME"]."</td>";
                        echo "<td>".$row["TB_PRODUTO_DESC"]."</td>";
                        echo "<td>".$nome_categoria."</td>";
                        echo "<td>R$ ".$row["TB_PRECO_PRODUTO_UNIT"]."</td>";
                        echo "<td><input type='submit' name='upd$i' value='Atualizar'></td>";
                        echo "<td><input type='submit' name='del$i' value='Excluir'></td>";
                        echo "</form>";
                        echo "</tr>";
                        $i++;
                    }
                    echo "</table>";
                    echo "</div>";


                    for ($i = 0; $i < count($id_produto); $i++){
                        if (isset($_GET["upd$i"])){
                            echo "<div class='painel_atualizar_produtos' style='background-color: #FFF3AE'>";

                            echo "<form method='GET'>";
                            echo "<h3>Atualizar produto <br>".$nome_produto[$i]."</h3>";
                            echo "<input type='hidden' name='id_product' value='".$id_produto[$i]."'>";
                            echo "<input type='text' name='txt_new_name_prod' placeholder='Insira o novo nome do produto'><br>";
                                

                             // A Select que usaremos para buscar as categorias:
                            $select_cats = "SELECT TB_TIPO_PRODUTO_DESC, TB_TIPO_PRODUTO_ID FROM TB_TIPO_PRODUTO ORDER BY TB_TIPO_PRODUTO_ID;";
                            // Executando os comandos:
                            $retorno_cats = $conn -> query($select_cats);
                            //criando select com as opções:
                            echo "<p>Selecione uma categoria: </p>";
                            echo "<select name='selecionar_nova_categoria'>";
                            while($linha = $retorno_cats -> fetch_assoc()){
                                echo "<option value='".$linha['TB_TIPO_PRODUTO_ID']."'>".$linha['TB_TIPO_PRODUTO_DESC']."</option>";
                            }
                            echo "</select><br>";

                            echo "<input type='text' name='new_description' value='".$descricao_produto[$i]."'><br>";
                            echo "<input type='text' name='new_prize' value='".$preco_unit_produto[$i]."'><br>";
                            echo "<input type='submit' name='btn_atualizar' value='Atualizar'>";
                            echo "</form>";
                            echo "</div>";
                        }
                            

                        else if(isset($_GET["del$i"])){
                            $delete_produto = "DELETE FROM TB_PRODUTO WHERE TB_PRODUTO_ID =".$id_produto[$i].";";

                            if ($conn -> query($delete_produto)){
                                echo "<p>Categoria deletada com sucesso!</p>";
                            } else {
                                echo "<p>Ocorreu um erro. Tente novamente mais tarde.</p>";
                            }
                        }

                    }

                    if(isset($_GET["btn_atualizar"])){
                        $id_produto = $_GET["id_product"];
                        $new_nome_produto = $_GET["txt_new_name_prod"];
                        $new_product_cat = $_GET["selecionar_nova_categoria"];
                        $new_desc = $_GET["new_description"];
                        $new_prize = $_GET["new_prize"];


                        $update_produto = "UPDATE TB_PRODUTO SET TB_PRODUTO_NOME = '$new_nome_produto', TB_TIPO_PRODUTO_ID = '$new_product_cat', TB_PRODUTO_DESC = '$new_desc', TB_PRECO_PRODUTO_UNIT = '$new_prize' WHERE TB_PRODUTO_ID = $id_produto;";

                        if ($conn->query($update_produto)){
                            echo "Categoria atualizada com sucesso!";
                        }else{
                            echo "Algum erro ocorreu. Tente novamente mais tarde.";
                        }
                    }
                }
                else {
                    echo "<p>Nenhum produto cadastrado.</p>";
                }
                $conn -> close();
            }
        ?>
    </div>
</body>
</html>