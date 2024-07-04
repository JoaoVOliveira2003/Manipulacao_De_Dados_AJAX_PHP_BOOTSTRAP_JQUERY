<?php
include "conexao.php"; // Inclui o arquivo de conexão com o banco de dados

// Verifica se nome_orgao foi passado via GET
if (isset($_GET['nome_orgao'])) {
    $nome_orgao = $_GET['nome_orgao'];

    // Prepara a consulta SQL para obter a URL e o nome do órgão específico
    $query = "SELECT nome_orgao, url FROM orgao WHERE nome_orgao = ?";
    $stmt = mysqli_prepare($conexao, $query);

    mysqli_stmt_bind_param($stmt, 's', $nome_orgao); // 's' indica que nome_orgao é uma string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome_orgao, $url);
    mysqli_stmt_fetch($stmt);

    // Cria um array associativo com o nome do órgão e a URL encontrada
    $response = array(
        'nome_orgao' => $nome_orgao,
        'url' => $url
    );

    // Fecha o statement e a conexão
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    // Retorna a resposta como JSON
    echo json_encode($response);
} else {
    // Se nome_orgao não foi passado, retornar uma resposta vazia ou tratar conforme necessário
    echo json_encode(array());
}
?>
