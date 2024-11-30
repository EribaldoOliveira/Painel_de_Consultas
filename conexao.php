<?php
$servidor = "localhost";  
$usuario = "root";       
$senha = "";              
$banco = "crud_salas"; 

// Criação da conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificação da conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}
?>
