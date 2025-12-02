<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Modo Admin | Minha Conta e Dados</title>
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

        <div class="form_admin">
        <h1>Olá, Admin!</h1><br>

        <h2>Suas Informações:</h2><br>

        <?php
            echo "<p><b>Endereço de Email:</b></p>";
            echo $_SESSION['ADMIN']['email']."<br><br>";
            echo "<p><b>CPF/CNPJ:</b></p>";
            echo $_SESSION['ADMIN']['cpf_cnpj']."<br><br><br>";
        ?>

        <button><a href="editar_conta_admin.php">Editar Dados da Conta</a></button>
        <button><a href="mudar_senha_admin.php">Mudar Senha</a></button>
    </div>
    </div>
</body>
</html>