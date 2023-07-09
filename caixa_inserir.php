<html>

<head>
  <title>Caixa</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
  <center><h2>Inserir Caixa</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL
  $vSql='SELECT id, descricao FROM historicos';
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSql);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Fecha a conexão
  mysqli_close($vConexao);
?>

<form method="post" action="caixa_inserir_executar.php">

  <!-- campo DATA -->

    <div class="form-group">
    <label for="vData">Data:</label>
    <input type="date" class="form-control" name="vData">
    </div>

   <!-- campo HISTORICO -->
    <div class="form-group">
   <label for="vHistorico">Historico:</label>
  

   <select id="vHistorico" name="vHistorico" class="form-control">

    <?php
    while($vTabela=mysqli_fetch_array($vExecucao)) 
      { echo '<option value="'.$vTabela['id'].'">'.utf8_encode($vTabela['descricao']).'</option>';
      }
    ?>
    </select>
   </div>

  </p>
   <!-- campo RECEITA -->
    <div class="form-group">
    <label for="vReceita">Receita:</label>
    <input type="text" class="form-control" name="vReceita">
   </div>

   </p>
   <!-- campo DESPESA -->
    <div class="form-group">
    <label for="vDespesa">Despesa:</label>
    <input type="text" class="form-control" name="vDespesa">
   </div>
    
   </p>

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