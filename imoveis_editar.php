<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Registros</title>
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

  <!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->

<div class="container">

 <center><h2>Editar imoveis</h2></center>

<?php

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');


//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

  
  $vSqlImoveis='SELECT 
 imoveis.id as "imoveis_id",
 imoveis.setor,
  imoveis.quadra,
  imoveis.lote,
  imoveis.sublote,
  imoveis.anexo,
  imoveis.logradouro,
  imoveis.numero,
  imoveis.complemento,
  imoveis.bairro,
  cidades.id as "cidade_id",
  imoveis.cep,
  imoveis.uf,
  imoveis.proprietario as "proprietario_id",
  imoveis.id as "imoveis_id",
  imoveis.descricao,
  imoveis.foto,
  imoveis.preco
 FROM imoveis,cidades
 
 WHERE 
  (imoveis.cidade=cidades.id) AND                  
  (imoveis.id = '.$_POST['vId'].')';

$vExecucaoImoveis=mysqli_query($vConexao, $vSqlImoveis);
if (!$vExecucaoImoveis) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
//Acessa registro da consulta
$vTabelaImoveis=mysqli_fetch_array($vExecucaoImoveis);
$vImoveis_Id=$vTabelaImoveis['imoveis_id'];    
$vSetor=$vTabelaImoveis['setor'];    
$vQuadra=$vTabelaImoveis['quadra'];
$vLote=$vTabelaImoveis['lote'];  
$vSublote=$vTabelaImoveis['sublote']; 
$vAnexo=$vTabelaImoveis['anexo'];    
$vLogradouro=$vTabelaImoveis['logradouro']; 
$vNumero=$vTabelaImoveis['numero']; 
$vComplemento=$vTabelaImoveis['complemento'];      
$vBairro=$vTabelaImoveis['bairro'];    
$vCidade=$vTabelaImoveis['cidade_id'];   
$vCep=$vTabelaImoveis['cep'];  
$vUf=$vTabelaImoveis['uf']; 
$vProprietario=$vTabelaImoveis['proprietario_id']; 
$vDescricao=$vTabelaImoveis['descricao'];     
$vFoto=$vTabelaImoveis['foto'];   
$vPreco=$vTabelaImoveis['preco'];


  //Cria o código SQL cidades
  $vSqlCidades='SELECT * FROM  cidades';
   
  //Executa o código SQL
  $vExecucaoCidades=mysqli_query($vConexao, $vSqlCidades);
  if (!$vExecucaoCidades) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  
  //Cria o código SQL clientes
  $vSqlClientes='SELECT * FROM  clientes';

  //Executa o código SQL
  $vExecucaoClientes=mysqli_query($vConexao, $vSqlClientes);
  if (!$vExecucaoClientes) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  
  //Fecha a conexão
  mysqli_close($vConexao);
