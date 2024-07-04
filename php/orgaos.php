<?php
include "conexao.php"; // Inclui o arquivo de conexão com o banco de dados

if (isset($_GET['id_orgao'])) {
    $id_orgao = $_GET['id_orgao'];

    // Consulta os dados para um órgão específico
    $sql = "SELECT id_orgao, nome_orgao, url FROM orgao WHERE id_orgao = ?";
    $stmt = $conexao->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id_orgao);
        $stmt->execute();
        $result = $stmt->get_result();

        $orgao = $result->fetch_assoc();

        echo json_encode($orgao);

        $stmt->close();
    } else {
        echo json_encode(["error" => "Erro ao preparar a consulta."]);
    }

} else {
    // Consulta os dados para todos os órgãos
    $sql = "SELECT id_orgao, nome_orgao, url FROM orgao";
    $result = $conexao->query($sql);
    if ($result) {
        $orgaos = array();
        while($row = $result->fetch_assoc()) {
            $orgaos[] = $row;
        }
        echo json_encode($orgaos);
    } else {
        echo json_encode(["error" => "Erro ao executar a consulta."]);
    }
}

$conexao->close();
?>
