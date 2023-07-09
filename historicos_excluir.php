<html>
<head>
  <title>Excluir Histórico</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container" style="padding-top:25px;">
  <div class="panel panel-success">
    <div class="panel-heading"><center><b>Excluir Histórico</b></center></div>
    <div class="panel-body">
      <center>
       <p>Confirma a exclusão de registro?</p>  
       <form method="post" action="historicos_excluir_executar.php">
       <input type="hidden" id="vId" name="vId" value="<?php echo $_POST['vId'] ?>">        
       <button class="btn btn-success" type="submit" name="vBotao" value="confirmar">Confirmar</button>
       <button class="btn btn-danger" type="submit" name="vBotao" value="cancelar">Cancelar</button>
       </center>
      </form>
</div>
</div>
</div>
</body>
</html>

