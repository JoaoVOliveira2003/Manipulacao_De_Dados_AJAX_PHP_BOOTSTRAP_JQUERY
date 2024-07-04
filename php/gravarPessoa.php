<?php
// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Conexão com o banco de dados - substitua pelas suas configurações
    include "conexao.php";

    // Verifica se o campo nome não está vazio
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        
        // Atribui os valores recebidos do formulário às variáveis
        $nome = $_POST['nome'];
        $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $telefonePessoal = isset($_POST['telefonePessoal']) ? $_POST['telefonePessoal'] : '';
        $telefoneComercial = isset($_POST['telefoneComercial']) ? $_POST['telefoneComercial'] : '';
        $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
        $nome_orgao = isset($_POST['orgao']) ? $_POST['orgao'] : '';
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
        $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
        $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';
        $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
        $nome_uf = isset($_POST['uf']) ? $_POST['uf'] : '';
        $nome_municipio = isset($_POST['municipio']) ? $_POST['municipio'] : '';

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

            // Redireciona para a página Desenvolvimento.php após 2 segundos
            exit;
        } else {
            // Se ocorreu algum erro na execução da consulta, retorna um JSON com a mensagem de erro
            $response = array('success' => false, 'error' => 'Erro ao inserir pessoa no banco de dados: ' . $stmt->error);
            echo json_encode($response);
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        // Caso o campo nome esteja vazio, retorna um JSON com mensagem de erro
        $response = array('success' => false, 'error' => 'Nome deve ter dados para gravar.');
        echo json_encode($response);
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    // Se não foi uma requisição POST, retorna um JSON com mensagem de erro
    $response = array('success' => false, 'error' => 'Método não permitido.');
    echo json_encode($response);
}
?>
