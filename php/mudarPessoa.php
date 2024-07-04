<?php
// Exibir as variáveis para depuração
$id_pessoa = $_POST['id_pessoa'];
$nome = $_POST['nome'];
$cargo = $_POST['cargo'];
$email = $_POST['email'];
$telefone_pessoal = $_POST['telefone_pessoal'];
$telefone_comercial = $_POST['telefone_comercial'];
$codigo_cep = $_POST['codigo_cep'];
$nome_orgao = isset($_POST['nome_orgao']) ? $_POST['nome_orgao'] : null; // Verifica se o campo foi enviado
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$nome_uf = $_POST['nome_uf'];
$nome_municipio = $_POST['nome_municipio'];
$url = $_POST['url'];

// Processamento de atualização no banco de dados

// Configurações de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "cartaovistoria";

// Conectando ao banco de dados
$conn = new mysqli($servidor, $usuario, $senha, $bancodedados);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Monta a parte da consulta SQL para os campos atualizáveis
$sql_campos = "nome='$nome', 
            cargo='$cargo', 
            email='$email', 
            telefone_pessoal='$telefone_pessoal', 
            telefone_comercial='$telefone_comercial', 
            codigo_cep='$codigo_cep', 
            endereco='$endereco', 
            numero='$numero', 
            complemento='$complemento', 
            bairro='$bairro', 
            nome_uf='$nome_uf', 
            nome_municipio='$nome_municipio', 
            url='$url'";

// Verifica se o campo nome_orgao foi enviado
if (!empty($nome_orgao)) {
    // Adiciona o campo nome_orgao à consulta SQL
    $sql_campos .= ", nome_orgao='$nome_orgao'";
}

// Consulta SQL para atualizar os dados
$sql = "UPDATE pessoa SET 
            $sql_campos
        WHERE id_pessoa='$id_pessoa'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => $conn->error));
}

$conn->close();
?>