?>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>Editar Registro</h2></center>
  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="imoveis_editar_executar.php" enctype="multipart/form-data">
    <input type="hidden" id="vId" name="vId" value="<?php echo $vImoveis_Id ?>"> 

  <!-- Cria os controles de tela para o campo setor -->
    <div class="form-group">
      <label for="vSetor">Setor:</label>
      <input type="text" class="form-control" id="vSetor" name="vSetor" value="<?php echo $vSetor ?>">
    </div>
    <!-- Cria os controles de tela para o campo quadra. -->
    <div class="form-group">
      <label for="vQuadra">Quadra:</label>
      <input type="text" class="form-control" id="vQuadra" name="vQuadra" value="<?php echo $vQuadra ?>">
    </div>
    
    <!-- Cria os controles de tela para o campo lote -->
    <div class="form-group">
      <label for="vLote">Lote:</label>
      <input type="text" class="form-control" id="vLote" name="vLote" value="<?php echo $vLote ?>">
    </div>

     <!-- Cria os controles de tela para o campo sublote -->
     <div class="form-group">
      <label for="vSublote">Sublote:</label>
      <input type="text" class="form-control" id="vSublote" name="vSublote" value="<?php echo $vSublote ?>">
    </div>

     <!-- Cria os controles de tela para o campo anexo -->
     <div class="form-group">
      <label for="vAnexo">Anexo:</label>
      <input type="text" class="form-control" id="vAnexo" name="vAnexo" value="<?php echo $vAnexo ?>">
    </div>

     <!-- Cria os controles de tela para o campo logradouro -->
     <div class="form-group">
      <label for="vLogradouro">Logradouro:</label>
      <input type="text" class="form-control" id="vLogradouro" name="vLogradouro" value="<?php echo $vLogradouro ?>">
    </div>

     <!-- Cria os controles de tela para o campo numero -->
     <div class="form-group">
      <label for="vNumero">Numero:</label>
      <input type="text" class="form-control" id="vNumero" name="vNumero" value="<?php echo $vNumero ?>">
    </div>

     <!-- Cria os controles de tela para o campo numero -->
     <div class="form-group">
      <label for="vComplemento">Complemento:</label>
      <input type="text" class="form-control" id="vComplemento" name="vComplemento" value="<?php echo $vComplemento ?>">
    </div>

    <!-- Cria os controles de tela para o campo BAIRRO -->
    <div class="form-group">
      <label for="vBairro">Bairro:</label>
      <input type="text" class="form-control" id="vBairro" name="vBairro" value="<?php echo $vBairro ?>">
    </div>

    <!-- Cria os controles de tela para o campo CIDADE -->
    <div class="form-group">
      <label for="vCidade">Cidade:</label>
      <select class="form-control" id="vCidade" name="vCidade" value="<?php echo $vCidade ?>">
       
        <?php
        while($vTabelaCidades=mysqli_fetch_array($vExecucaoCidades)) 
          {
            if ($vTabelaImoveis['cidade_id']==$vTabelaCidades['id']) {$vSelecionado='selected';} else {$vSelecionado='';}
           echo '<option value="'.$vTabelaCidades['id'].'" '.$vSelecionado.'>'.$vTabelaCidades['nome'].'</option>';
          }
        ?>
      </select>
    </div>

    <!-- Cria os controles de tela para o campo cep -->
    <div class="form-group">
      <label for="vCep">CEP:</label>
      <input type="text" class="form-control" id="vCep" name="vCep" value="<?php echo $vCep ?>">
    </div>

    <!-- Cria os controles de tela para o campo UF -->
    <div class="form-group">
      <label for="vUf">UF:</label>
      <input type="text" class="form-control" id="vUf" name="vUf" value="<?php echo $vUf ?>">
    </div>
     <!-- Cria os controles de tela para o campo proprietario -->
     <div class="form-group">
      <label for="vProprietario">Proprietario:</label>
      <select class="form-control" id="vProprietario" name="vProprietario" value="<?php echo $vProprietario ?>">
       
        <?php
        while($vTabelaClientes=mysqli_fetch_array($vExecucaoClientes)) 
          {
            if ($vTabelaImoveis['proprietario_id']==$vTabelaClientes['id']) {$vSelecionado='selected';} else {$vSelecionado='';}
           echo '<option value="'.$vTabelaClientes['id'].'" '.$vSelecionado.'>'.$vTabelaClientes['nome'].'</option>';
          }
        ?>
      </select>
    </div>
    <!-- Cria os controles de tela para o campo descricao -->
    <div class="form-group">
      <label for="vDescricao">Descrição:</label>
      <input type="text" class="form-control" id="vDescricao" name="vDescricao" value="<?php echo $vDescricao ?>">
    </div>

    <!-- Cria os controles de tela para o campo FOTO -->
    <div class="form-group">
      <label for="vFoto">Foto:</label>
      <img id="imagemFoto" name="imagemFoto">
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Selecionar<input type="file" id="vFoto" name="vFoto" value="<?php echo $vFoto ?>">
          </span>
        </span>
        <input type="text" class="form-control" readonly>
      </div>
    </div>

     <!-- Cria os controles de tela para o campo preço -->
    <div class="form-group">
      <label for="vPreco">Preço:</label>
      <input type="text" class="form-control" id="vPreco" name="vPreco" value="<?php echo $vPreco ?>">
    </div>

    
    <!-- Cria o botão para confirmar a edição do registro -->
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
