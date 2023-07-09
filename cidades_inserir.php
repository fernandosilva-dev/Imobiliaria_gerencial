<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Inserir Cidade</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>Inserir Cidade</h2></center>
  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="cidades_inserir_executar.php">
    <!-- Cria os controles de tela para o campo NOME -->
    <div class="form-group">
      <label for="vNome">Nome:</label>
      <input type="text" class="form-control" id="vNome" name="vNome">
    </div>
    <!-- Cria o botão para confirmar a inserção do registro -->
    <div class="form-group">
      <center>        
       <button class="btn btn-success" type="submit" name="vBotao" value="confirmar">Confirmar</button>
       <button class="btn btn-danger" type="submit" name="vBotao" value="cancelar">Cancelar</button>
      </center>
    </div>
  </form>
</div>

</body>
</html>

