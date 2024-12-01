<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Consultas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
$(document).ready(function() {
    var form = $("#formCad");
    var formFiltro = $("#formFiltro");

    // Botão Salvar (Cadastro)
    $("#salvar").on("click", function() {
    $.ajax({
        url: "salvar.php",  // URL do script PHP
        type: "post",       // Tipo de requisição
        data: form.serialize(),  // Dados do formulário
        success: function(data) {
            $(".retornoCadastros").html(data);
            form[0].reset();  // Limpar campos após o envio
        },
        error: function() {
            alert("Erro ao cadastrar");
        }
    });
});


    // Botão Editar
    $(document).on("click", ".editar", function() {
        var id = $(this).data("id");
        
        // Preencher formulário com dados existentes
        $.ajax({
            url: "buscar.php", // Novo arquivo para buscar dados
            type: "post",
            data: { id: id },
            dataType: "json",
            success: function(data) {
                $("#id").val(data.id);
                $("#nome_sala").val(data.nome_sala);
                $("#profissional").val(data.profissional);
                $("#apelido").val(data.apelido);
                $("#form-title").text("Editar Sala");
                $("#salvar").text("Atualizar");
            },
            error: function() {
                alert("Erro ao buscar dados");
            }
        });
    });

    // Limpar formulário ao finalizar edição
    $("#salvar").on("click", function() {
        form[0].reset();
        $("#form-title").text("Cadastrar Sala");
        $("#salvar").text("Cadastrar");
    });

    // Botão Excluir
    $(document).on("click", ".excluir", function() {
    var id = $(this).data("id");  // Obtém o ID do botão

    if (confirm("Tem certeza que deseja excluir este registro?")) {
        $.ajax({
            url: "excluir.php",
            type: "POST",
            data: { id: id },  // Envia o ID para o PHP
            success: function(data) {
                $(".retornoCadastros").html(data); // Atualiza os dados na página
            },
            error: function() {
                alert("Erro ao excluir");
            }
        });
    }
});


    // Botão Filtrar
    $("#btn-filtrar").on("click", function() {
        $.ajax({
            url: "filtrar.php", // Arquivo PHP que vai processar a filtragem
            type: "POST",
            data: formFiltro.serialize(), // Envia os dados do formulário para o PHP
            success: function(data) {
                $(".retornoCadastros").html(data); // Exibe o retorno no lugar correto
                formFiltro[0].reset(); // Limpa os campos após o filtro
            },
            error: function() {
                alert("Erro ao filtrar");
            }
        });
    });
});


    </script>

    <style>
    /* Customização da cor amarela para o botão de Atualizar */
    .btn-yellow {
        background-color: #FFFF00;
        /* Amarelo intenso */
        border-color: #FFFF00;
    }

    .btn-yellow:hover {
        background-color: #cccc00;
        /* Um tom mais escuro para o hover */
        border-color: #cccc00;
    }

    /* Customização para o botão Filtrar (verde) */
    .btn-filter {
        background-color: #28a745;
        /* Verde */
        border-color: #28a745;
        color: white;
    }

    .btn-filter:hover {
        background-color: #218838;
        /* Tom mais escuro de verde para o hover */
        border-color: #1e7e34;
    }

    /* Cor de fundo para toda a página */
    body {
        background-color: #f0f0f0;
        /* Cor de fundo para toda a página */
    }
    </style>
</head>

<body>

<div class="container">
    <h1 class="mt-5 text-center">Gestão de Salas</h1>

    <!-- Formulário de Cadastro/Edição -->
    <h3 id="form-title">Cadastrar Sala</h3>
    <form id="formCad">
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
    </div>
    <button class="btn btn-primary align-self-end" id="salvar">Cadastrar</button>
</form>



    <hr>

    <!-- Seção de Filtro -->
    <h3 id="form-title">Filtrar Salas</h3>
    <form id="formFiltro">
    <div class="d-flex mb-3">
        <div class="flex-fill me-2">
            <label for="filtro_nome_sala" class="form-label">Nome da Sala</label>
            <input type="text" class="form-control" id="filtro_nome_sala" name="nome_sala">
        </div>
        <div class="flex-fill me-2">
            <label for="filtro_profissional" class="form-label">Profissional</label>
            <input type="text" class="form-control" id="filtro_profissional" name="profissional">
        </div>
        <div class="flex-fill me-2">
            <label for="filtro_apelido" class="form-label">Apelido</label>
            <input type="text" class="form-control" id="filtro_apelido" name="apelido">
        </div>
    </div>
    <button type="button" class="btn btn-filter" id="btn-filtrar">Filtrar</button>
</form>

    <hr>

    <!-- Local onde a tabela será exibida -->
    <div class="retornoCadastros"></div>
</div>

</body>

</html>