<html>
<head>
  <title>Inserir Histórico</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body bgcolor="808080"> >
<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container" style="padding-top:25px;">
  <div class="panel panel-success">
    <div class="panel-heading"><center><b>Inserir Histórico</b></center></div>
    <div class="panel-body">
<!-- CRIA A LACUNA PARA INSERÇÃO -->
<form method="post" action="historicos_inserir_executar.php">
  <p>
  
  <label for="vDescricao">Descrição:</label>
   <input class="form-control" type="text" name="vDescricao">
   </p>
   
   <!-- CRIA A LACUNA PARA INSERÇÃO -->
<form method="post" action="historicos_inserir_executar.php">
  <!-- BOTAO CONFIRMAR e CANCELAR -->
   <center>
   <p>
   <button class="btn btn-success" type="submit" name="vBotao" value="confirmar"> Confirmar </button>
   <button  class="btn btn-danger" type="submit" name="vBotao" value="cancelar"> Cancelar </button>
   </p>
   </center>
</form>
</html>