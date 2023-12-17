<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
<?php $totalServico = 0;
$totalProdutos = 0; ?>
<!DOCTYPE html>
<html lang="pt-br">

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
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 4mm;
            margin: 1mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 0.5cm;
            border: 0px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body style="background-color: rgba(0,0,0,.4)" id=body>
    <div id="principal">
        <div class="book">
            <div class="container-fluid page" id="viaCliente">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="invoice-content">
                                <?php $dataAtual = date('d-m-Y H:i:s');
                                      $enderecoIP = $_SERVER['REMOTE_ADDR']; ?>
                            <p>Consulta realizada Usando o Token: <strong><?= $result->tokenOs; ?></strong> Data: <strong><?=$dataAtual ?></strong> Pelo IP: <strong><?=$enderecoIP?></strong> </p>
                                <div class="invoice-head" style="margin-bottom: 0">
                                    <table class="table table-condensed">
                                        <tbody>
                                            <?php if ($emitente == null) { ?>
                                                <tr>
                                                    <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a>
                                                </tr> <?php } else { ?><td style="width: 20%"><img src=" <?php echo $emitente->url_logo; ?> "></td>
                                                <td>
                                                    <span style="font-size: 17px;"><?php echo $emitente->nome; ?></span></br>
                                                    <span style="font-size: 12px; "><span class="icon"><i class="fas fa-fingerprint" style="margin:5px 1px"></i> <?php echo $emitente->cnpj; ?> </br>
                                                    <span class="icon"><i class="fas fa-map-marker-alt" style="margin:4px 3px"></i><?php echo $emitente->rua . ', ' . $emitente->numero . ', ' . $emitente->bairro . ' - ' . $emitente->cidade . ' - ' . $emitente->uf; ?></span></br>
                                                    <span><span class="icon"><i class="fas fa-comments" style="margin:5px 1px"></i> E-mail: <?php echo $emitente->email . ' - Fone: ' . $emitente->telefone; ?></br>
                                                    <span class="icon"><i class="fas fa-user-check"></i> Responsável: <?php echo $result->nome ?>
                                                    <td style="width: 18%; text-align: center"><b>N° OS:</b> <span><?php echo $result->idOs ?></span></br></br><span>Emissão: <?php echo date('d/m/Y') ?></span></td></span>
                                                </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-condensend">
                                        <tbody>
                                            <tr>
                                                <td style="width: 85%; padding-left: 0">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <h5><b>CLIENTE</b></h5>
                                                                <span><?php echo $result->nomeCliente ?></span><br />
                                                                <?php
                                                                    $retorno_end = array_filter([$result->rua, $result->numero, $result->complemento, $result->bairro]);
                                                                    $endereco = implode(', ', $retorno_end);
                                                                    if (!empty($endereco)) {echo $endereco . '<br>';}
                                                                    if (!empty($result->cidade) || !empty($result->estado) || !empty($result->cep)) { echo "<span>{$result->cidade} - {$result->estado}, {$result->cep}</span><br>";}
                                                                ?>
                                                                <?php if (!empty($result->email)) : ?>
                                                                    <span>E-mail: <?php echo $result->email ?></span><br>
                                                                <?php endif; ?>
                                                                <?php if (!empty($result->celular_cliente) || !empty($result->telefone_cliente) || !empty($result->contato_cliente)  ) : ?>
                                                                    <span>Contato: <?php if (!empty($result->contato_cliente)) : ?><?php echo $result->contato_cliente; ?> <?php endif; ?>
                                                                        <?php if (!empty($result->telefone_cliente) && $result->celular_cliente != $result->telefone_cliente) : ?>
                                                                            <?php echo $result->telefone_cliente; ?> /
                                                                        <?php endif; ?>
                                                                        <?php echo $result->celular_cliente; ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </td>
                                              <?php if ($qrCode) : ?>
                                                <td style="width: 15%; padding-left: 0">
                                                    <img style="margin:12px 0px 2px 7px" src="<?php echo base_url(); ?>assets/img/logo_pix.png" width="64px" alt="QR Code de Pagamento" />
                                                    <img style="margin:6px 12px 2px 0px" width="94" src="<?= $qrCode ?>" alt="QR Code de Pagamento" />
                                                    <button id="copyButton" class="btn btn-success" style="margin-left: 7px;">
                                                    <i class="fas fa-copy"></i> Copiar
                                                    </button>
                                                    <script>
                                                        document.getElementById('copyButton').addEventListener('click', function () {
                                                            var qrCodeSrc = '<?= $qrCode ?>';
                                                            var img = new Image();
                                                            img.src = qrCodeSrc;
                                                            // Wait for the image to load
                                                            img.onload = function () {
                                                                // Create a canvas to draw the image
                                                                var canvas = document.createElement('canvas');
                                                                canvas.width = img.width;
                                                                canvas.height = img.height;
                                                                var ctx = canvas.getContext('2d');
                                                                ctx.drawImage(img, 0, 0);

                                                                // Decode the QR code using jsQR library
                                                                var code = jsQR(ctx.getImageData(0, 0, img.width, img.height).data, img.width, img.height);

                                                                // Check if QR code is successfully decoded
                                                                if (code) {
                                                                    // Copy the decoded content to the clipboard
                                                                    var decodedContent = code.data;
                                                                    navigator.clipboard.writeText(decodedContent)
                                                                        .then(function () {
                                                                            console.log('QR code content copied to clipboard:', decodedContent);
                                                                            alert('Conteúdo do QR code copiado para a área de transferência.');
                                                                        })
                                                                        .catch(function (err) {
                                                                            console.error('Unable to copy QR code content to clipboard', err);
                                                                            alert('Erro ao copiar o conteúdo do QR code para a área de transferência.');
                                                                        });
                                                                } else {
                                                                    console.error('Unable to decode QR code');
                                                                    alert('Erro ao decodificar o QR code.');
                                                                }
                                                            };
                                                        });
                                                    </script>
                                                </td>
                                            <?php endif; ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div style="margin-top: 0; padding-top: 0">
                                    <table class="table table-condensed">
                                        <tbody>
                                            <?php if ($result->dataInicial != null) { ?>
                                                <tr>
                                                    <td>
                                                        <b>STATUS OS: </b>
                                                        <?php echo $result->status ?>
                                                    </td>
                                                    <td>
                                                        <b>DATA INICIAL: </b>
                                                        <?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>
                                                    </td>
                                                    <td>
                                                        <b>DATA FINAL: </b>
                                                        <?php echo $result->dataFinal ? date('d/m/Y', strtotime($result->dataFinal)) : ''; ?>
                                                    </td>
                                                    <?php if ($result->garantia) {
                                                        ?>
                                                        <td>
                                                            <b>GARANTIA: </b>
                                                            <?php echo $result->garantia . ' dia(s)'; ?>
                                                        </td>
                                                    <?php
                                                    } ?>
                                                    <td>
                                                        <b>
                                                            <?php if ($result->status == 'Finalizado') { ?>
                                                                VENC. DA GARANTIA:
                                                        </b>
                                                        <?php echo dateInterval($result->dataFinal, $result->garantia); ?><?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($result->descricaoProduto != null) { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <b>DESCRIÇÃO: </b>
                                                        <?php echo htmlspecialchars_decode($result->descricaoProduto) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($result->defeito != null) { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <b>DEFEITO APRESENTADO: </b>
                                                        <?php echo htmlspecialchars_decode($result->defeito) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($result->observacoes != null) { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <b>OBSERVAÇÕES: </b>
                                                        <?php echo htmlspecialchars_decode($result->observacoes) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($result->laudoTecnico != null) { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <b>LAUDO TÉCNICO: </b>
                                                        <?php echo htmlspecialchars_decode($result->laudoTecnico) ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                     
                        <?php if ($anexos != null) { ?>
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Anexo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>
                                    <?php foreach ($anexos as $a) {
                                        if ($a->thumb == null) {
                                            $thumb = base_url() . 'assets/img/icon-file.png';
                                            $link = base_url() . 'assets/img/icon-file.png';
                                        } else {
                                            $thumb = $a->url . '/thumbs/' . $a->thumb;
                                            $link = $a->url . '/' . $a->anexo;
                                        }
                                        echo '<div class="span3" style="min-height: 150px; margin-left: 0"><a style="min-height: 150px;" href="#modal-anexo" imagem="' . $a->idAnexos . '" link="' . $link . '" role="button" class="btn anexo span12" data-toggle="modal"><img src="' . $thumb . '" alt=""></a></div>';
                                    } ?>
                                    </th>
                                </tbody>
                            </table>
                        <?php } ?>
                        <!-- Inicio Modal visualizar anexo -->
                                    <div id="modal-anexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header"  style="background-color: #5558db; color: #fff;">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel">Visualizar Anexo</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="span12" id="div-visualizar-anexo" style="text-align: center">
                                                <div class='progress progress-info progress-striped active'>
                                                    <div class='bar' style='width: 100%'></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                                            <a href="" id-imagem="" class="btn btn-inverse" id="download">Download</a>
                                            <a href="#" id="downloadtodos" style="margin-left: 7px;" class="btn btn-success">
                                            <i class="fas fa-download"></i> Baixar todos
                                            </a>
                                        </div>
                                    </div>
                                    <?php if ($produtos != null) { ?>
                                        <table class="table table-bordered table-condensed" id="tblProdutos">
                                            <thead>
                                                <tr>
                                                    <th>PRODUTO</th>
                                                    <th>QTD</th>
                                                    <th>UNT</th>
                                                    <th>SUBTOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($produtos as $p) {
                                                    $totalProdutos = $totalProdutos + $p->subTotal;
                                                    echo '<tr>';
                                                    echo '<td>' . $p->descricao . '</td>';
                                                    echo '<td>' . $p->quantidade . '</td>';
                                                    echo '<td>' . $p->preco ?: $p->precoVenda . '</td>';
                                                    echo '<td>R$ ' . number_format($p->subTotal, 2, ',', '.') . '</td>';
                                                    echo '</tr>';
                                                } ?>
                                                <tr>
                                                    <td colspan="3" style="text-align: right"><strong>TOTAL:</strong></td>
                                                    <td><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.'); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                    <?php if ($servicos != null) { ?>
                                        <table class="table table-bordered table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>SERVIÇO</th>
                                                    <th>QTD</th>
                                                    <th>UNT</th>
                                                    <th>SUBTOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php setlocale(LC_MONETARY, 'en_US'); foreach ($servicos as $s) {
                                                    $preco = $s->preco ?: $s->precoVenda;
                                                    $subtotal = $preco * ($s->quantidade ?: 1);
                                                    $totalServico = $totalServico + $subtotal;
                                                    echo '<tr>';
                                                    echo '<td>' . $s->nome . '</td>';
                                                    echo '<td>' . ($s->quantidade ?: 1) . '</td>';
                                                    echo '<td>R$ ' . $preco . '</td>';
                                                    echo '<td>R$ ' . number_format($subtotal, 2, ',', '.') . '</td>';
                                                    echo '</tr>';
                                                } ?>
                                                <tr>
                                                    <td colspan="3" style="text-align: right"><strong>TOTAL:</strong></td>
                                                    <td><strong>R$ <?php echo number_format($totalServico, 2, ',', '.'); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php } ?>

                                    <?php if ($totalProdutos != 0 || $totalServico != 0) {
                                        if ($result->valor_desconto != 0) {
                                            echo "<h4 style='text-align: right'>SUBTOTAL: R$ " . number_format($totalProdutos + $totalServico, 2, ',', '.') . "</h4>";
                                            echo $result->valor_desconto != 0 ? "<h4 style='text-align: right'>DESCONTO: R$ " . number_format($result->valor_desconto != 0 ? $result->valor_desconto - ($totalProdutos + $totalServico) : 0.00, 2, ',', '.') . "</h4>" : "";
                                            echo "<h4 style='text-align: right'>TOTAL: R$ " . number_format($result->valor_desconto, 2, ',', '.') . "</h4>";
                                        } else { echo "<h4 style='text-align: right'>TOTAL: R$ " . number_format($totalProdutos + $totalServico, 2, ',', '.') . "</h4>"; }
                                    }?>
                                    <table class="table table-bordered table-condensed" style="padding-top: 20px">
                                    
                                        <tbody>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Consulta realizada Usando o Token: <strong><?= $result->tokenOs; ?></strong> Data: <strong><?=$dataAtual ?></strong> Pelo IP: <strong><?=$enderecoIP?></strong> </p>
                </div>
                
            </div>
           
            </div>
        </div>
    </div>

</body>
</html>

<script>
    document.getElementById('copyButton').addEventListener('click', function () {
        // Obter a imagem do QR Code
        var qrCodeImage = document.getElementById('qrCodeImage');
        
        // Criar um canvas para desenhar a imagem
        var canvas = document.createElement('canvas');
        canvas.width = qrCodeImage.width;
        canvas.height = qrCodeImage.height;
        var context = canvas.getContext('2d');
        context.drawImage(qrCodeImage, 0, 0, qrCodeImage.width, qrCodeImage.height);

        // Obter os dados de pixels da imagem
        var imageData = context.getImageData(0, 0, canvas.width, canvas.height);

        // Decodificar o QR Code usando a biblioteca jsQR
        var code = jsQR(imageData.data, imageData.width, imageData.height);

        // Verificar se o QR Code foi decodificado com sucesso
        if (code) {
            // Copiar o texto decodificado para a área de transferência
            navigator.clipboard.writeText(code.data).then(function () {
                alert('QR Code copiado com sucesso: ' + code.data);
            }).catch(function (err) {
                console.error('Erro ao copiar QR Code: ', err);
            });
        } else {
            alert('Não foi possível decodificar o QR Code.');
        }
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '.anexo', function(event) {
        event.preventDefault();
        var link = $(this).attr('link');
        var id = $(this).attr('imagem');
        var url = '<?php echo base_url(); ?>index.php/os/excluirAnexo/';
        $("#div-visualizar-anexo").html('<img src="' + link + '" alt="">');
        $("#download").attr('href', "<?php echo base_url(); ?>index.php/os/downloadanexo/" + id);
        $("#downloadtodos").attr('href', "<?php echo base_url(); ?>index.php/os/dowloadanexotodos/" + id);
    });
});
</script>