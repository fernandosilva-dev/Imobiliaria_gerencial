<html>

<!-- Cabeçalho de definições da página -->
<head>

  <!-- Definição o título da página -->
  <title>LTI - Litoral Imoveis</title>

  <!-- Definição da codificação de caracteres -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <!-- Estilos para a construção do menu com lista de itens -->
  <style>
  ul 
    {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: black;
    font-family: Arial;
    font-size: 14px;
    }

  li a, .dropbtn 
    {
    display: inline-block;
    color: blue ;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

  li a:hover, .menu_retratil:hover .dropbtn 
    {
    background-color: black;
    color: green;
    }

  li.menu_retratil 
    {
    display: inline-block;
    }

  .active 
    {
    background-color: #000000;
    }	

  .menu_retratil-item 
    {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

  .menu_retratil-item a 
    {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    }

  .menu_retratil-item a:hover 
    {
    background-color: #f1f1f1
    }

  .menu_retratil:hover .menu_retratil-item 
    {
    display: block;
    }

</style>

</head>

<!-- Corpo da página -->
<body>

<!-- Inicia menu horizontal-->
<ul>
  <!-- Cria item horizontal -->
  <li style="float:left"><a class="menu" href="pagina_inicial.php" target="conteudo">Página inicial</a></li>
  <?php
  //Verifica a permissão do usuário
  if (isset($_COOKIE[$vCookieLogin])and
     ($_COOKIE[$vCookieLogin]==1))
     {echo '<!-- inicia menu vertical -->
            <li style="float:left" class="menu_retratil">
              <!-- Cria item de controle do menu vertical -->
              <a class="dropbtn" href="#">Gerenciamento</a>
              <div class="menu_retratil-item">
                 <!-- Cria item vertical -->
                <a href="usuarios.php" target="conteudo">Usuários</a>
                
                <!-- Cria item vertical -->
                <a href="clientes.php" target="conteudo">Clientes</a>
                
				<!-- Cria item vertical -->
                <a href="funcionarios.php" target="conteudo">Funcionários</a>

				<!-- Cria item vertical -->
                <a href="historicos.php" target="conteudo">Históricos</a>

				<!-- Cria item vertical -->
                <a href="imoveis.php" target="conteudo">Imóveis</a>

                <!-- Cria item vertical -->
                <a href="cidades.php" target="conteudo">Cidades</a>
				<!-- Cria item vertical -->
                <a href="caixa.php" target="conteudo">Caixa</a>

                <!-- Cria item vertical -->
                <a href="mensagem.php" target="conteudo">Mensagens</a>

              </div>
            </li>';}
  ?>
  <!-- Cria item horizontal -->
  <li style="float:right"><a href="login.php" target="conteudo" class="active">Área Restrita</a></li>
</ul>

</body>

</html>
