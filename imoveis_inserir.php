<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Inserir Registro</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
  $(document).ready( function() 
    {
    $(document).on('change', '.btn-file :file', function() 
      {
      var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
      });
    $('.btn-file :file').on('fileselect', function(event, label) 
      {
      var input = $(this).parents('.input-group').find(':text'),
      log = label;
      if( input.length ) 
        {
	input.val(log);
	} 
      else 
        {
	if( log ) alert(log);
	}
      });
  function readURL(input) 
    {
    if (input.files && input.files[0]) 
       {
       var reader = new FileReader();
       reader.onload = function (e) 
                         {
                         $('#imagemFoto').attr('src', e.target.result);
                         }
       reader.readAsDataURL(input.files[0]);
       }
    }
  $("#vFoto").change(function()
                            {
		            readURL(this);
                            }); 	
  });
  </script>

  <style>
  .btn-file 
    {
    position: relative;
    overflow: hidden;
    }
  .btn-file input[type=file] 
    {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
    }

  #imagemFoto
    {
    width: 50px;
    border-radius: 5px;
    }
  </style>

</head>

<body>

<?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL
  $vSqlCidades='SELECT id, nome FROM cidades';
  //Executa o código SQL cidades
  $vExecucaoCidades=mysqli_query($vConexao, $vSqlCidades);
  if (!$vExecucaoCidades) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

   $vSqlClientes='SELECT id, nome FROM clientes';
  //Executa o código SQL clintes
  $vExecucaoClientes=mysqli_query($vConexao, $vSqlClientes);
  if (!$vExecucaoClientes) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

  //Fecha a conexão
  mysqli_close($vConexao);
?>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>Inserir Registro</h2></center>
  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="imoveis_inserir_executar.php" enctype="multipart/form-data">
   
  <!-- Cria os controles de tela para o campo setor -->
    <div class="form-group">
      <label for="vSetor">Setor:</label>
      <input type="text" class="form-control" id="vSetor" name="vSetor">
    </div>
    <!-- Cria os controles de tela para o campo quadra. -->
    <div class="form-group">
      <label for="vQuadra">Quadra:</label>
      <input type="text" class="form-control" id="vQuadra" name="vQuadra">
    </div>
    
    <!-- Cria os controles de tela para o campo lote -->
    <div class="form-group">
      <label for="vLote">Lote:</label>
      <input type="text" class="form-control" id="vLote" name="vLote">
    </div>

     <!-- Cria os controles de tela para o campo sublote -->
     <div class="form-group">
      <label for="vSublote">Sublote:</label>
      <input type="text" class="form-control" id="vSublote" name="vSublote">
    </div>

     <!-- Cria os controles de tela para o campo anexo -->
     <div class="form-group">
      <label for="vAnexo">Anexo:</label>
      <input type="text" class="form-control" id="vAnexo" name="vAnexo">
    </div>

     <!-- Cria os controles de tela para o campo logradouro -->
     <div class="form-group">
      <label for="vLogradouro">Logradouro:</label>
      <input type="text" class="form-control" id="vLogradouro" name="vLogradouro">
    </div>

     <!-- Cria os controles de tela para o campo numero -->
     <div class="form-group">
      <label for="vNumero">Numero:</label>
      <input type="text" class="form-control" id="vNumero" name="vNumero">
    </div>

     <!-- Cria os controles de tela para o campo complemento -->
     <div class="form-group">
      <label for="vComplemento">Complemento:</label>
      <input type="text" class="form-control" id="vComplemento" name="vComplemento">
    </div>

    <!-- Cria os controles de tela para o campo BAIRRO -->
    <div class="form-group">
      <label for="vBairro">Bairro:</label>
      <input type="text" class="form-control" id="vBairro" name="vBairro">
    </div>

    <!-- Cria os controles de tela para o campo CIDADE -->
    <div class="form-group">
      <label for="vCidade">Cidade:</label>
      <select class="form-control" id="vCidade" name="vCidade">
        <option value="1"></option>>
        <?php
        while($vTabelaCidades=mysqli_fetch_array($vExecucaoCidades)) 
          {
          echo '<option value="'.$vTabelaCidades['id'].'">'.utf8_encode($vTabelaCidades['nome']).'</option>';
          }
        ?>
      </select>
    </div>

    <!-- Cria os controles de tela para o campo cep -->
    <div class="form-group">
      <label for="vCep">CEP:</label>
      <input type="text" class="form-control" id="vCep" name="vCep">
    </div>

    <!-- Cria os controles de tela para o campo UF -->
    <div class="form-group">
      <label for="vUf">UF:</label>
      <input type="text" class="form-control" id="vUf" name="vUf">
    </div>
    
    <!-- Cria os controles de tela para o campo PROPRIETARIO-->
    <div class="form-group">
      <label for="vProprietario">Proprietario:</label>
      <select class="form-control" id="vProprietario" name="vProprietario">
        <option value="1"></option>>
        <?php
        while($vTabelaClientes=mysqli_fetch_array($vExecucaoClientes)) 
          {
          echo '<option value="'.$vTabelaClientes['id'].'">'.utf8_encode($vTabelaClientes['nome']).'</option>';
          }
        ?>
      </select>
    </div>
    <!-- Cria os controles de tela para o campo descricao -->
    <div class="form-group">
      <label for="vDescricao">Descrição:</label>
      <input type="text" class="form-control" id="vDescricao" name="vDescricao">
    </div>

    <!-- Cria os controles de tela para o campo FOTO -->
    <div class="form-group">
      <label for="vFoto">Foto:</label>
      <img id="imagemFoto" name="imagemFoto">
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Selecionar<input type="file" id="vFoto" name="vFoto">
          </span>
        </span>
        <input type="text" class="form-control" readonly>
      </div>
    </div>

    <!-- Cria os controles de tela para o campo descricao -->
    <div class="form-group">Preço:</label>
      <input type="text" class="form-control" id="vPreco" name="vPreco">
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
