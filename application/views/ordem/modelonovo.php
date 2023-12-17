<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dois Containers Lado a Lado</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
  <!-- Bootstrap CSS via CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
  <!-- Seu arquivo CSS customizado -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Primeiro Container -->
    <div class="col-md-6 container-box " id="container1">
    <td style="width: 10%"><img style="width: 70%" src=" <?php echo $emitente->url_logo; ?> "style="max-height: 100px"></td><br>
    <strong class="card-text"><?php echo $emitente->nome; ?></strong><br>
    <span class="card-text"><strong> CNPJ:     </strong> <?php echo $emitente->cnpj; ?></span><br>
    <span class="card-text"><strong> Telefone: </strong><?php echo $emitente->telefone; ?></span><br>
    <span class="card-text"><strong> E-mail:   </strong><?php echo $emitente->email; ?></span><br>
    <span class="card-text"><strong> Rua:      </strong><?php echo $emitente->rua; ?></span><br>
    <span class="card-text"><strong> Bairro:   </strong><?php echo $emitente->bairro; ?> </span><br>
    <span class="card-text"><strong> Cidade:   </strong><?php echo $emitente->cidade; ?></span><br>
    <span class="card-text"><strong> CEP:      </strong> <?php echo $emitente->cep; ?> </span><br>
    </div>

    
    <div class="col-md-6 container-box " id="container2">
    <h1>Dados do Cliente</h1>
    <strong class="card-text"><?php echo $result->nomeCliente; ?></strong><br>
    <span class="card-text"><strong> CPF/CNPJ:  </strong> <?php echo $result->documento; ?></span><br>
    <span class="card-text"><strong> Telefone:  </strong><?php echo $result->telefone; ?></span><br>
    <span class="card-text"><strong> Celular:   </strong><?php echo $result->celular; ?></span><br>
    <span class="card-text"><strong> Telefone:  </strong><?php echo $result->telefone; ?></span><br>
    <span class="card-text"><strong> Bairro:   </strong><?php echo $result->bairro; ?> </span><br>
    <span class="card-text"><strong> Cidade:   </strong><?php echo $result->cidade; ?></span><br>
    <span class="card-text"><strong> CEP:      </strong> <?php echo $result->cep; ?> </span><br>
    </div>
  </div>
</div>

<!-- Bootstrap JS e Popper.js via CDN (opcional, se necessário para recursos específicos) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<style>
    /* Adicione estilos personalizados aqui */
body {
  width: 210mm;
  height: 297mm;
  margin: 0 auto;
  background-color: rgba(4, 3, 36, 0.97);

}

.container-fluid {
  padding: 20px; /* Adicione um espaço de margem interno para os containers */
}

.container-box {
  height: 80mm; /* Metade da altura de uma folha A4 (297mm / 2) */
  background-color: rgba(8, 8, 8, 0.55);
  backdrop-filter: blur(58px);
  -webkit-backdrop-filter: blur(58px);
  color: #ffff;
  padding: 20px;
  margin-bottom: 20px;
  overflow: hidden; /* Garante que o conteúdo não ultrapasse a altura definida */
  
}

#container2 {
    background-color: rgba(8, 8, 8, 0.55);
  backdrop-filter: blur(58px);
  -webkit-backdrop-filter: blur(58px);
  color: #ffff;
}

</style>