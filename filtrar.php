<?php
// Incluir a conexão com o banco
require_once 'conexao.php';

// Pega os parâmetros do filtro, se existirem
$nome_sala = $_POST['nome_sala'] ?? '';
$profissional = $_POST['profissional'] ?? '';
$apelido = $_POST['apelido'] ?? '';

// Cria a consulta base
$query = "SELECT * FROM salas WHERE 1=1";

// Aplica os filtros se forem informados
if ($nome_sala) {
    $query .= " AND nome_sala LIKE '%" . mysqli_real_escape_string($conexao, $nome_sala) . "%'";
}

if ($profissional) {
    $query .= " AND profissional LIKE '%" . mysqli_real_escape_string($conexao, $profissional) . "%'";
}

if ($apelido) {
    $query .= " AND apelido LIKE '%" . mysqli_real_escape_string($conexao, $apelido) . "%'";
}

// Executa a consulta
$result = mysqli_query($conexao, $query);

// Verifica se há resultados e exibe-os
if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Nome da Sala</th><th>Profissional</th><th>Apelido</th><th>Ações</th></tr></thead><tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome_sala']) . "</td>";
        echo "<td>" . htmlspecialchars($row['profissional']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apelido']) . "</td>";
        echo "<td>";
        echo "<button class='btn btn-warning editar' data-id='" . $row['id'] . "'>Editar</button> ";
        echo "<button class='btn btn-danger excluir' data-id='" . $row['id'] . "'>Excluir</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>Nenhum resultado encontrado.</p>";
}

// Fecha a conexão com o banco
mysqli_close($conexao);
?>
