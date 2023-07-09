<html>
<head>
  <title>Editar Histórico</title>
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
    <div class="panel-heading"><center><b>Editar Histórico</b></center></div>
    <div class="panel-body">

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  $vDestino = "'historicos.php'";
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL    
  $vSql='SELECT * FROM historicos
         WHERE id = '.$_POST['vId'];
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSql);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabela=mysqli_fetch_array($vExecucao);
  $vId=$vTabela['id'];    
  $vDescricao=$vTabela['descricao'];        
  //Fecha a conexão
  mysqli_close($vConexao); 
  ?>

  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="historicos_editar_executar.php">
    <!-- Cria o controle de tela para o campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>">        
    <!-- Cria os controles de tela para o campo NOME -->
    <div class="form-group">
	<center>
      <label for="vDescricao">historico:</label>
      <input type="text" class="form-control" id="vDescricao" name="vDescricao" value="<?php echo $vDescricao ?>">
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
</div>
</div>
</body>
</html>

