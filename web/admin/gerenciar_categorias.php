<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Modo Admin | Gerenciar Categorias</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
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

        <div class="panel_categorias">
            <div class="create">
                <form method="POST">
                    <h3>Criar Categoria</h3>
                    <input type="text" name="txt_name_cat" placeholder="Insira o nome da nova categoria">
                    <input type="submit" name="btn_criar_categoria" value="Criar">
                    <input type="submit" name="btn_exibir_categoria" value="Exibir"><br><br><br>
                </form>

                <?php
                    if (isset($_POST["btn_criar_categoria"])){
                        $new_categoria = $_POST["txt_name_cat"];

                        $insert_data = "INSERT INTO TB_TIPO_PRODUTO (TB_TIPO_PRODUTO_DESC) VALUES ('$new_categoria');";

                        include("../../database/config.php");

                        if($conn->query($insert_data)){
                            echo "Categoria criada com sucesso!";
                            $conn->close();
                        } else{
                            echo "Algum erro ocorreu. Tente novamente mais tarde.";
                            $conn->close();
                        }
                    }

                    if (isset($_POST["btn_exibir_categoria"])){
                        include("../../database/config.php");
                        
                        $select_categorias = "SELECT * FROM TB_TIPO_PRODUTO;";

                        $retorno_categorias = $conn->query($select_categorias);

                        if(mysqli_num_rows($retorno_categorias)>0){
                            $i = 0;
                            echo "<table>";
                            while($row = $retorno_categorias->fetch_assoc()){
                                $id_categoria[$i] = $row["TB_TIPO_PRODUTO_ID"];
                                $categoria[$i] = $row["TB_TIPO_PRODUTO_DESC"];
                                echo "<tr>";
                                echo "<form method='get'>";
                                echo "<td>".$row["TB_TIPO_PRODUTO_DESC"]."</td><td>"."<input type='submit' name='upd$i' value='Atualizar'>"."</td><td>"."<input type='submit' name='del$i' value='Excluir'></td>";
                                echo "</form>";
                                echo "</tr>";
                                $i++;
                            }
                            echo "</table>";


                            for ($i = 0; $i < count($categoria); $i++){
                                if (isset($_GET["upd$i"])){
                                    echo "<form method='GET'>";
                                    echo "<h3>Atualizar categoria ".$categoria[$i]."</h3>";
                                    echo "<input type='hidden' name='id_category' value='".$id_categoria[$i]."'>";
                                    echo "<input type='text' name='txt_new_name_cat' placeholder='Insira o novo nome da categoria'><br>";
                                    echo "<input type='submit' name='btn_atualizar' value='Atualizar'>";
                                    echo "</form>";
                                }

                                else if(isset($_GET["del$i"])){
                                    $delete_categoria = "DELETE FROM TB_TIPO_PRODUTO WHERE TB_TIPO_PRODUTO_ID =".$id_categoria[$i].";";

                                    if ($conn -> query($delete_categoria)){
                                        echo "<p>Categoria deletada com sucesso!</p>";
                                    }
                                }
                            }

                            if (isset($_GET["btn_atualizar"])){
                                $id_cat = $_GET["id_category"];
                                $nome_cat = $_GET["txt_new_name_cat"];

                                $update_categoria = "UPDATE TB_TIPO_PRODUTO SET TB_TIPO_PRODUTO_DESC = '$nome_cat' WHERE TB_TIPO_PRODUTO_ID = $id_cat;";

                                if ($conn->query($update_categoria)){
                                    echo "Categoria atualizada com sucesso!";
                                }else{
                                    echo "Algum erro ocorreu. Tente novamente mais tarde.";
                                }
                            }
                        } else {
                            echo "Nenhuma categoria cadastrada.";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>