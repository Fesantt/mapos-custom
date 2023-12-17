<!DOCTYPE html>
<html lang="pt-br">
<title><?php echo $this->config->item('app_name') ?></title>
   <?php $totalServico = 0;
      ?>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Página com Containers</title>
      <!-- Adicionando os estilos do Bootstrap via CDN -->
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://kit.fontawesome.com/c73597ace5.js" crossorigin="anonymous"></script>
      <style>
         body {
         background-color: rgba(1, 7, 23, 0.77);
         color: white;
         }
         .center-container {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         }
         .container-glass {
         background-color: rgba(0, 0, 0, 0.5);
         box-shadow: inset -8px -8px 0px 0px rgba(0, 0, 0, 0.3);
         border-radius: 10px;
         padding: 20px;
         margin-bottom: 20px;
         color: #ffffff;
         }
         .card {
         background-color: transparent !important;
         border: none !important;
         }
         .container-glass th,
         .container-glass td {
         color: #ffffff;
         line-height: 2;
         padding: 5px;
         }
         .card-title-cliente {
         font-size: 32px;
         }
      </style>
   </head>
   <body>
      <div class="container center-container">
         <div class="row">
            <div class="col-md-6 mb-3">
               <div class="container-glass">
                  <div class="card">
                     <div class="card-body">
                        <td style="width: 10%"><img style="width: 70%" src=" <?php echo $emitente->url_logo; ?> "
                           style="max-height: 100px"></td>
                        <br>
                        <h5 class="card-title"></h5>
                        <strong class="card-text">
                        <?php echo $emitente->nome; ?>
                        </strong><br>
                        <strong class="card-text">CNPJ:
                        <?php echo $emitente->cnpj; ?>
                        </strong><br>
                        <strong class="card-text">Telefone:
                        <?php echo $emitente->telefone; ?>
                        </strong><br>
                        <strong class="card-text">E-mail:
                        <?php echo $emitente->email; ?>
                        </strong><br>
                        <strong class="card-text">Rua:
                        <?php echo $emitente->rua; ?>
                        </strong><br>
                        <strong class="card-text">Bairro:
                        <?php echo $emitente->bairro; ?>
                        </strong><br>
                        <strong class="card-text">Cidade:
                        <?php echo $emitente->cidade; ?>
                        </strong><br>
                        <strong class="card-text">CEP:
                        <?php echo $emitente->cep; ?>
                        </strong><br>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 mb-3">
               <div class="container-glass">
                  <div class="card">
                     <div class="card-body cliente">
                        <h3 class="card-title-cliente">
                        CLIENTE</h4>
                        <h5 class="card-title"></h5>
                        <strong class="card-text">Nome:
                        <?php echo $result->nomeCliente; ?>
                        </strong><br>
                        <strong class="card-text">CPF:
                        <?php echo $result->documento; ?>
                        </strong><br>
                        <strong class="card-text">Telefone:
                        <?php echo $result->telefone; ?>
                        </strong><br>
                        <strong class="card-text">Celular:
                        <?php echo $result->celular; ?>
                        </strong><br>
                        <strong class="card-text">Email:
                        <?php echo $result->email; ?>
                        </strong><br><br><br>
                     <?php if ($result->status == 'Orçamento'): ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                           data-target="#modalOrcamento">
                        <i class="fas fa-check"></i> Aceitar Orçamento
                        </button>
                        <?php endif; ?>
                        <?php if ($result->status == 'Aprovado'): ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                           data-target="#modalPagamento">
                        <i class="fas fa-qrcode"></i> Pagar
                        </button>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 mb-3">
               <div class="container-glass">
                  <div class="card">
                     <h5 class="card-title">Ordem de serviço</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Data inicial</th>
                                 <th>Prev. Entrega</th>
                                 <th>Status</th>
                                 <th>Total</th>
                                 <th>Ações</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <?php echo $result->idOs; ?>
                                 </td>
                                 <td>
                                    <?php echo $result->dataInicial; ?>
                                 </td>
                                 <td>
                                    <?php echo $result->dataFinal; ?>
                                 </td>
                                 <td>
                                    <?php echo $result->status; ?>
                                 </td>
                                 <?php
                                    $valorTotal = 0;
                                    foreach ($produtos as $p) {
                                        $subTotal = is_numeric($p->subTotal) ? $p->subTotal : 0;
                                        $valorTotal += $subTotal;
                                    }
                                    $totalFormatado = number_format($valorTotal, 2, ',', '.');
                                    ?>
                                 <?php
                                    $valorTotalservisos = 0;
                                    foreach ($servicos as $s) {
                                        $subTotal = is_numeric($s->subTotal) ? $s->subTotal : 0;
                                        $valorTotalservisos += $subTotal;
                                    }
                                    $totalFormatadoServicos = number_format($valorTotalservisos, 2, ',', '.');
                                    ?>
                                 <td>
                                    <?php echo 'R$ ' . number_format(($valorTotal + $valorTotalservisos), 2, ',', '.'); ?>
                                 </td>
                                 <td>
                                    <a href="<?php echo base_url("index.php/ordem/visualizar??=" . $result->tokenOs); ?>"
                                       style="color: white; background-color: rgba(0, 161, 186, 1); padding: 5px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                    <i class="fa-regular fa-eye" style="margin-right: 5px;"></i> Visualizar
                                    </a>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- modal orçamento -->
      <div class="modal fade" id="modalOrcamento" tabindex="-1" role="dialog" aria-labelledby="modalOrcamentoLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalOrcamentoLabel"
                     style="color: black; font-size: 20px; text-decoration: none;">Aceitar Orçamento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <a style="color: black; font-size: 20px; text-decoration: none;">Ao aceitar o orçamento você está
                  ciente que isso irá gerar custos.</a>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <form id="approvalForm" method="post" action="<?php echo base_url('index.php/ordem/aprovarOs'); ?>">
                     <!-- Seus campos de formulário -->
                     <input type="hidden" name="tokenOs" value="<?php echo $result->tokenOs; ?>">
                     <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <!-- modal orçamento -->
      <div class="modal fade" id="modalPagamento" tabindex="-1" role="dialog" aria-labelledby="modalPagamentoLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalPagamentoLabel"
                     style="color: black; font-size: 20px; text-decoration: none;">Fazer Pagamento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <?php if ($qrCode): ?>
                  <td style="width: 15%; padding-left: 0">
                     <a
                        style="color: black; font-size: 20px; text-decoration: none; display: block; text-align: center; margin-top: 10px;">
                     QR-CODE
                     </a>
                     <div style="text-align: center;">
                        <img style="margin: 6px 12px 2px 0px; display: inline-block;" width="94"
                           src="<?= $qrCode ?>" alt="QR Code de Pagamento" />
                     </div>
                     <div>
                        <a
                           style="color: black; font-size: 20px; text-decoration: none; display: block; text-align: center; margin-top: 10px;">
                        Chave Pix:
                        <?= $pix_key; ?>
                        </a>
                     </div>
                  </td>
                  <?php endif ?>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <form id="approvalForm">
                     <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script>
         $(document).ready(function () {
             $("#approvalForm").submit(function (event) {
                 event.preventDefault();
                 var formData = new FormData(this);
                 $.ajax({
                     type: "POST",
                     url: $(this).attr("action"),
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function (response) {
                         console.log(response);
                         $("#exampleModal").modal("hide");
                         window.history.back();
                     },
                     error: function (error) {
                         console.error(error);
                     }
                 });
             });
         });
      </script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   </body>
</html>