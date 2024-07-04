<?php
include "conexao.php"; // Certifique-se de que o arquivo de conexão está correto

$id_orgao_inicial = 1; // Defina o ID inicial desejado
$query_inicial = "SELECT url FROM orgao WHERE id_orgao = ?";
$stmt_inicial = mysqli_prepare($conexao, $query_inicial);
mysqli_stmt_bind_param($stmt_inicial, 'i', $id_orgao_inicial);
mysqli_stmt_execute($stmt_inicial);
mysqli_stmt_bind_result($stmt_inicial, $url_inicial);
mysqli_stmt_fetch($stmt_inicial);
mysqli_stmt_close($stmt_inicial);
// Não feche a conexão aqui, pois precisamos dela para a requisição AJAX
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE</title>
    <!-- Inclua o Bootstrap ou outros estilos CSS conforme necessário -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function buscarNoBanco() {
            var orgaoSelect = document.getElementById("orgao");
            var id_orgao = orgaoSelect.value;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "buscar.php?id_orgao=" + id_orgao, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.url) {
                        document.getElementById("url").value = response.url;
                    } else {
                        alert("URL não encontrada para o órgão selecionado.");
                    }
                }
            };
            xhr.send();
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <label for="orgao">Órgão:</label>
                <select onchange="buscarNoBanco()" class="form-control" id="orgao" name="orgao">
                    <option value="1">Secretaria do Desenvolvimento Social e Família</option>
                    <option value="2">Secretaria da Indústria, Comércio e Serviços</option>
                    <option value="3">Secretaria do Desenvolvimento Sustentável</option>
                    <option value="4">Secretaria da Fazenda</option>
                    <option value="5">Vice-governadoria</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="url">Site:</label>
                <input type="text" class="form-control" value="<?php echo $url_inicial; ?>" id="url" name="url" readonly>
            </div>
        </div>
    </div>

    <!-- Inclua o jQuery e o Bootstrap JavaScript para funcionalidades adicionais -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
