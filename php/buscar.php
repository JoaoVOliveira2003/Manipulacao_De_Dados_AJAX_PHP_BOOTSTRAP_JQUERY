<?php
include "conexao.php";

$id_orgao = isset($_GET['id_orgao']) ? (int)$_GET['id_orgao'] : 0;

$query = "SELECT url FROM orgao WHERE id_orgao = ?";

$stmt = mysqli_prepare($conexao, $query);

mysqli_stmt_bind_param($stmt, 'i', $id_orgao);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $url);
mysqli_stmt_fetch($stmt);

$response = array('url' => $url);

mysqli_stmt_close($stmt);
mysqli_close($conexao);

echo json_encode($response);
?>
