function funfou() {
    alert('funfou');
}

// Função para buscar dados de um órgão no banco de dados
function buscarNoBanco() {
    var orgaoSelect = document.getElementById("orgao");
    var nome_orgao = orgaoSelect.value;

    // Verifica se o nome_orgao está presente e é válido
    if (nome_orgao !== "") {
        var xhr = new XMLHttpRequest();
        // Configura a requisição GET para buscarURL.php, passando nome_orgao como parâmetro na URL
        xhr.open("GET", "buscarURL.php?nome_orgao=" + encodeURIComponent(nome_orgao), true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Converte a resposta do servidor (que é texto) para um objeto JavaScript usando JSON.parse
                var response = JSON.parse(xhr.responseText);

                if (response.url) {
                    // Se houver, atualiza o valor do campo de input com id "url" com o URL recebido
                    document.getElementById("url").value = response.url;
                } else {
                    alert("URL não encontrada para o órgão selecionado.");
                }
            }
        };

        xhr.send();
    } else {
        alert("Por favor, selecione um órgão.");
    }
}

// Função para buscar dados de endereço por CEP
function buscarNoBancoDadosCEP() {
    var idCep = document.getElementById('cep').value;

    // Verifica se o CEP foi digitado
    console.log('Iniciando requisição AJAX para buscarEndereco.php');
    console.log('CEP digitado:', idCep);

    // Requisição AJAX para buscar os dados de endereço
    $.getJSON('php/buscarEndereco.php', { codigo_cep: idCep }, function(data) {
        console.log('Resposta recebida do servidor:', data);

        if (data.success) {
            console.log('Dados recebidos:', data);

            // Preenche os campos de endereço com os dados recebidos
            $("#endereco").val(data.endereco);
            $("#bairro").val(data.bairro);
            $("#uf").val(data.nome_uf);
            $("#municipio").val(data.municipio);
            $("#numero").val(data.numero);
            $("#complemento").val(data.complemento);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('Erro na requisição: ' + textStatus);
        console.log('Erro na requisição:', textStatus, errorThrown);
    });
}

// Função para carregar a lista de órgãos
function carregarOrgaos() {
    $.getJSON('php/orgaos.php', function(data) {
        var orgaoSelect = $('#orgao');
        orgaoSelect.empty();
        orgaoSelect.append('<option value="">Escolher opção</option>');

        // Itera sobre os dados recebidos para adicionar opções ao select de órgãos
        $.each(data, function(index, orgao) {
            orgaoSelect.append('<option value="' + orgao.id_orgao + '">' + orgao.nome_orgao + '</option>');
        });
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Erro ao carregar os órgãos: " + textStatus + " - " + errorThrown);
    });
}

// Função para atualizar os dados do órgão selecionado
function atualizarDados() {
    var orgaoId = $('#orgao').val();

    if (orgaoId === "") {
        $('#url').val('');
        return;
    }

    $.getJSON('php/orgaos.php', { id_orgao: orgaoId }, function(data) {
        if (data.error) {
            console.log("Erro: " + data.error);
        } else {
            $('#url').val(data.url);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Erro ao atualizar os dados: " + textStatus + " - " + errorThrown);
    });
}

function limparCampos() {
    document.getElementById('nome').value = '';
    document.getElementById('cargo').value = '';
    document.getElementById('email').value = '';
    document.getElementById('telefonePessoal').value = '';
    document.getElementById('telefoneComercial').value = ''; 
    document.getElementById('cep').value = '';
    document.getElementById('orgao').value = '';
    document.getElementById('endereco').value = '';
    document.getElementById('numero').value = '';
    document.getElementById('complemento').value = '';
    document.getElementById('bairro').value = '';
    document.getElementById('uf').value = '';
    document.getElementById('municipio').value = '';
    document.getElementById('url').value = '';
}

// Função para gravar pessoa no banco de dados
function gravarPessoa() {
    $.ajax({
        type: 'POST',
        url: 'php/gravarPessoa.php',
        data: $("#formulario").serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Pessoa gravada com sucesso!');
                limparCampos();
                // Esconde os botões de ação
                $('.delete-person-acao').hide();
                $('.charge-person-acao').hide();
            } else {
                alert('Erro ao gravar pessoa: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            alert('Erro na requisição: ' + status);
            console.log(xhr.responseText);
        }
    });
}

// Função para exibir dados das pessoas em uma tabela
function exibirDadosPessoa() {
    $.ajax({
        url: 'php/mostrarPessoas.php',
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            var tableBody = $('#modalTableBody');
            tableBody.empty();

            var botoesAcoes = $('#botoesAcoes');
            botoesAcoes.empty();

            response.forEach(function(person) {
                var orgaoNome = person.nome_orgao || "";

                var row = '<tr>' +
                    '<td><a href="#" class="select-person" ' +
                    'data-id="' + person.id_pessoa + '" ' +
                    'data-nome="' + person.nome + '" ' +
                    'data-cargo="' + person.cargo + '" ' +
                    'data-email="' + person.email + '" ' +
                    'data-telefone-pessoal="' + person.telefone_pessoal + '" ' +
                    'data-telefone-comercial="' + person.telefone_comercial + '" ' +
                    'data-codigo-cep="' + person.codigo_cep + '" ' +
                    'data-nome-orgao="' + person.nome_orgao + '" ' +
                    'data-nome-orgao-original="' + person.nome_orgao + '" ' +
                    'data-url="' + person.url_orgao + '" ' +
                    'data-endereco="' + person.endereco + '" ' +
                    'data-numero="' + person.numero + '" ' +
                    'data-complemento="' + person.complemento + '" ' +
                    'data-bairro="' + person.bairro + '" ' +
                    'data-nome_uf="' + person.nome_uf + '" ' +
                    'data-nome-municipio="' + person.nome_municipio + '">' +
                    person.nome + '</a></td>' +
                    '<td>' + person.cargo + '</td>' +
                    '<td>' + person.email + '</td>' +
                    '<td>' + person.telefone_pessoal + '</td>' +
                    '<td>' + orgaoNome + '</td>' +
                    '<td>' + person.endereco + '</td>' +
                    '<td>' + person.numero + '</td>' +
                    '<td>' + person.nome_municipio + '</td>' +
                    '</tr>';

                tableBody.append(row);
            });

            // Botões de ação (inicialmente escondidos)
            var deleteButton = $('<button type="button" class="btn btn-danger delete-person-acao">Deletar</button>');
            deleteButton.hide();
            var chargeButton = $('<button type="button" class="btn btn-secondary charge-person-acao">Mudar dados</button>');
            chargeButton.hide();

            // Evento de click para selecionar pessoa
            tableBody.find('.select-person').on('click', function() {
                // Remove a classe 'active' de todos os links de pessoa
                tableBody.find('.select-person').removeClass('active');
                // Adiciona a classe 'active' ao link de pessoa clicado
                $(this).addClass('active');

                // Mostra os botões apenas quando uma pessoa é selecionada
                deleteButton.show();
                chargeButton.show();
            });

            // Adicionar botão de deletar
            deleteButton.on('click', function() {
                var id_pessoa = $('#modalTableBody').find('.select-person.active').data('id');
                if (id_pessoa) {
                    apagarPessoa(id_pessoa, function(success) {
                        if (success) {
                            deleteButton.hide();
                            chargeButton.hide();
                        }
                    });
                } else {
                    alert('Selecione uma pessoa para deletar.');
                }
            });

            // Adicionar botão de mudança
            chargeButton.on('click', function() {
                var id_pessoa = $('#modalTableBody').find('.select-person.active').data('id');
                if (id_pessoa) {
                    mudarPessoa(id_pessoa, function(success) {
                        if (success) {
                            deleteButton.hide();
                            chargeButton.hide();
                        }
                    });
                } else {
                    alert('Selecione uma pessoa para mudar.');
                }
            });

            // Adiciona os botões ao final dos dados carregados
            botoesAcoes.append(deleteButton, ' ', chargeButton);

        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar dados das pessoas');
            alert('Erro ao carregar dados das pessoas. Verifique o console para mais detalhes.');
        }
    });
}

// Atribui um evento de click ao botão "Gravar dados da pessoa"
$('#btnGravarPessoa').on('click', function() {
    // Chama a função para gravar pessoa
    gravarPessoa();
    // Esconde os botões de ação quando gravar uma pessoa
    $('.delete-person-acao').hide();
    $('.charge-person-acao').hide();
});




// Função para apagar uma pessoa do banco de dados
function apagarPessoa(id_pessoa, callback) {
    $.ajax({
        url: 'php/apagarPessoa.php',
        method: 'POST',
        data: { id_pessoa: id_pessoa },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Pessoa deletada com sucesso!');
                limparCampos();
                callback(true);
            } else {
                alert('Erro ao tentar deletar a pessoa.');
                callback(false);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição:', error);
            alert('Erro na requisição ao tentar deletar a pessoa.');
            callback(false);
        }
    });
}

