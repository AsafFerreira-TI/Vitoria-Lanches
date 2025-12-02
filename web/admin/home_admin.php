<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Modo Admin | Home</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
    <link rel="stylesheet" href="../../style/admin_styles/home_admin.css">
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
                <input type="submit" name="btn_sair" id="btn_sair" class="buttons"value="Sair">
            </form>
        </div>

        
        <div class="panel_admin">
            <h1>Olá, Admin! O que deseja fazer hoje?</h1>
            <button class="btn-panel"><a href="gerenciar_produtos.php">Cadastrar <br>Produtos</a></button><br>
            <button class="btn-panel"><a href="gerenciar_categorias.php">Cadastrar <br>Categorias</a></button>
            <button class="btn-panel"><a href="gerenciar_clientes.php">Interagir com <br>clientes</a></button><br>
            <button class="btn-panel"><a href="minha_conta_admin.php">Gerenciar <br> minha conta</a></button>
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
    </div>
</body>
</html>