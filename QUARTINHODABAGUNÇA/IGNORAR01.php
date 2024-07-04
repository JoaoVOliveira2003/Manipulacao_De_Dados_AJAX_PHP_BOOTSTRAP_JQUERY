<?php
// Estabelecendo as configurações de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "cartaovistoria";

// Conectando ao banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conexão bem-sucedida!<br>";

// Selecionando o banco de dados específico
$bd = mysqli_select_db($conexao, $bancodedados);

if (!$bd) {
    die("Falha ao selecionar o banco de dados: " . mysqli_error($conexao));
}
echo "Banco de dados '$bancodedados' selecionado com sucesso!<br>";

// Consulta para obter todas as tabelas no banco de dados
$query_tabelas = "SHOW TABLES";
$result_tabelas = mysqli_query($conexao, $query_tabelas);

if (!$result_tabelas) {
    die("Falha na consulta das tabelas: " . mysqli_error($conexao));
}
echo "Tabelas no banco de dados '$bancodedados':<br>";

// Iterando sobre cada tabela encontrada
while ($row_tabela = mysqli_fetch_row($result_tabelas)) {
    $tabela = $row_tabela[0];
    echo "<h2>Tabela: $tabela</h2>";

    // Consulta para obter todos os dados da tabela atual
    $query_dados = "SELECT * FROM $tabela";
    $result_dados = mysqli_query($conexao, $query_dados);

    if (!$result_dados) {
        echo "Falha na consulta dos dados da tabela '$tabela': " . mysqli_error($conexao) . "<br>";
        continue;
    }

    // Obtendo informações das colunas da tabela
    $campos = mysqli_fetch_fields($result_dados);

    // Criando uma tabela HTML para exibir os dados da tabela atual
    echo "<table border='1'><tr>";
    foreach ($campos as $campo) {
        echo "<th>{$campo->name}</th>";
    }
    echo "</tr>";

    // Exibindo os dados da tabela
    while ($row_dados = mysqli_fetch_assoc($result_dados)) {
        echo "<tr>";
        foreach ($row_dados as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table><br>";
}

// Fechando a conexão com o banco de dados
mysqli_close($conexao);
?>
