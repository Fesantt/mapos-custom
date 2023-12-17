<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/trumbowyg/ui/trumbowyg.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/trumbowyg/langs/pt_br.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
<style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    #floating-button {
      position: fixed;
      bottom: 40px;
      right: 40px;
      border-radius: 50%;
      background-color: #118e21;
      color: #fff;
      border: none;
      font-size: 45px;
      cursor: pointer;
      z-index: 1000; /* Defina um valor alto para garantir que fique acima de outros elementos */
    }

    #expanded-buttons {
      display: none;
      position: fixed;
      bottom: 100px;
      right: 20px;
      font-size: 45px;
      z-index: 1000; /* Defina um valor alto para garantir que fique acima de outros elementos */
    }

    .expanded-button {
      background-color: #169513;
      color: #fff;
      border: none;
      padding: 10px;
      margin-top: 10px;
      border-radius: 30%;
      cursor: pointer;
      display: block;
    }
  </style>
  <button id="floating-button" onclick="toggleButtons()"><i class='bx bx-plus'></i></button>
<div id="expanded-buttons">
  <button id="addclientes" class="expanded-button" onclick="openModal('addclientes')"><i class='bx bxs-user' ></i></button>
  <button id="addProdutos" class="expanded-button" onclick="openProdutos('addProdutos')"><i class='bx bxs-barcode'></i></button>
  <button id="addServicos" class="expanded-button" onclick="openServico('addServicos')"><i class='bx bxs-wrench'></i></button>
