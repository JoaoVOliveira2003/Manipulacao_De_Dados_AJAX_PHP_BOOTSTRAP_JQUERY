<?php
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

// Consulta SQL para buscar os dados, usando LEFT JOIN com a tabela orgao
$sql = "SELECT 
            p.id_pessoa, 
            p.nome, 
            p.cargo, 
            p.email, 
            p.telefone_pessoal, 
            p.telefone_comercial, 
            p.codigo_cep, 
            o.nome_orgao, 
            o.url AS url_orgao, 
            p.endereco, 
            p.numero, 
            p.complemento, 
            p.bairro, 
            p.nome_uf, 
            p.nome_municipio 
        FROM pessoa p
        LEFT JOIN orgao o ON p.nome_orgao = o.id_orgao";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    
    $pessoas = array();
    while ($row = $resultado->fetch_assoc()) {
        $pessoas[] = $row;
    }
    echo json_encode($pessoas);
    
} else {
    echo json_encode(array()); // Retorna um array vazio se não houver resultados
}

$conn->close();
?>