// Função para mudar dados da pessoa
function mudarPessoa(id_pessoa, callback) {
    // Coleta os dados atualizados do formulário
    var dadosPessoa = {
        id_pessoa: id_pessoa,
        nome: $('#nome').val(),
        cargo: $('#cargo').val(),
        email: $('#email').val(),
        telefone_pessoal: $('#telefonePessoal').val(),
        telefone_comercial: $('#telefoneComercial').val(),
        codigo_cep: $('#cep').val(),
        nome_orgao: $('#orgao').val(),
        endereco: $('#endereco').val(),
        numero: $('#numero').val(),
        complemento: $('#complemento').val(),
        bairro: $('#bairro').val(),
        nome_uf: $('#uf').val(),
        nome_municipio: $('#municipio').val(),
        url: $('#url').val()
    };

    // Envia uma requisição AJAX para atualizar os dados no banco de dados
    $.ajax({
        url: 'php/mudarPessoa.php',
        method: 'POST',
        data: dadosPessoa,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Dados da pessoa atualizados com sucesso!');
                limparCampos();
                callback(true);
            } else {
                alert('Erro ao atualizar os dados da pessoa: ' + response.error);
                callback(false);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na requisição:', error);
            alert('Erro na requisição ao tentar atualizar os dados da pessoa.');
            callback(false);
        }
    });
}