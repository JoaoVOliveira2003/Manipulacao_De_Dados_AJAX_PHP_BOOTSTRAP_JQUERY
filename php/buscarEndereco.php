<?php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

// Verifica se o parâmetro codigo_cep foi enviado via GET
if (!isset($_GET['codigo_cep'])) {
    // Se não foi recebido corretamente, retorna um erro
    echo json_encode(array('success' => false, 'error' => 'Código de CEP não recebido.'));
    exit;
}

// Recebe o código do CEP enviado via AJAX
$codigoCep = $_GET['codigo_cep'];

// Consulta SQL para buscar os dados do endereço pelo código do CEP, incluindo os nomes do UF e Município
$query = "SELECT c.endereco, c.bairro, c.numero, c.complemento, u.nome_uf, m.nome_municipio 
          FROM cep c
          LEFT JOIN uf u ON c.id_uf = u.id_uf
          LEFT JOIN municipio m ON c.id_municipio = m.id_municipio
          WHERE c.codigo_cep = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "s", $codigoCep);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $endereco, $bairro, $numero, $complemento, $nomeUf, $nomeMunicipio);

if (mysqli_stmt_fetch($stmt)) {
    // Retorna os dados em formato JSON
    $response = array(
        'success' => true,
        'endereco' => $endereco,
        'bairro' => $bairro,
        'numero' => $numero,
        'complemento' => $complemento,
        'uf' => $nomeUf,
        'municipio' => $nomeMunicipio
    );
} else {
    // CEP não encontrado no banco de dados
    $response = array('success' => false, 'error' => 'CEP não encontrado.');
}

// Encerra a consulta e fecha a conexão com o banco de dados
mysqli_stmt_close($stmt);
mysqli_close($conexao);

// Retorna a resposta em JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
