# CRUD_Painel de Consultas

## Tela de Cadastro
![image](https://github.com/user-attachments/assets/5f37cae4-6ddf-4598-812b-9c447e3d7041)

## Tela de Edição e Atualização
![image](https://github.com/user-attachments/assets/c61e3a39-6c79-4745-90d7-17c4577ff6f2)


Este projeto implementa um sistema simples de **CRUD** (Criar, Ler, Atualizar e Excluir) para o gerenciamento de salas. Ele permite cadastrar salas, editar informações, excluir salas e aplicar filtros para busca. A aplicação foi desenvolvida em **PHP**, com uma interface simples usando **HTML**, **CSS** e **Bootstrap**.

## Funcionalidades

- **Cadastrar salas**: Permite registrar novas salas com informações como nome, profissional e apelido.
- **Editar salas**: Possibilita a edição das informações de uma sala cadastrada.
- **Excluir salas**: Permite excluir salas já cadastradas.
- **Filtrar salas**: É possível filtrar as salas por nome, profissional ou apelido.

## Tecnologias Utilizadas

- **PHP**: Backend para o processamento das requisições de cadastro, edição e exclusão de salas.
- **MySQL**: Banco de dados para armazenar as informações das salas.
- **HTML**: Estrutura básica da página web.
- **CSS**: Estilo e layout da página.
- **Bootstrap**: Framework para o design responsivo e componentes de interface.
- **jQuery**: Para facilitar a manipulação do DOM e fazer requisições AJAX.

## Como Rodar o Projeto

### Pré-requisitos

1. **Servidor Local**: Certifique-se de ter um servidor local, como o [XAMPP](https://www.apachefriends.org/pt_br/index.html), [MAMP](https://www.mamp.info/en/), ou [WAMP](https://www.wampserver.com/en/), instalado.
2. **Banco de Dados MySQL**: O banco de dados deve estar configurado com o nome `crud_salas` (ou outro de sua escolha) e uma tabela chamada `salas` com a estrutura:

```sql
CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_sala VARCHAR(255) NOT NULL,
    profissional VARCHAR(255) NOT NULL,
    apelido VARCHAR(255) NOT NULL
);


