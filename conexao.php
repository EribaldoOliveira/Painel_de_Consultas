<?php
$servidor = "localhost";  
$usuario = "root";       
$senha = "";              
$banco = "crud_salas"; 

// Criação da conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verificação da conexão
if (!$conexao) {
    die("Conexão falhou: ");
}
?>
