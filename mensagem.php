<html>

<head>
  <title>Mensagens</title>
  <meta charset="utf-8">
  <!-- Inclui as bibliotecas Bootstrap e jQuery -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Estilos do campo de digitação do filtro -->
  <style>
  #vFiltro 
    {
    background-image: url('imagens/filtro.png');
    background-position: 0px 0px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
    }
  </style>
</head>

<body>

<!-- Inicia a tag DIV com a classe CONTAINER do Bootstrap -->
<div class="container">
  <center><h2>Cadastro de mensagens</h2></center>

<?php

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');

//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='SELECT id,
              nome,
              email,
              telefone,
              mensagem
       FROM mensagens';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Conta registros da tabela
$vCont=mysqli_num_rows($vExecucao);
if ($vCont==0) {die('<h2>Nenhum registro encontrado!</h2>');}
echo '<h2>Registros encontrados: '.$vCont.'<br><br>';

echo '
<div class="container-fluid" style="padding-bottom:25px;">
  <div class="row">
    <div class="col-xs-6" style="text-align:left">';
//Cria o botão INSERIR
    if (isset($_COOKIE[$vCookieInserir])and
       ($_COOKIE[$vCookieInserir]==1))
       {
        $vOnClick="'mensagem_inserir.php'";
        echo '<button type="button" class="btn btn-success" onclick="window.location.href='.$vOnClick.'">Inserir Registro</button>';
       }
//Cria o botão IMPRIMIR
echo '
    </div>
    <div class="col-xs-6" style="text-align:right">
      <a target="_blank" class="btn btn-warning" href="mensagem_relatorio.php">Imprimir Tabela</a>  
    </div>
  </div>
</div>
';
?>
  <input type="text" id="vFiltro" onkeyup="Filtrar()" placeholder="Filtre uma mensagem" title="Filtre uma mensagem">
  <!-- Inicia a tag TABLE com a classe TABLE do Bootstrap -->
  <table id="vTabela" class="table table-striped table-hover">
    <!-- Inicia o cabeçalho -->
    <thead>
      <!-- Cria uma linha no cabeçalho -->
      <tr>
        <!-- Cria colunas no cabeçalho -->
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(0)">Nome</th>
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(1)">Email</th>
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(2)">Telefone</th>
        <th title="Classificar" style="text-align:left; cursor:pointer" onclick="Ordenar(3)">Mensagem</th>
        <th style="text-align:center;"></th>
        <th style="text-align:center;"></th>
      </tr>
    </thead>
    <!-- Inicia corpo de dados -->
    <tbody>

<?php

//Cria os registros (linhas) e campos (colunas) na tabela
while($vTabela=mysqli_fetch_array($vExecucao)) 
     {
		   $vNome=utf8_encode($vTabela['nome']);
		   $vEmail=utf8_encode($vTabela['email']);
		   $vTelefone=utf8_encode($vTabela['telefone']);
		   $vMensagem=utf8_encode($vTabela['mensagem']);
     echo '<tr>
              <td style="text-align:left; vertical-align:middle;">'.$vNome.'</td>
              <td style="text-align:left; vertical-align:middle;">'.$vEmail.'</td>
              <td style="text-align:left; vertical-align:middle;">'.$vTelefone.'</td>
              <td style="text-align:left; vertical-align:middle;">'.$vMensagem.'</td>';
      //Cria o botão EDITAR
      if (isset($_COOKIE[$vCookieEditar])and
         ($_COOKIE[$vCookieEditar]==1))
         {echo '<form method="post" action="mensagem_editar.php">
                 <td style="text-align:center; vertical-align:middle;"><button type="submit" class="btn btn-primary glyphicon glyphicon-pencil" id="vId" name="vId" value="'.$vTabela['id'].'"></button></td>
                </form>';}
      //Cria o botão EXCLUIR
      if (isset($_COOKIE[$vCookieExcluir])and
         ($_COOKIE[$vCookieExcluir]==1))
         {echo '<form method="post" action="mensagem_excluir.php">
                 <td style="text-align:center; vertical-align:middle;"><button type="submit" class="btn btn-danger glyphicon glyphicon-remove" id="vId" name="vId" value="'.$vTabela['id'].'"></button></td>
                </form>';}
       echo '</tr>';
     };

//Fecha a conexão
mysqli_close($vConexao);

?>
    </tbody>
  </table>
</div>

<script>
//Função Javascript para FILTRAR os dados na tabela
function Filtrar()
  {
  //Declara e carrega as variáveis
  var input, filter, table, tr, td, i;
  input = document.getElementById("vFiltro");
  filter = input.value.toUpperCase();
  table = document.getElementById("vTabela");
  tr = table.getElementsByTagName("tr");
  //Realiza um laço na tabela e oculta as linhas que não correspondem ao critério do filtro
  for (i = 0; i < tr.length; i++) 
    {
    //Define a coluna que será filtrada
    td = tr[i].getElementsByTagName("td")[0];
    //Realiza o filtro na coluna definida ocultando ou exibindo a linha
    if (td) 
      {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) 
        {
        //Exibe a linha
        tr[i].style.display = "";
        } 
      else 
        {
        //Oculta a linha
        tr[i].style.display = "none";
        }
      }       
    }
  }
//Função Javascript para ORDENAR os dados na tabela
function Ordenar(n) 
  {
  //Declara e carrega as variáveis
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("vTabela");
  switching = true;
  //Defina a direção de classificação para ascendente
  dir = "asc";
  //Realiza um laço na tabela que fará a troca de posições das linhas
  while (switching)
    {
    //Inicia declarando que nenhuma troca será feita
    switching = false;
    rows = table.rows;
    //Percorre todas as linhas da tabela, exceto a primeiro que contém o cabeçalho
    for (i = 1; i < (rows.length - 1); i++)
      {
      //Inicia declarando que nenhuma troca será feita
      shouldSwitch = false;
      //Informa os dois elementos TD que você deseja comparar, um da linha atual e outro da próxima linha
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      //Verifica se as duas linhas devem mudar de lugar com base nas direções ascendente ou descendente
      if (dir == "asc") 
         {
         if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
            {
            //Se caso afirmativo, marca com um interrruptor de mudança e para o laço
            shouldSwitch= true;
            break;
            }
         } 
      else if (dir == "desc") 
         {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
           {
            //Se caso afirmativo, marca com um interrruptor de mudança e para o laço
           shouldSwitch = true;
           break;
           }
         }
      }
    if (shouldSwitch) 
       {
       //Se encontrar um interruptor marcado, faz a mudança e marca como alteração realizada
       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
       switching = true;
       //Cada vez que uma mudança é feito, incrementa a cotagem em mais 1
       switchcount ++;      
       } 
    else 
       {
       //Se nenhuma mudança foi feita e a direção é "asc", define a direção para "desc" e executa o laço novamente
       if (switchcount == 0 && dir == "asc") 
          {
          dir = "desc";
          switching = true;
          }
       }
    }
  }
</script>

</body>

</html>

