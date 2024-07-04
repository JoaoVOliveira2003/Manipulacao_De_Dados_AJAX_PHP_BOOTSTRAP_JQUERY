<?php
// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conexão com o banco de dados - substitua pelas suas configurações
    include "conexao.php";

    // Obtém os dados enviados via POST
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $telefonePessoal = $_POST['telefonePessoal'];
    $telefoneComercial = $_POST['telefoneComercial'];
    $cep = $_POST['cep'];
    $nome_orgao = $_POST['orgao'];
    $url = $_POST['url'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $nome_uf = $_POST['uf'];
    $nome_municipio = $_POST['municipio'];

    // Prepara a consulta SQL para inserir na tabela pessoa
    $sql = "INSERT INTO pessoa (nome, cargo, email, telefone_pessoal, telefone_comercial, codigo_cep, nome_orgao, url, endereco, numero, complemento, bairro, nome_uf, nome_municipio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conexao->prepare($sql);

    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt === false) {
        $response = array('success' => false, 'error' => 'Erro na preparação da consulta: ' . $conexao->error);
        echo json_encode($response);
        exit;
    }

    // Bind dos parâmetros e execução da consulta
    $stmt->bind_param("ssssssssssssss", $nome, $cargo, $email, $telefonePessoal, $telefoneComercial, $cep, $nome_orgao, $url, $endereco, $numero, $complemento, $bairro, $nome_uf, $nome_municipio);

    if ($stmt->execute()) {
        // Se a inserção foi bem-sucedida, retorna um JSON indicando sucesso
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Se ocorreu algum erro na execução da consulta, retorna um JSON com a mensagem de erro
        $response = array('success' => false, 'error' => 'Erro ao inserir pessoa no banco de dados: ' . $stmt->error);
        echo json_encode($response);
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    $conexao->close();

} else {
    // Se não foi uma requisição POST, retorna um JSON com mensagem de erro
    $response = array('success' => false, 'error' => 'Método não permitido.');
    echo json_encode($response);
}
?>
