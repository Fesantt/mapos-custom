<?php $totalServico = 0;
   $totalProdutos = 0; ?>
<!DOCTYPE html>
<html lang="pt-br">
   <?php
      $baseURL = base_url(). 'index.php/os/visualizar/' ;
      $idOs = $result->idOs;
      $qrCodeURL = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=$baseURL$idOs";
      ?>
   <head>
      <title>Map_OS_<?php echo $result->idOs ?>_<?php echo $result->nomeCliente ?></title>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
      <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
      <link href="<?= base_url('assets/css/custom.css'); ?>" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
      <style>
         .table {
         width: 72mm;
         margin: auto;
         }
      </style>
   </head>
   <body id=body class="body">
      <div id ="principal">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">
                  <div class="invoice-content">
                     <div class="invoice-head" style="margin-bottom: 0">
                        <table class="table table-condensed">
                           <tbody>
                              <tr>
                              </tr>
                           </tbody>
                        </table>
                        <table class="table table-condensed" style="height: 100px;">
                           <tr>
                              <td style="width: 4%; padding-left: 0; font-size: 11px;">
                                 <table>
                                 <span>  <?php echo $result->nomeCliente ?></span>
                                 <b > N° OS: </b><span><?php echo $result->idOs ?></span>
                                    <td>
                                       <img src="<?php echo $qrCodeURL; ?>" alt="QR Code" class="qrcode" style="max-height: 100px; display: block;">
                                    </td>
                                    <td>
                                       <?php if (!empty($result->contato_cliente)) : ?>
                                       <?php endif; ?>
                                       <?php if (!empty($result->celular_cliente) || !empty($result->telefone_cliente)) : ?>                  
                                       <span><b>Fone: </b> <?php if (!empty($result->telefone_cliente) && $result->celular_cliente != $result->telefone_cliente) : ?>
                                       <?php echo $result->telefone_cliente; ?> / 
                                       <?php endif; ?>
                                       <?php echo $result->celular_cliente; ?></span><br>
                                       <?php endif; ?>
                                       <b>Entrada: </b><?php echo date('d/m/Y', strtotime($result->dataInicial)); ?><br>
                                       <b>Prev. Saída: </b><?php echo $result->dataFinal ? date('d/m/Y', strtotime($result->dataFinal)) : ''; ?><hr>
                                       <span><b>Emissão:</b> <?php echo date('d/m/Y') ?></span>
                                       <!-- <span><b>Status: </b><?php echo $result->status ?></span> -->
                                 </table>
                              </td>
                        </table>
                     </div>
                        <style>
                           .qrcode {
                           display: block; 
                           margin: 0 auto; 
                           width: 100px; 
                           height: 100px; 
                          
                           }
                        </style>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/matrix.js"></script>
</html>