<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar imoveis</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container" style="padding-top:25px;">
  <div class="panel panel-success">
    <div class="panel-heading"><center><b>Editar Registro</b></center></div>
    <div class="panel-body">
    <?php
    
    $vDestino = "'imoveis.php'";
    //Confere se o usuário cancelou a inserção
    if ($_POST['vBotao'] == 'cancelar')
       {
        echo '<center>
               <p>Cancelada a edição de registro!</p>
               <button class="btn btn-danger" onclick="window.location.href='.$vDestino.'">Ok</button>                      
              </center>';
       }
    //Confere se o usuário confirmou a inserção
    if ($_POST['vBotao'] == 'confirmar')
       {
        //Requer o uso do arquivo externo de configurações 
        require('configuracoes.php');
        //Realiza a conexão
        $vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
        if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}
       //Cria o código SQL
       $vId = $_POST['vId'];
       $vSetor=$_POST['vSetor'];    
       $vQuadra=$_POST['vQuadra'];    
       $vLote=$_POST['vLote']; 
       $vSublote=$_POST['vSublote']; 
       $vAnexo=$_POST['vAnexo'];  
       $vLogradouro=$_POST['vLogradouro']; 
       $vNumero=$_POST['vNumero'];  
       $vComplemento=$_POST['vComplemento']; 
       $vBairro=$_POST['vBairro'];   
       $vCidade=$_POST['vCidade'];  
       $vCep=$_POST['vCep'];  
       $vUf=$_POST['vUf'];    
       $vProprietario=$_POST['vProprietario'];    
       $vDescricao=$_POST['vDescricao'];    
       $vFoto=$_FILES['vFoto']['name'];
       $vPreco=$_POST['vPreco']; 
       
       $vSql='UPDATE imoveis             
             SET setor = "'.$vSetor.'", 
                   quadra= "'.$vQuadra.'", 
                   lote = "'.$vLote.'", 
                   sublote = "'.$vSublote.'", 
                   anexo = "'.$vAnexo.'", 
                   logradouro= "'.$vLogradouro.'",
                   numero= "'.$vNumero.'",
                   complemento= "'.$vComplemento.'",
                   bairro= "'.$vBairro.'",
                   cidade = "'.$vCidade.'",
                   cep= "'.$vCep.'",
                   uf = "'.$vUf.'",
                   proprietario = "'.$vProprietario.'",
                   descricao= "'.$vDescricao.'",
                   foto = "'.$vFoto.'",
                   preco = "'.$vPreco.'"
                WHERE id = '.$vId;
        //Executa o código SQL
        $vExecucao=mysqli_query($vConexao, $vSql);
        if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}
        
         //Envia arquivo de imagem
         $vDiretorioDestino = "../gerencial/img/";
         $vArquivoDestino = $vDiretorioDestino . basename($vFoto);
         if (!file_exists($vArquivoDestino)) 
            move_uploaded_file($_FILES["vFoto"]["tmp_name"], $vArquivoDestino);
            
         
        //Mensagem para o usuário
        echo '<center>
               <p>Registro editado com sucesso!</p>
               <button class="btn btn-success" onclick="window.location.href='.$vDestino.'">Ok</button>
              </center>';
       //Fecha a conexão
       mysqli_close($vConexao);
       }
    ?>
    </div>
  </div>
</div>


</body>
</html>

