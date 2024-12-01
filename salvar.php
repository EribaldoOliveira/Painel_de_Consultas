<?php
// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Acessar os dados enviados via POST
    $nome_sala = isset($_POST['nome_sala']) ? $_POST['nome_sala'] : null;
    $profissional = isset($_POST['profissional']) ? $_POST['profissional'] : null;
    $apelido = isset($_POST['apelido']) ? $_POST['apelido'] : null;

    // Verificar se as variáveis estão definidas
    if ($nome_sala && $profissional && $apelido) {
        // Aqui, você pode incluir o código para salvar no banco de dados
        // Por exemplo:
        $conn = mysqli_connect("localhost", "root", "", "crud_salas");
        
        if ($conn) {
            $nome_sala = mysqli_real_escape_string($conn, $nome_sala);
            $profissional = mysqli_real_escape_string($conn, $profissional);
            $apelido = mysqli_real_escape_string($conn, $apelido);

            $sql = "INSERT INTO salas (nome_sala, profissional, apelido) VALUES ('$nome_sala', '$profissional', '$apelido')";
            if (mysqli_query($conn, $sql)) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        } else {
            echo "Erro de conexão: " . mysqli_connect_error();
        }
    } else {
        echo "Por favor, preencha todos os campos!";
    }
}
?>
