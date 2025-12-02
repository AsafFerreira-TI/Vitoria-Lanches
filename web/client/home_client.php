<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Home</title>
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

        <div class="client_panel">
            <?php
                echo ("<h1>Olá, ". htmlspecialchars($_SESSION['user']['nome'])."! O que quer fazer hoje?</h1>");
            ?>

            <button class="btn-panel"><a href="cardapio.php">Visualizar <br>Cardápio</a></button>
            <button class="btn-panel"><a href="minha_conta_cliente.php">Gerenciar <br> minha conta</a></button>
        </div>

        <?php
        if (isset($_POST['btn_sair'])){
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../../main/login_client.php");
            exit();
        }
        ?>
    </div>
</body>
</html>