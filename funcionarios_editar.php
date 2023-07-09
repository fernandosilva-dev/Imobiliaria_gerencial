<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Funcionarios</title>
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
  <center><h2>Editar Funcionarios</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

  /* FUNCIONARIOS */
  //Cria o código SQL 
  $vSqlFuncionarios='SELECT 
                  funcionarios.id as "funcionarios_id",
                  funcionarios.nome,
                  funcionarios.data_nasc,
                  funcionarios.telefone,
                  funcionarios.cpf,
                  funcionarios.rg,
                  funcionarios.email,
                  funcionarios.logradouro,
                  funcionarios.numero,
                  funcionarios.bairro,
                  funcionarios.complemento,
                  cidades.id as "cidade_id",  
                  funcionarios.cep,
                  funcionarios.uf,                          
                  funcionarios.tipo
                 FROM funcionarios, cidades
                 WHERE 
                  (funcionarios.cidade=cidades.id) AND                  
                  (funcionarios.id = '.$_POST['vId'].')';
  //Executa o código SQL
  $vExecucaoFuncionarios=mysqli_query($vConexao, $vSqlFuncionarios);
  if (!$vExecucaoFuncionarios) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabelaFuncionarios=mysqli_fetch_array($vExecucaoFuncionarios); 
  $vFuncionarios_Id=$vTabelaFuncionarios['funcionarios_id']; 
  $vNome=$vTabelaFuncionarios['nome'];    
  $vData_nasc=$vTabelaFuncionarios['data_nasc'];
  $vTelefone=$vTabelaFuncionarios['telefone']; 
  $vCpf=$vTabelaFuncionarios['cpf'];   
  $vRg=$vTabelaFuncionarios['rg'];  
  $vEmail=$vTabelaFuncionarios['email']; 
  $vLogradouro=$vTabelaFuncionarios['logradouro'];  
  $vNumero=$vTabelaFuncionarios['numero'];   
  $vBairro=$vTabelaFuncionarios['bairro'];  
  $vComplemento=$vTabelaFuncionarios['complemento'];   
  $vCidade=$vTabelaFuncionarios['cidade_id'];  
  $vCep=$vTabelaFuncionarios['cep'];   
  $vUf=$vTabelaFuncionarios['uf'];         
  $vTipo=$vTabelaFuncionarios['tipo'];      

  /* CIDADES */
  //Cria o código SQL 
  $vSqlCidades='SELECT id, nome FROM cidades';
  //Executa o código SQL
  $vExecucaoCidades=mysqli_query($vConexao, $vSqlCidades);
  if (!$vExecucaoCidades) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

  //Fecha a conexão
  mysqli_close($vConexao); 
  ?>
  <!-- Inicia a tag FORM com as classes do Bootstrap -->
  <form method="post" action="funcionarios_editar_executar.php" enctype="multipart/form-data">

    <input type="hidden" id="vId" name="vId" value="<?php echo $vFuncionarios_Id ?>"> 
    
    <!-- Cria os controles de tela para o campo NOME -->
    <div class="form-group">
      <label for="vNome">Nome:</label>
      <input type="text" class="form-control" id="vNome" name="vNome" value="<?php echo $vNome ?>" >
    </div>

    <!-- Cria os controles de tela para o campo DATA NASC. -->
    <div class="form-group">
      <label for="vData_nasc">Data Nasc.:</label>
      <input type="date" class="form-control" id="vData_nasc" name="vData_nasc" value="<?php echo $vData_nasc ?>" >
    </div>

    <!-- Cria os controles de tela para o campo TELEFONE -->
    <div class="form-group">
      <label for="vTelefone">Telefone:</label>
      <input type="text" class="form-control" id="vTelefone" name="vTelefone" value="<?php echo $vTelefone?>" >
    </div>

    <!-- Cria os controles de tela para o campo CPF -->
    <div class="form-group">
      <label for="vCpf">CPF:</label>
      <input type="text" class="form-control" id="vCpf" name="vCpf" value="<?php echo $vCpf?>" >
    </div>

    <!-- Cria os controles de tela para o campo RG -->
    <div class="form-group">
      <label for="vRg">RG:</label>
      <input type="text" class="form-control" id="vRg" name="vRg" value="<?php echo $vRg?>" >
    </div>

    <!-- Cria os controles de tela para o campo E-MAIL -->
    <div class="form-group">
      <label for="vEmail">E-mail:</label> 
      <input type="text" class="form-control" id="vEmail" name="vEmail" value="<?php echo $vEmail ?>">
    </div>

    <!-- Cria os controles de tela para o campo LOGRADOURO -->
    <div class="form-group">
      <label for="vLogradouro">Logradouro:</label>
      <input type="text" class="form-control" id="vLogradouro" name="vLogradouro" value="<?php echo $vLogradouro ?>" >
    </div>

    <!-- Cria os controles de tela para o campo NUMERO -->
    <div class="form-group">
      <label for="vNumero">Numero:</label>
      <input type="text" class="form-control" id="vNumero" name="vNumero" value="<?php echo $vNumero ?>">
    </div>

    <!-- Cria os controles de tela para o campo BAIRRO -->
    <div class="form-group">
      <label for="vBairro">Bairro:</label>
      <input type="text" class="form-control" id="vBairro" name="vBairro" value="<?php echo $vBairro ?>">
    </div>

    <!-- Cria os controles de tela para o campo COMPLEMENTO -->
    <div class="form-group">
      <label for="vComplemento">Complemento:</label>
      <input type="text" class="form-control" id="vComplemento" name="vComplemento" value="<?php echo $vComplemento ?>">
    </div>

    <!-- Cria os controles de tela para o campo CIDADE -->
    <div class="form-group">
      <label for="vCidade">Cidade:</label>
      <select class="form-control" id="vCidade" name="vCidade" value="<?php echo $vCidade ?>"  >
        <option value="1"></option>>
        <?php
        while($vTabelaCidades=mysqli_fetch_array($vExecucaoCidades)) 
          {
          if ($vTabelaFuncionarios['cidade_id']==$vTabelaCidades['id']) {$vSelecionado='selected';} else {$vSelecionado='';}
           echo '<option value="'.$vTabelaCidades['id'].'" '.$vSelecionado.'>'.$vTabelaCidades['nome'].'</option>';
          }
        ?>
      </select>
    </div>

    <!-- Cria os controles de tela para o campo CEP -->
    <div class="form-group">
      <label for="vCep">Cep:</label>
      <input type="text" class="form-control" id="vCep" name="vCep" value="<?php echo $vCep?>" >
    </div>

    <!-- Cria os controles de tela para o campo UF -->
    <div class="form-group">
      <label for="vUf">UF:</label>
      <input type="text" class="form-control" id="vUf" name="vUf" value="<?php echo $vUf?>" >
    </div>

    <!-- Cria os controles de tela para o campo TIPO -->
    <div class="form-group">
      <label for="vTipo">Tipo:</label>
      <input type="text" class="form-control" id="vTipo" name="vTipo" value="<?php echo $vTipo ?>" >
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