</div>
<!-- Modal clientes -->
<div id="modal">
    <div class="modal-content">
      <h2>Adicionar Cliente</h2>
      <form id="addClientForm" onsubmit="submitForm(event)">
        <div class="control-group">
            <div class="controls">
                <input id="documento" class="cpfcnpj" placeholder="CPF/CNPJ" type="text" name="documento" value="<?php echo set_value('documento'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="nomeCliente" type="text" placeholder="Nome/Razão social" name="nomeCliente" value="<?php echo set_value('nomeCliente'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="telefone" type="text"placeholder="Telefone" name="telefone" value="<?php echo set_value('telefone'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="celular" type="text" placeholder="Celular" name="celular" value="<?php echo set_value('celular'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="email" type="text" placeholder="E-mail" name="email" value="<?php echo set_value('email'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input class="form-control" placeholder="Senha" id="senha" type="password" name="senha" value="<?php echo set_value('senha'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="fornecedor" class="btn btn-default">Fornecedor
                    <input type="checkbox" id="fornecedor" name="fornecedor" class="badgebox" value="0">
                    <span class="badge">&check;</span>
                </label><br><br>
                <button type="submit" class="btn btn-primary">Adicionar Cliente</button>
                <button type="button" onclick="closeModal()" class="btn btn-danger">Fechar</button>
            </div>
        </div>
    </div>
      </form>
    </div>
  </div>
 <!-- modal produtos -->
  <div id="modalProduto">
    <div class="modal-content">
      <h2>Adicionar Produto</h2>
      <form id="addProdutoForm" onsubmit="submitFormProduto(event)">
      <div class="control-group">
            <div class="controls">
                <input id="codDeBarra" placeholder="COD. Barras" type="text" name="codDeBarra" value="<?php echo set_value('codDeBarra'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="descricao" type="text" placeholder="Nome do Produto" name="descricao" required value="<?php echo set_value('descricao'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                    <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked>
                    <span class="badge">&check;</span>
                </label>
                <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                    <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
                    <span class="badge">&check;</span>
                </label>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input style="width: 9em;" id="precoCompra"  required placeholder="Preço de Compra" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>" />
                Margem <input style="width: 3em;" id="margemLucro" name="margemLucro" type="text" placeholder="%" maxlength="3" size="2" />
                <strong><span style="color: red" id="errorAlert"></span><strong>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="precoVenda" class="money" placeholder="Preço de Venda" required data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="estoque" type="text" required placeholder="Estoque" name="estoque" value="<?php echo set_value('estoque'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="unidade" type="text"required placeholder="unidade" name="unidade" value="UN" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input id="estoqueMinimo" type="text" required placeholder="Estoque Minimo" name="estoqueMinimo" value="<?php echo set_value('estoqueMinimo'); ?>" />
            </div>
        </div>
    <button type="submitProdutos" class="btn btn-primary">Adicionar</button>
    <button type="button" onclick="closeProduto()" class="btn btn-danger">Fechar</button>
    </div>
    </form>
    </div>
    </div>

    <!-- Modal servicos -->

    <div id="modalServico">
    <div class="modal-content">
        <h2>Adicionar Serviço</h2>
        <form id="addServicoForm" onsubmit="submitFormServico(event)">
            <div class="control-group">
                <div class="controls">
                    <input id="nome" type="text" placeholder="Nome do Serviço" name="nome" value="<?php echo set_value('nome'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input id="preco" class="money" placeholder="Valor em R$" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="preco" value="<?php echo set_value('preco'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input id="descricao" type="text" placeholder="Descrição (...)"  name="descricao" value="<?php echo set_value('descricao'); ?>" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <button type="button" onclick="closeServico()" class="btn btn-danger">Fechar</button>
        </form>
    </div>
</div>

  <style>
    /* Estilos dos modal ... */
    #modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    #modalProduto {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    #modalServico {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }


    #modal .modal-content {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }
    #modalProduto .modal-content {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }
    #modalServico .modal-content {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }

    #modal form input {
      margin: 10px;
    }
    #modalProduto form input {
      margin: 10px;
    }
    #modalServico form input {
      margin: 10px;
    }
  </style>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <h5>Cadastro de OS</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">

                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da OS</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="span12" id="divCadastrarOs">
                                <?php if ($custom_error == true) { ?>
                                    <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente, responsável e garantia.<br />Ou se tem um cliente e um termo de garantia cadastrado.</div>
                                <?php
                                } ?>
                                <form action="<?php echo current_url(); ?>" method="post" id="formOs">
                                    <div class="span12" style="padding: 1%">
                                        <div class="span6">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value="" />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="" />
                                        </div>
                                        <div class="span6">
                                            <label for="tecnico">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?= $this->session->userdata('nome_admin'); ?>" />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?= $this->session->userdata('id_admin'); ?>" />
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="status">Status<span class="required">*</span></label>
                                            <select class="span12" name="status" id="status" value="">
                                                <option value="Orçamento">Orçamento</option>
                                                <option value="Aberto">Aberto</option>
                                                <option value="Em Andamento">Em Andamento</option>
                                                <option value="Finalizado">Finalizado</option>
                                                <option value="Cancelado">Cancelado</option>
                                                <option value="Aguardando Peças">Aguardando Peças</option>
                                                <option value="Aprovado">Aprovado</option>
                                            </select>
                                        </div>
                                        <div class="span3">
                                            <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                            <input id="dataInicial" autocomplete="off" class="span12 datepicker" type="text" name="dataInicial" value="<?php echo date('d/m/Y'); ?>" />
                                        </div>
                                        <div class="span3">
                                            <label for="dataFinal">Data Final<span class="required">*</span></label>
                                            <input id="dataFinal" autocomplete="off" class="span12 datepicker" type="text" name="dataFinal" value="" />
                                        </div>
                                        <div class="span3">
                                            <label for="garantia">Garantia (dias)</label>
                                            <input id="garantia" type="number" placeholder="Status s/g inserir nº/0" min="0" max="9999" class="span12" name="garantia" value="" />
                                            <?php echo form_error('garantia'); ?>
                                            <label for="termoGarantia">Termo Garantia</label>
                                            <input id="termoGarantia" class="span12" type="text" name="termoGarantia" value="" />
                                            <input id="garantias_id" class="span12" type="hidden" name="garantias_id" value="" />
                                        </div>
                                    </div>
                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="descricaoProduto">
                                            <h4>Descrição Produto/Serviço</h4>
                                        </label>
                                        <textarea class="span12 editor" name="descricaoProduto" id="descricaoProduto" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="defeito">
                                            <h4>Defeito</h4>
                                        </label>
                                        <textarea class="span12 editor" name="defeito" id="defeito" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="observacoes">
                                            <h4>Observações</h4>
                                        </label>
                                        <textarea class="span12 editor" name="observacoes" id="observacoes" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="span6" style="padding: 1%; margin-left: 0">
                                        <label for="laudoTecnico">
                                            <h4>Laudo Técnico</h4>
                                        </label>
                                        <textarea class="span12 editor" name="laudoTecnico" id="laudoTecnico" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="display:flex">
                                            <button class="button btn btn-success" id="btnContinuar">
                                              <span class="button__icon"><i class='bx bx-chevrons-right'></i></span><span class="button__text2">Continuar</span></button>
                                            <a href="<?php echo base_url() ?>index.php/os" class="button btn btn-mini btn-warning" style="max-width: 160px">
                                              <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                .
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 1,
            select: function(event, ui) {
                $("#clientes_id").val(ui.item.id);
            }
        });
        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 1,
            select: function(event, ui) {
                $("#usuarios_id").val(ui.item.id);
            }
        });
        $("#termoGarantia").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteTermoGarantia",
            minLength: 1,
            select: function(event, ui) {
                $("#garantias_id").val(ui.item.id);
            }
        });

        $("#formOs").validate({
            rules: {
                cliente: {
                    required: true
                },
                tecnico: {
                    required: true
                },
                dataInicial: {
                    required: true
                },
                dataFinal: {
                    required: true
                }

            },
            messages: {
                cliente: {
                    required: 'Campo Requerido.'
                },
                tecnico: {
                    required: 'Campo Requerido.'
                },
                dataInicial: {
                    required: 'Campo Requerido.'
                },
                dataFinal: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
        $(".datepicker").datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $('.editor').trumbowyg({
            lang: 'pt_br'
        });
    });
</script>


<!-- JS do botão flutuante -->
<script>
  function toggleButtons() {
    var expandedButtons = document.getElementById("expanded-buttons");
    expandedButtons.style.display = (expandedButtons.style.display === "block") ? "none" : "block";
  }

  function doSomething() {
    // Implement the functionality for the first button here
    console.log("Button 1 clicked");
  }

  function doSomethingElse() {
    // Implement the functionality for the second button here
    console.log("Button 2 clicked");
  }

  function doAnotherThing() {
    // Implement the functionality for the third button here
    console.log("Button 3 clicked");
  }
</script>
<script>
    function openModal(buttonId) {
      var modal = document.getElementById("modal");
      modal.style.display = "flex";

      // Adicione o ID do botão atual ao formulário como um atributo personalizado
      var form = document.getElementById("addClientForm");
      form.setAttribute("data-source-button", buttonId);
    }

    function closeModal() {
      var modal = document.getElementById("modal");
      modal.style.display = "none";
    }

    function submitForm(event) {
      event.preventDefault(); // Impede o envio do formulário padrão

      // Recupere o ID do botão que acionou o modal
      var form = document.getElementById("addClientForm");
      var buttonId = form.getAttribute("data-source-button");

      // Aqui você pode adicionar a lógica para enviar a solicitação POST
      // Use a função fetch ou outra biblioteca para enviar os dados ao seu backend
      // Exemplo usando fetch:
      var formData = new FormData(form);

      fetch('/index.php/clientes/adicionar', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        // Lógica para lidar com a resposta do servidor
        console.log('Cliente adicionado com sucesso!');
        closeModal(); // Fecha o modal após adicionar o cliente
      })
      .catch(error => {
        console.error('Erro ao adicionar cliente:', error);
      });
    }
  </script>

