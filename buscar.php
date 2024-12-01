
<?php
// Incluir a conexão com o banco
require_once 'conexao.php';

// Verificar se o 'id' foi enviado via POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitizar o ID para evitar SQL Injection
    $id = mysqli_real_escape_string($conexao, $id);

    // Query para buscar os dados
    $query = "SELECT * FROM salas WHERE id = '$id'";

    $result = mysqli_query($conexao, $query);

    // Verificar se a consulta retornou resultados
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);  // Retornar os dados como JSON
    } else {
        echo "Erro ao buscar dados: " . mysqli_error($conexao);
    }
} else {
    echo "ID não fornecido.";
}

// Fechar a conexão
mysqli_close($conexao);
?>
