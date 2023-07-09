<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Mensagem</title>
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
  <center><h2>Editar Mensagens</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL    
  $vSql='SELECT * FROM mensagens
         WHERE id = '.$_POST['vId'];
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSql);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabela=mysqli_fetch_array($vExecucao);
  $vId=$vTabela['id'];    
  $vNome=$vTabela['nome'];
  $vEmail=$vTabela['email'];    
  $vTelefone=$vTabela['telefone'];
  $vMensagem=$vTabela['mensagem'];
  //Fecha a conexão
  mysqli_close($vConexao); 
  ?>

  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="mensagem_editar_executar.php">
    <!-- Cria o controle de tela para o campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>">   

    <!-- Cria os controles de tela para o campo NOME -->
    <div class="form-group">
      <label for="vNome">Nome:</label>
      <input type="text" class="form-control" id="vNome" name="vNome" value="<?php echo $vNome ?>">
    </div>

     <!-- Cria os controles de tela para o campo EMAIL -->
     <div class="form-group">
      <label for="vEmail">Email:</label>
      <input type="text" class="form-control" id="vEmail" name="vEmail" value="<?php echo $vEmail ?>">
    </div>

    <!-- Cria os controles de tela para o campo TELEFONE -->
    <div class="form-group">
      <label for="vTelefone">Telefone:</label>
      <input type="text" class="form-control" id="vTelefone" name="vTelefone" value="<?php echo $vTelefone ?>">
    </div>

    <!-- Cria os controles de tela para o campo MENSAGEM -->
    <div class="form-group">
      <label for="vMensagem">Mensagem:</label>
      <textarea type="text" class="form-control" id="vMensagem" name="vMensagem" ><?php echo $vMensagem ?></textarea>
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

