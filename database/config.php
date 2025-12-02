<?php
//----------------------------------------------------------------------------------------------
            //definindo valores de conexão:
            $host = "localhost";
            $user = "root"; // Coloque o nome do seu usuário MySQL
            $password = "root"; // Aqui, coloque a senha do seu usuário do MySQL
            $database = "vitoria_lanches";

            //abrindo conexão e verificando se há erros:
            $conn = new mysqli($host, $user, $password, $database);
            if($conn -> connect_error){
                $erro = $conn -> connect_error;
                die("Erro na conexão: ". $erro);
            }

//Após abrir a conexão, é necessário fechá-la com o comando "$conn -> close();". 
//É recomendável fazer isso após utilizá-la em seu código principal (Main).
//----------------------------------------------------------------------------------------------
?>
