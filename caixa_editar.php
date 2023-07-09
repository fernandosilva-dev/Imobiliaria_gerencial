<html>

<head>
  <title>Editar Caixa</title>
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
    <div class="panel-heading"><center><b>Editar Caixa</b></center></div>
    <div class="panel-body">


  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL    
  $vSqlCaixa='SELECT * FROM caixa
         WHERE id = '.$_POST['vId'];
  //Executa o código SQL
  $vExecucaoCaixa=mysqli_query($vConexao, $vSqlCaixa);
  if (!$vExecucaoCaixa) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabelaCaixa=mysqli_fetch_array($vExecucaoCaixa);
  $vId=$vTabelaCaixa['id'];    
  $vData=$vTabelaCaixa['data'];    
  $vHistorico=$vTabelaCaixa['historico'];
  $vReceita=$vTabelaCaixa['receita']; 
  $vDespesa=$vTabelaCaixa['despesa'];     
 
  $vSqlHistoricos='SELECT id, descricao FROM historicos';
  //Executa o código SQL
  $vExecucaoHistoricos=mysqli_query($vConexao, $vSqlHistoricos);
  if (!$vExecucaoHistoricos) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Fecha a conexão
  mysqli_close($vConexao);
?>

  <!-- Inicia a tag FORM com as classes do Bootstrap -->
 
  <form method="post" action="caixa_editar_executar.php">
    <!-- Cria o controle de tela para o campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>">        
    <!-- Cria os controles de tela para o campo DATA -->
       <p>
        <label for="vData">Data:</label>
        <input type="date" class="form-control" id="vData" name="vData" value="<?php echo $vData ?>">
      </p>
    <!-- Cria os controles de tela para o campo HISTORICO -->
     <p>
       <!--campo historico -->
   <p>
   <label for="vHistorico">Histórico:</label>
   
   <select id="vHistorico" class="form-control" name="vHistorico">
    <?php
    while($vTabelaHistoricos=mysqli_fetch_array($vExecucaoHistoricos)) 
      {
	  IF
	     ($vTabelaCaixa['historico'] == $vTabelaHistoricos['id'])
	     {$vSelecionado = 'selected';}
	  Else
	     {$vSelecionado = '';}
		 echo '<option value="'. $vTabelaHistoricos['id'] .'" '. $vSelecionado .' > '.utf8_encode($vTabelaHistoricos['descricao']) .' </option> ';
	  }
    ?>
    </select>
   </p>
    </p>
    <!-- Cria os controles de tela para o campo RECEITA -->
     <p>
        <label for="vReceita">Receita:</label>
        <input type="text" class="form-control"  id="vReceita" name="vReceita" value="<?php echo $vReceita ?>">
    </p>
      <!-- Cria os controles de tela para o campo DESPESA -->
     <p>
        <label for="vDespesa">Despesa:</label>
        <input type="text" class="form-control" id="vDespesa" name="vDespesa" value="<?php echo $vDespesa ?>">
    </p>
          
    <!-- Cria o botão para confirmar a inserção do registro -->
      <center>        
       <button class="btn btn-success" type="submit" name="vBotao" value="confirmar">Confirmar</button>
       <button class="btn btn-danger" type="submit" name="vBotao" value="cancelar">Cancelar</button>
      </center>
  </form>
  
  </div>
 </div>
</div>

</body>
</html>

