<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "crud_salas"; // Substitua pelo nome do seu banco de dados
$conexao = mysqli_connect($host, $user, $password, $dbname);

// Verificar conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Função para carregar as salas
function carregarSalas($conexao, $filtro_nome = '', $filtro_profissional = '', $filtro_apelido = '') {
    $sql = "SELECT * FROM salas WHERE 
            nome_sala LIKE '%$filtro_nome%' AND 
            profissional LIKE '%$filtro_profissional%' AND 
            apelido LIKE '%$filtro_apelido%'";
    $result = mysqli_query($conexao, $sql);
    $salas = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $salas[] = $row;
        }
    }

    return $salas;
}

// Processar ações de cadastro, edição e exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];

    if ($acao == 'cadastrar') {
        $nome_sala = $_POST['nome_sala'];
        $profissional = $_POST['profissional'];
        $apelido = $_POST['apelido'];

        $sql = "INSERT INTO salas (nome_sala, profissional, apelido) VALUES ('$nome_sala', '$profissional', '$apelido')";
        mysqli_query($conexao, $sql);
    } elseif ($acao == 'editar') {
        $id = $_POST['id'];
        $nome_sala = $_POST['nome_sala'];
        $profissional = $_POST['profissional'];
        $apelido = $_POST['apelido'];

        $sql = "UPDATE salas SET nome_sala = '$nome_sala', profissional = '$profissional', apelido = '$apelido' WHERE id = $id";
        mysqli_query($conexao, $sql);
    } elseif ($acao == 'excluir') {
        $id = $_POST['id'];
        $sql = "DELETE FROM salas WHERE id = $id";
        mysqli_query($conexao, $sql);
    }

    echo json_encode(['message' => 'Operação realizada com sucesso!']);
    exit;
}

// Carregar salas com base nos filtros (se houver)
$filtro_nome = isset($_GET['filter_nome']) ? $_GET['filter_nome'] : '';
$filtro_profissional = isset($_GET['filter_profissional']) ? $_GET['filter_profissional'] : '';
$filtro_apelido = isset($_GET['filter_apelido']) ? $_GET['filter_apelido'] : '';

$salas = carregarSalas($conexao, $filtro_nome, $filtro_profissional, $filtro_apelido);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Consultas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Customização da cor amarela para o botão de Atualizar */
        .btn-yellow {
            background-color: #FFFF00; /* Amarelo intenso */
            border-color: #FFFF00;
        }

        .btn-yellow:hover {
            background-color: #cccc00; /* Um tom mais escuro para o hover */
            border-color: #cccc00;
        }

        /* Customização para o botão Filtrar (verde) */
        .btn-filter {
            background-color: #28a745; /* Verde */
            border-color: #28a745;
            color: white;
        }

        .btn-filter:hover {
            background-color: #218838; /* Tom mais escuro de verde para o hover */
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mt-5 text-center">Gestão de Salas</h1>

    <!-- Formulário de Cadastro/Edição -->
    <h3 id="form-title">Cadastrar Sala</h3>
    <form id="sala-form">
        <input type="hidden" id="id" name="id">
        <div class="d-flex mb-3">
            <div class="flex-fill me-2">
                <label for="nome_sala" class="form-label">Nome da Sala</label>
                <input type="text" class="form-control" id="nome_sala" name="nome_sala" required>
            </div>
            <div class="flex-fill me-2">
                <label for="profissional" class="form-label">Profissional</label>
                <input type="text" class="form-control" id="profissional" name="profissional" required>
            </div>
            <div class="flex-fill me-2">
                <label for="apelido" class="form-label">Apelido</label>
                <input type="text" class="form-control" id="apelido" name="apelido" required>
            </div>
            <button type="submit" class="btn btn-primary align-self-end" id="submit-btn">Cadastrar</button>
        </div>
    </form>

    <hr>

    <!-- Filtros -->
    <h3>Filtrar Salas</h3>
    <form id="filter-form" class="d-flex mb-3">
        <input type="text" id="filter-nome" class="form-control me-2" placeholder="Filtrar por Nome" name="filter_nome" value="<?= $filtro_nome ?>">
        <input type="text" id="filter-profissional" class="form-control me-2" placeholder="Filtrar por Profissional" name="filter_profissional" value="<?= $filtro_profissional ?>">
        <input type="text" id="filter-apelido" class="form-control me-2" placeholder="Filtrar por Apelido" name="filter_apelido" value="<?= $filtro_apelido ?>">
        <button type="submit" class="btn btn-filter">Filtrar</button>
    </form>

    <!-- Lista de Salas -->
    <h3>Lista de Salas</h3>
    <table class="table" id="salas-table">
        <thead>
            <tr>
                <th>Nome da Sala</th>
                <th>Profissional</th>
                <th>Apelido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas as $sala): ?>
                <tr data-id="<?php echo $sala['id']; ?>">
                    <td><?php echo $sala['nome_sala']; ?></td>
                    <td><?php echo $sala['profissional']; ?></td>
                    <td><?php echo $sala['apelido']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn">Editar</button>
                        <button class="btn btn-danger btn-sm delete-btn">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Submeter formulário via AJAX
    $('#sala-form').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize() + '&acao=' + ($('#id').val() ? 'editar' : 'cadastrar');

        $.post('index.php', formData, function(response) {
            alert(response.message);
            location.reload();
        }, 'json');
    });

    // Preencher formulário para edição
    $('.edit-btn').on('click', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        let nome_sala = row.find('td:eq(0)').text();
        let profissional = row.find('td:eq(1)').text();
        let apelido = row.find('td:eq(2)').text();

        $('#id').val(id);
        $('#nome_sala').val(nome_sala);
        $('#profissional').val(profissional);
        $('#apelido').val(apelido);
        $('#form-title').text('Editar Sala');
        $('#submit-btn').text('Atualizar').removeClass('btn-primary').addClass('btn-yellow');
    });

    // Excluir sala
    $('.delete-btn').on('click', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        if (confirm('Tem certeza que deseja excluir esta sala?')) {
            $.post('index.php', { acao: 'excluir', id: id }, function(response) {
                alert(response.message);
                location.reload();
            }, 'json');
        }
    });

    // Filtrar salas
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        let queryString = $(this).serialize();
        window.location.href = '?' + queryString;
    });
});
</script>

</body>
</html>