<!-- JS Modal Clientes -->
<script>
    function openModal(buttonId) {
      var modal = document.getElementById("modal");
      modal.style.display = "flex";

      // Adicione o ID do botão atual ao formulário como um atributo personalizado
      var form = document.getElementById("addClientForm");
      form.setAttribute("data-source-button", buttonId);
    }

    function closeModal() {
      var modal = document.getElementById("modal");
      modal.style.display = "none";
    }

    function clearForm() {
        var form = document.getElementById("addClienteForm");
        form.reset();
    }


    function submitForm(event) {
      event.preventDefault(); // Impede o envio do formulário padrão

      // Recupere o ID do botão que acionou o modal
      var form = document.getElementById("addClientForm");
      var buttonId = form.getAttribute("data-source-button");

      // Aqui você pode adicionar a lógica para enviar a solicitação POST
      // Use a função fetch ou outra biblioteca para enviar os dados ao seu backend
      // Exemplo usando fetch:
      var formData = new FormData(form);

      fetch('/index.php/clientes/adicionar', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        // Lógica para lidar com a resposta do servidor
        console.log('Cliente adicionado com sucesso!');
        var successMessage = document.createElement('div');
        successMessage.className = 'alert alert-success';
        successMessage.textContent = 'Produto adicionado com sucesso!';
        closeModal(); // Fecha o modal após adicionar o cliente
        clearForm();
      })
      .catch(error => {
        console.error('Erro ao adicionar cliente:', error);
      });
    }
  </script>

