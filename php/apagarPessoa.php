<?php

// Verifica se o ID da pessoa foi enviado via POST
if (isset($_POST['id_pessoa'])) {
    // Obtém o ID da pessoa a ser deletada e realiza a sanitização
    $id_pessoa = filter_var($_POST['id_pessoa'], FILTER_SANITIZE_NUMBER_INT);

    // Configurações do banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedados = "cartaovistoria";

    // Conectando ao banco de dados
    $conn = new mysqli($servidor, $usuario, $senha, $bancodedados);

    // Verifica a conexão
    if ($conn->connect_error) {
        $response = array('success' => false, 'error' => 'Erro na conexão com o banco de dados');
        echo json_encode($response);
        die();
    }

    // Prepara a query para deletar a pessoa
    $sql = "DELETE FROM pessoa WHERE id_pessoa = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da declaração teve sucesso
    if ($stmt === false) {
        $response = array('success' => false, 'error' => 'Erro na preparação da declaração SQL');
        echo json_encode($response);
        die();
    }

    // Associa o ID da pessoa ao parâmetro da declaração
    $stmt->bind_param('i', $id_pessoa);

    // Executa a declaração
    if ($stmt->execute()) {
        // Se a execução foi bem-sucedida, retorna sucesso
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Se ocorreu algum erro na execução, retorna o erro
        $response = array('success' => false, 'error' => 'Erro ao deletar pessoa');
        echo json_encode($response);

        // Log de erro
        $log_message = "Erro ao tentar deletar a pessoa com ID $id_pessoa.";
        error_log($log_message, 0);
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Se o ID da pessoa não foi recebido, retorna um erro
    $response = array('success' => false, 'error' => 'ID da pessoa nao fornecido CORRETAMENTE');
    echo json_encode($response);

    // Log de erro
    $log_message = "Tentativa de deletar pessoa sem ID fornecido.";
    error_log($log_message, 0);
}

?>
