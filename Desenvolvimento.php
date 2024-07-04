<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Codigo em Desenvolvimento</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="bootstrap/css/style.css" />
</head>

<body onload="carregarOrgaos()" style="overflow-x: hidden;">

    <nav class="navbar navbar-expand-lg justify-content-center bg-dark">
        <div class="d-flex flex-column align-items-center">
            <img src="img/LogoTetoBrasil.png" alt="Logo" height="110px" />
            <h4 class="text-light mt-2">Pagina para o aprendizado de manipulação de dados com AJAX,PHP,BOOTSTRAP e JQUERY (o aplicativo não preenche o cartão ao lado) </h4>
        </div>
    </nav>

    <form id="formulario" name="formulario" method="POST">
        <div class="row">
            <div class="col-lg-6 mt-1">
                <div class="p-3">


                    <label for="orgao">Orgão:</label>
                    <select class="form-control" id="orgao" name="orgao" onchange="atualizarDados()">
                        <option>Escolher opção</option>
                    </select>

                    <div class="form-row">
                        <div class="form-group col-md-11">
                            <label for="nome">Nome* : </label>
                            <input type="text" required placeholder="campo obrigatorio para gravação" class="form-control" id="nome" name="nome">
                        </div>

                        <div class="form-group col-md-1 d-flex align-items-end">
                            <button type="button" id="openModalButton" class="btn btn-light ml-2" data-toggle="modal" data-target="#exampleModal">
                                <img src="img/search.svg" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefonePessoal">Telefone Pessoal:</label>
                            <input type="text" class="form-control" id="telefonePessoal" name="telefonePessoal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label><br />
                        <input onblur="buscarNoBancoDadosCEP()" placeholder="Só Numeros" type="text" style="width: 30%" class="form-control" id="cep" name="cep">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="endereco">Endereço Comercial:</label><br />
                            <input type="text" class="form-control" id="endereco" name="endereco">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero">Número:</label>
                            <input type="text" class="form-control" id="numero" name="numero">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="complemento">Complemento:</label><br />
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bairro">Bairro:</label>
                            <input type="text" class="form-control" id="bairro" name="bairro">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="uf">UF:</label><br />
                            <input type="text" class="form-control" value="Paraná" id="uf" name="uf">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="municipio">Municipio:</label><br />
                            <input type="text" class="form-control" id="municipio" name="municipio">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="pais">Pais:</label><br />
                            <input type="text" class="form-control" value="Brasil" id="pais" name="pais">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="telefoneComercial">Telefone Comercial:</label><br />
                            <input type="text" class="form-control" id="telefoneComercial" name="telefoneComercial">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="url">Site:</label>
                            <input type="text" class="form-control" id="url" name="url" style="background-color: white;" readonly>
                        </div>
                    </div>
    </form>

            <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Formato do arquivo final:</label>
                                <div class="form-check">
                                    <input type="radio" id="cartaoIndividual" name="FormatoArquivoFinal" value="CARTAOINDIVIDUAL" class="form-check-input">
                                    <label for="cartaoIndividual" class="form-check-label">Gráfica: Cartão individual</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="folhaA4" name="FormatoArquivoFinal" value="FOLHA4" class="form-check-input">
                                    <label for="folhaA4" class="form-check-label">Impressora: Folha A4</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marca de Corte:</label>
                                <div class="form-check">
                                    <input type="radio" id="MarcaDoCorteSim" name="MarcaDoCorte" value="MARCADOCORTESIM" class="form-check-input">
                                    <label for="MarcaDoCorteSim" class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="MarcaDoCorteNao" name="MarcaDoCorte" value="MARCADOCORTENAO" class="form-check-input">
                                    <label for="MarcaDoCorteNao" class="form-check-label">Não</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mt-md-0 mt-3">
                            <div class="form-group">
                                <label>QRCODE VCard (Verso do Cartão):</label>
                                <div class="form-check">
                                    <input type="radio" id="QrCodeSim" name="QrCode" value="QRCODESIM" class="form-check-input">
                                    <label for="QrCodeSim" class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="QrCodeNao" name="QrCode" value="QRCODENAO" class="form-check-input">
                                    <label for="QrCodeNao" class="form-check-label">Não</label>
                                </div>
                            </div>
                        </div>
                    </div>
            
            </div>
        </div>
    </div>