<!-- js modal produtos -->
<script>
    function openProdutos(buttonId) {
      var modal = document.getElementById("modalProduto");
      modal.style.display = "flex";

      // Adicione o ID do botão atual ao formulário como um atributo personalizado
      var form = document.getElementById("addProdutoForm");
      form.setAttribute("data-source-button", buttonId);
    }

    function closeProduto() {
      var modal = document.getElementById("modalProduto");
      modal.style.display = "none";
    }

    function clearForm() {
        var form = document.getElementById("addProdutoForm");
        form.reset();
    }


    function submitFormProduto(event) {
      event.preventDefault(); // Impede o envio do formulário padrão

      // Recupere o ID do botão que acionou o modal
      var form = document.getElementById("addProdutoForm");
      var buttonId = form.getAttribute("data-source-button");

      // Aqui você pode adicionar a lógica para enviar a solicitação POST
      // Use a função fetch ou outra biblioteca para enviar os dados ao seu backend
      // Exemplo usando fetch:
      var formData = new FormData(form);

      fetch('/index.php/Produtos/adicionar', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        // Lógica para lidar com a resposta do servidor
        console.log('Produtoe adicionado com sucesso!');
        
         closeProduto();
         clearForm();
      })
      .catch(error => {
        console.error('Erro ao adicionar Produtoe:', error);
      });
    }
  </script>

<script type="text/javascript">
    function calcLucro(precoCompra, margemLucro) {
        var precoVenda = (precoCompra * margemLucro / 100 + precoCompra).toFixed(2);
        return precoVenda;
    }
    $("#precoCompra").focusout(function() {
        if ($("#precoCompra").val() == '0.00' && $('#precoVenda').val() != '') {
            $('#errorAlert').text('Você não pode preencher valor de compra e depois apagar.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
            $("#precoCompra").focus();
        } else {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
        }
    });

    $("#margemLucro").keyup(function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
        if ($("#precoCompra").val() == null || $("#precoCompra").val() == '') {
            $('#errorAlert').text('Preencher valor da compra primeiro.').css("display", "inline").fadeOut(5000);
            $('#margemLucro').val('');
            $('#precoVenda').val('');
            $("#precoCompra").focus();

        } else if (Number($("#margemLucro").val()) >= 0) {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
        } else {
            $('#errorAlert').text('Não é permitido número negativo.').css("display", "inline").fadeOut(5000);
            $('#margemLucro').val('');
            $('#precoVenda').val('');
        }
    });

    $('#precoVenda').focusout(function () {
        if (Number($('#precoVenda').val()) < Number($("#precoCompra").val())) {
            $('#errorAlert').text('Preço de venda não pode ser menor que o preço de compra.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
            if ($("#margemLucro").val() != "" || $("#margemLucro").val() != null) {
                $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#margemLucro").val())));
            }
        }

    });

    $(document).ready(function() {
        
        $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
            for (i in data.medidas) {
                $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
            }
        });
        $('#formProduto').validate({
            rules: {
                descricao: {
                    required: true
                },
                
                precoCompra: {
                    required: true
                },
                precoVenda: {
                    required: true
                },
                estoque: {
                    required: true
                }
            },
            messages: {
                descricao: {
                    required: 'Campo Requerido.'
                },
                unidade: {
                    required: 'Campo Requerido.'
                },
                precoCompra: {
                    required: 'Campo Requerido.'
                },
                precoVenda: {
                    required: 'Campo Requerido.'
                },
                estoque: {
                    required: 'Campo Requerido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>

<!-- JS modal Serviços -->

<script>
    function openServico(buttonId) {
        var modal = document.getElementById("modalServico");
        modal.style.display = "flex";

        // Adicione o ID do botão atual ao formulário como um atributo personalizado
        var form = document.getElementById("addServicoForm");
        form.setAttribute("data-source-button", buttonId);
    }

    function closeServico() {
        var modal = document.getElementById("modalServico");
        modal.style.display = "none";
    }

    function clearForm() {
        var form = document.getElementById("addServicoForm");
        form.reset();
    }

    function submitFormServico(event) {
        event.preventDefault(); // Impede o envio do formulário padrão

        // Recupere o ID do botão que acionou o modal
        var form = document.getElementById("addServicoForm");
        var buttonId = form.getAttribute("data-source-button");

        // Aqui você pode adicionar a lógica para enviar a solicitação POST
        // Use a função fetch ou outra biblioteca para enviar os dados ao seu backend
        // Exemplo usando fetch:
        var formData = new FormData(form);

        fetch('/index.php/Servicos/adicionar', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                // Lógica para lidar com a resposta do servidor
                console.log('Serviço adicionado com sucesso!');

                // Fecha o modal após adicionar o Serviço
                closeServico();
                // Limpar os campos do formulário
                clearForm();
            })
            .catch(error => {
                console.error('Erro ao adicionar Serviço:', error);
            });
    }
</script>