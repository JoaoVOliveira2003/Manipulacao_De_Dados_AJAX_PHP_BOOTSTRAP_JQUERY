<?php
//Pré estabelecendo uma serie de variaveis que iremos utilizar ao decorrer do codigo
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "cartaovistoria";

$conexao = mysqli_connect($servidor, $usuario, $senha, $bancodedados);
?>