</form>




    <div class="col-lg-6 mt-4">
        <div class="cartao border p-4 mb-2 margemDireita">
            <img src="img/LogoTetoBrasil.png" width="340px" alt="Logo" class="float-right ml-3" />
            <p>
                <br><br><br><br><br><br><br>
                <h4>[Nome Completo e Sem Abreviações]</h4>
                <h5>[Cargo que Ocupa]</h5><br>
                [E-mail]<br>
                [Telefone Pessoal]<br>
                [Endereço], [Número] - [Complemento] - [Bairro]<br>
                [CEP] - [CIDADE] - Paraná - Brasil<br>
                [Telefone Comercial] - [Url]
            </p>
        </div>
         
        <div class="border p-4 observacoes" style="background-color: #e2e3e573;">
            <h4>observaçoes:</h4>
            <ul>
                <li>Insere dados dentro atraves do formulario;</li>
                <li>A lupa demonstra alguns dados já preenchidos;</li>
                <li>Clicando no nome, todos os dados são preenchidos;</li>
                <li>quando selecionado uma pessoa é possivel editar,apagar e gravar uma nova pessoa usando como base os dados gravados ;</li>
                <li>Caso vc preencher o campo CEP, com um cep já gravado anteriormente da tabela cep,tente 77777777; </li>
            </ul>

        </div>
    </div>
</div>        

    <center class="container mt-4">
        <!-- <button type="button" onclick="gravarPessoa()" class="btn btn-primary d-inline-block">Gravar dados da pessoa</button>  -->

        <button type="submit" onclick="gravarPessoa()" class="btn btn-primary d-inline-block">Gravar dados da pessoa</button>
        <div id="botoesAcoes" class="d-inline-block"><!-- botões de Delete --> </div>
       
        <!--
        <label for="formFile" onclick="" class="form-label"></label>
        <input class="form-control" type="file" id="formFile">
        -->
    </center>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preencher dados automaticamente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table center table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>Email</th>
                                <th>Telefone Pessoal</th>
                                <th>Orgão</th>
                                <th>Endereço</th>
                                <th>Numero</th>
                                <th>Municipio</th>
                            </tr>
                        </thead>
                        <tbody id="modalTableBody">
                            <!-- Dados preenchidos via JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="jQuery/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/scripts.js"></script>
    <script>
        // Associa a função exibirDadosPessoa() ao clique do botão que abre o modal
        $('#openModalButton').on('click', exibirDadosPessoa);

        // Captura o clique em um link de pessoa dentro do modal
        $('#modalTableBody').on('click', '.select-person', function() {
            // Captura os dados da pessoa clicada
            var nome = $(this).data('nome');
            var cargo = $(this).data('cargo');
            var email = $(this).data('email');
            var telefonePessoal = $(this).data('telefone-pessoal');
            var telefoneComercial = $(this).data('telefone-comercial');
            var codigo_cep = $(this).data('codigo_cep');
            var nome_orgao = $(this).data('nome_orgao');
            var url = $(this).data('url');
            var endereco = $(this).data('endereco');
            var numero = $(this).data('numero');
            var complemento = $(this).data('complemento');
            var bairro = $(this).data('bairro');
            var nome_uf = $(this).data('nome_uf');
            var nome_municipio = $(this).data('municipio');

            // Preenche os campos na página index.php
            // Preencher os campos do formulário com os dados da pessoa selecionada
            $('#nome').val($(this).data('nome'));
            $('#cargo').val($(this).data('cargo'));
            $('#email').val($(this).data('email'));
            $('#telefonePessoal').val($(this).data('telefone-pessoal'));
            $('#telefoneComercial').val($(this).data('telefone-comercial'));
            $('#cep').val($(this).data('codigo-cep'));
            $('#orgao').val($(this).data('nome-orgao'));
            $('#url').val($(this).data('url'));
            $('#endereco').val($(this).data('endereco'));
            $('#numero').val($(this).data('numero'));
            $('#complemento').val($(this).data('complemento'));
            $('#bairro').val($(this).data('bairro'));
            $('#uf').val($(this).data('nome_uf'));
            $('#municipio').val($(this).data('nome-municipio'));

            // Fecha o modal após preencher os campos
            $('#exampleModal').modal('hide');
        });

        // Associa a função gravarPessoa() ao clique do botão de gravar pessoa
        $('#btnGravarPessoa').on('click', function() {
            gravarPessoa(); // Função para gravar os dados da pessoa
            limparCampos(); // Função para limpar os campos do formulário após gravar
        });


        document.getElementById("cep").addEventListener("input", function(event) {
            var value = event.target.value;
            // Remove caracteres que não sejam números e limita a 8 dígitos
            event.target.value = value.replace(/[^0-9]/g, '').slice(0, 8);
        });
    </script>
</body>

</html>