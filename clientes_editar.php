<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Clientes</title>
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

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>Editar Clientes</h2></center>

  <?php
  //Requer o uso do arquivo externo de configurações 
  require('configuracoes.php');
  //Realiza a conexão
  $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
  if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
  //Cria o código SQL    
 $vSql='SELECT '.
      'clientes.id as "clientes_id", '.
      'clientes.nome, '.
      'clientes.logradouro, '.
      'clientes.numero, '.
      'clientes.complemento, '.
      'clientes.bairro, '.
      'cidades.id as "cidades_id", '.
      'clientes.uf, '.
      'clientes.cep, '.
      'clientes.email, '.
      'clientes.cpf, '.
      'clientes.rg, '.
      'clientes.data_nasc, '.
      'clientes.telefone '.
      'FROM clientes, cidades '.
      'WHERE clientes.cidade = cidades.id AND
             clientes.id = '.$_POST['vId'];
  //Executa o código SQL
  $vExecucao=mysqli_query($vConexao, $vSql);
  if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
  //Acessa registro da consulta
  $vTabela=mysqli_fetch_array($vExecucao);
  $vId=$vTabela['clientes_id'];    
  $vNome=$vTabela['nome'];
  $vLogradouro=$vTabela['logradouro']; 
  $vNumero=$vTabela['numero'];
  $vComplemento=$vTabela['complemento'];
  $vBairro=$vTabela['bairro'];
  $vCidade=$vTabela['cidades_id'];
  $vUf=$vTabela['uf'];
  $vCep=$vTabela['cep'];
  $vEmail=$vTabela['email'];
  $vCpf=$vTabela['cpf'];
  $vRg=$vTabela['rg'];
  $vData_nasc=$vTabela['data_nasc'];
  $vTelefone=$vTabela['telefone'];
  
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
  <form method="post" action="clientes_editar_executar.php">
    <!-- Cria o controle de tela para o campo ID -->
    <input type="hidden" id="vId" name="vId" value="<?php echo $vId ?>"> 

    <!-- Campo NOME -->
      <div class="form-group">
      <label for="vNome">Nome:</label>
      <input type="text" class="form-control"  id="vNome" name="vNome" value="<?php echo $vNome ?>">
      </div>

      <!-- Campo LOGRADOURO -->
      <div class="form-group">
      <label for="vNome">logradouro:</label>
      <input type="text" class="form-control"  id="vLogradouro" name="vLogradouro" value="<?php echo $vLogradouro ?>">
      </div>

      <!-- Campo NUMERO -->
      <div class="form-group">
      <label for="vNome">Número:</label>
      <input type="text" class="form-control"  id="vNumero" name="vNumero" value="<?php echo $vNumero ?>">
      </div>

      <!-- Campo COMPLEMENTO -->
      <div class="form-group">
      <label for="vNome">Complemento:</label>
      <input type="text" class="form-control"  id="vComplemento" name="vComplemento" value="<?php echo $vComplemento ?>">
      </div>

      <!-- Campo BAIRRO -->
      <div class="form-group">
      <label for="vNome">Bairro:</label>
      <input type="text" class="form-control"  id="vBairro" name="vBairro" value="<?php echo $vBairro ?>">
      </div>

      <!-- Campo CIDADE -->
      <div class="form-group">
        
      <label for="vNome">Cidade:</label>
            <select class="form-control" id="vCidade" name="vCidade">
        <?php
        while($vTabelaCidades=mysqli_fetch_array($vExecucaoCidades)) 
          {
          if ($vTabela['cidades_id']==$vTabelaCidades['id']) {$vSelecionado='selected';} else {$vSelecionado='';}
          echo '<option value="'.$vTabelaCidades['id'].'" '.$vSelecionado.'>'.$vTabelaCidades['nome'].'</option>';
          }

        ?>
      </select> 

      </div>

      <!-- Campo UF -->
      <div class="form-group">
      <label for="vNome">Uf:</label>
      <input type="text" class="form-control"  id="vUf" name="vUf" value="<?php echo $vUf ?>">
      </div>

      <!-- Campo CEP -->
      <div class="form-group">
      <label for="vNome">Cep:</label>
      <input type="text" class="form-control"  id="vCep" name="vCep" value="<?php echo $vCep ?>">
      </div>

      <!-- Campo EMAIL -->
      <div class="form-group">
      <label for="vNome">Email:</label>
      <input type="text" class="form-control"  id="vEmail" name="vEmail" value="<?php echo $vEmail ?>">
      </div>

      <!-- Campo CPF -->
      <div class="form-group">
      <label for="vNome">CPF:</label>
      <input type="text" class="form-control"  id="vCpf" name="vCpf" value="<?php echo $vCpf ?>">
      </div>

      <!-- Campo RG -->
      <div class="form-group">
      <label for="vNome">RG:</label>
      <input type="text" class="form-control"  id="vRg" name="vRg" value="<?php echo $vRg ?>">
      </div>

      <!-- Campo DATA DE NASCIMENTO -->
      <div class="form-group">
      <label for="vNome">Data de Nascimento:</label>
      <input type="date" class="form-control"  id="vData_nasc" name="vData_nasc" value="<?php echo $vData_nasc ?>">
      </div>

      <!-- Campo TELEFONE -->
      <div class="form-group">
      <label for="vNome">Telefone:</label>
      <input type="text" class="form-control"  id="vTelefone" name="vTelefone" value="<?php echo $vTelefone ?>">
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
