<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitória Lanches, sua lanchonete fácil e acessível | Minha Conta</title>
    <link rel="stylesheet" href="../../style/main_styles/system.css">
    <link rel="stylesheet" href="../../style/client_styles/cardapio.css">
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
    </div>

    <div class="form_cliente">
        <?php
            echo "<h1>". htmlspecialchars($_SESSION['user']['nome'])." ".htmlspecialchars($_SESSION['user']['sobrenome'])."</h1><br><br>";
            echo "<h2>Suas Informações: </h2>";

            echo "<b>Endereço de E-mail:</b><br>";
            echo htmlspecialchars($_SESSION['user']['email'])."<br><br>";

            echo "<b>Telefone:</b><br>";
            echo htmlspecialchars($_SESSION['user']['telefone'])."<br><br>";

            echo "<b>Endereço:</b><br>";
            echo htmlspecialchars($_SESSION['user']['endereco']).", ".htmlspecialchars($_SESSION['user']['num_endereco'])."<br><br>";

            echo "<b>Bairro:</b><br>";
            echo htmlspecialchars($_SESSION['user']['bairro'])."<br><br>";

            echo "<b>Cidade:</b><br>";
            echo htmlspecialchars($_SESSION['user']['cidade'])."<br><br>";

            echo "<b>Estado:</b><br>";
            echo htmlspecialchars($_SESSION['user']['uf'])."<br><br>";
        ?>
        <button><a href="editar_conta.php">Editar dados da conta</a></button>
        <button><a href="mudar_senha.php">Mudar Senha</a></button>
    </div>
</body>
</html>