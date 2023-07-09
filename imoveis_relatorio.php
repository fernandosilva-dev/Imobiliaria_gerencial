<?php

/*
DEFINIÇÃO
---------
  FPDF é uma classe PHP que permite gerar arquivos PDF com PHP puro


DOCUMENTAÇÃO
------------
  http://www.fpdf.org/
  https://www.oficinadanet.com.br/artigo/php/gerando_pdfs_com_php_e_a_classe_fpdf_as_funcoes_da_biblioteca


FUNÇÕES
-------

  FPDF([orientação, unidade, formato)
  Cria o construtor da classe de relatório, utilizando os seguintes parâmetros:
   - orientação: é a forma de exibição da página, retrato (P) ou paisagem (L), onde o valor padrão é (P);
   - unidade: é a medida utilizada na montagem da página, sendo que seus valores podem ser ponto (pt), milímetro (mm), centímetro (cm) e polegada (in), onde o valor default é milímetro (mm);
   - formato: a página pode ser A3, A4, A5, Letter e Legal, onde o valor default para o formato da página é A4.

  
  AddPage(orientação, formato)
  Adiciona uma página ao documento, utilizando os seguintes parâmetros:
   - orientação: é a forma de colocação da página, normal (P) ou paisagem (L), onde o valor default é (P);
   - formato: a página pode ser A3, A4, A5, Letter e Legal, onde o valor default para o formato da página é A4;
   - Observação: caso os parâmetros não sejam passados, então os parâmetros a serem utilizados serão os especificados na classe construtora FPDF ou o valor default da mesma.


  AddFont(família, estilo, arquivo)
  Importa uma fonte TrueType, OpenType ou Type1 e a disponibiliza, sendo necessário gerar um arquivo de definição de fonte primeiro com o utilitário MakeFont; utiliza os seguintes parâmetros:
    - família: família de fontes, onde o nome pode ser escolhido arbitrariamente; se for um nome de família padrão, substituirá a fonte correspondente;
    - estilo: estilo de fonte, onde os valores possíveis são (sem distinção entre maiúsculas e minúsculas) string vazia para regular, B para negrito, I para itálico, BI ou IB para negrito itálico; o valor padrão é regular;
    - arquivo: o arquivo de definição de fonte onde, por padrão, o nome é construído a partir da família e do estilo, em letras minúsculas, sem espaço.

 
  SetFont(família, estilo, tamanho)
  Formata a fonte, utilizando os seguintes parâmetros:
   - família: fonte que pode ser utilizada (Courier, Helvetica, Arial, Times, Symbol, ZapfDingbats) ou inserir uma mediante AddFont();
   - estilo: estilo da fonte, que pode ser regular, negrito (B), itálico (I) ou sublinhado (U)
   - tamanho: tamanho da fonte em pontos. Seu valor default é 12.

  
  Image(arquivo, x, y, largura, altura, tipo, ancora)
  Exibe uma imagem, utilizando os seguintes parâmetros:
    - arquivo: nome e endereço do arquivo;
    - x: abscissa do canto superior esquerdo; se não especificado ou igual a nulo, a abscissa atual é usada;
    - y: ordenada do canto superior esquerdo. Se não especificado ou igual a nulo, a ordenada atual é usada;
    - largura: largura da imagem na página;
    - altura: altura da imagem na página;
    - tipo: formato de imagem, onde os valores possíveis são (sem distinção entre maiúsculas e minúsculas) JPG, JPEG, PNG e GIF; se não for especificado, o tipo é inferido da extensão do arquivo;
    - ancora: âncora para redirecionamento dentro do documento.


  Cell(largura, altura, conteúdo, borda , linha, alinhamento, fundo, ancora)
  Cria uma célula, utilizando os seguintes parâmetros:
   - largura: largura da célula; se colocarmos 0 a célula se estenderá até o lado direito da página, ocupando 100% da largura;
   - altura: altura da célula;
   - conteúdo: o texto que será inserido na célula;
   - borda: se for inserido 0 as bordas não serão exibidas, mas se for inserido 1 elas serão exibidas;
   - linha: informa onde será iniciada a escrita após chamada a função. Se for 0 fica à direita, 1 no início da próxima linha, 2 abaixo;
   - alinhamento: alinha o texto. (L) à esquerda, (C) centralizado e (R) alinhado à direita;
   - fundo: informa se a célula terá um background ou não, onde os valores para esse parâmetro são true ou false;
   - ancora: âncora para redirecionamento dentro do documento.


  Ln(altura)
  Cria uma linha, utilizando os seguintes parâmetros:
    - altura: informa a altura da linha.  


  Output(nome, destino)
  Envia o documento para exibição no navegador ou para gravação em arquivo, utilizando os seguintes parâmetros: 
   - nome: nome dado ao arquivo pdf que será gerado. Caso ele não seja especificado, então irá se chamar doc.pdf, o padrão da biblioteca;
   - destino: destino de envio do arquivo, onde (I) envia o arquivo para o navegador com a opção de 'salvar como', (D) envia o arquivo ao navegador para download, (F) salvar o arquivo em uma pasta local;

*/

//****************************
//CONEXÃO COM O BANCO DE DADOS
//****************************

//Requer o uso do arquivo externo de configurações 
require('configuracoes.php');

//Realiza a conexão
$vConexao=mysqli_connect($vServidor, $vUsuario, $vSenha, $vBaseDados);
if (!$vConexao) {die('Problemas na conexão: ' . mysqli_connect_error());}

//Cria o código SQL
$vSql='SELECT '.
      'imoveis.id, '.
      'imoveis.setor, '.
      'imoveis.quadra, '.
      'imoveis.lote, '.
      'imoveis.sublote, '.
      'imoveis.anexo, '.
      'imoveis.logradouro, '.
      'imoveis.numero,'.
      'imoveis.complemento, '.
      'imoveis.bairro, '.
      'cidades.nome as "cidade", '.
      'imoveis.uf, '.
      'imoveis.cep, '.
      'clientes.nome as "proprietario" '.
      'FROM imoveis, cidades, clientes '.
      'WHERE 
      imoveis.cidade = cidades.id and 
      imoveis.proprietario=clientes.id';

//Executa o código SQL
$vExecucao=mysqli_query($vConexao, $vSql);
if (!$vExecucao) {die('Problemas na execução da instrução SQL: ' . mysqli_error($vConexao));}

//Fecha a conexão
mysqli_close($vConexao);

//***********************
//CONSTRUÇÃO DO RELATÓRIO
//***********************

//Carrega biblioteca
require_once("fpdf/fpdf.php");

class PDF extends FPDF
{
//Cabeçalho
function Header()
  {
    $this->Image('img/tabela.png', 30, 10, 40, 40);
    $this->SetFont('arial', 'B', 18);
    $this->Cell(0, 15, utf8_decode("Imóveis"), 0, 1, 'C');
    $this->Cell(0, 15, "", "B", 1, 'C');
    $this->Ln(30);
  }

//Rodapé
function Footer()
  {
    $this->SetY(-50);
    $this->SetFont('Arial','',8);
    $this->Cell(0, 15, "", "B", 1, 'C');
    $this->Cell(0, 15, utf8_decode('Página ').$this->PageNo().' de {nb}', 0, 0, 'C');
  }
}

//Inicia a classe e implementa o objeto de relatório
$vRelatorio=new PDF("L", "pt", "A4");

//Inicia a página
$vRelatorio->AddPage();
$vRelatorio->AliasNbPages();
 
//Formata a fonte do cabeçalho da tabela 
$vRelatorio->SetFont('arial', 'B', 12);

//Formata a cor do texto e do fundo
$vRelatorio->SetTextColor(255,255,255);
$vRelatorio->SetFillColor(130,130,130);
//Publica as células do cabeçalho da tabela 
$vRelatorio->Cell(70, 20, 'Setor', 0, 0, "L", 1);
$vRelatorio->Cell(70, 20, 'Quadra', 0, 0, "L", 1);
$vRelatorio->Cell(50, 20, 'Lote', 0, 0, "L", 1);
$vRelatorio->Cell(70, 20, 'Sublote', 0, 0, "L", 1);
$vRelatorio->Cell(100, 20, 'Logradouro', 0, 0, "L", 1);
$vRelatorio->Cell(70, 20, utf8_decode('Número'), 0, 0, "L", 1);
$vRelatorio->Cell(70, 20, 'Bairro', 0, 0, "L", 1);
$vRelatorio->Cell(130, 20, 'Cidade', 0, 0, "L", 1);
$vRelatorio->Cell(50, 20, 'Uf', 0, 0, "L", 1);
$vRelatorio->Cell(100, 20, utf8_decode('Proprietário'), 0, 1, "L", 1);

 
//Formata a fonte das linhas da tabela
$vRelatorio->SetFont('arial', '', 12);

//Constrói as linhas da tabela
while($vTabela=mysqli_fetch_array($vExecucao)) 
     {
      //Carrega as variáveis com os valores dos campos do registro atual
      $vSetor=utf8_decode($vTabela['setor']);
      $vQuadra=utf8_decode($vTabela['quadra']);
      $vLote=utf8_decode($vTabela['lote']);
      $vSublote=utf8_decode($vTabela['sublote']);
      $vAnexo=utf8_decode($vTabela['anexo']);
      $vLogradouro=utf8_decode($vTabela['logradouro']);
      $vNumero=utf8_decode($vTabela['numero']);
      $vComplemento=utf8_decode($vTabela['complemento']);
      $vBairro=utf8_decode($vTabela['bairro']);
      $vCidade=utf8_decode($vTabela['cidade']);
      $vUf=utf8_decode($vTabela['uf']);
      $vCep=utf8_decode($vTabela['cep']);
      $vProprietario=utf8_decode($vTabela['proprietario']);
      //Formata a cor do texto
      $vRelatorio->SetTextColor(0,0,0);
      //Publica os valores dos campos do registro atual
      $vRelatorio->Cell(70, 20, $vSetor, 0, 0, "L");
      $vRelatorio->Cell(70, 20, $vQuadra, 0, 0, "L");
      $vRelatorio->Cell(50, 20, $vLote, 0, 0, "L");
      $vRelatorio->Cell(70, 20, $vSublote, 0, 0, "L");
      $vRelatorio->Cell(100, 20, $vLogradouro, 0, 0, "L");
      $vRelatorio->Cell(70, 20, $vNumero, 0, 0, "L");
      $vRelatorio->Cell(70, 20, $vBairro, 0, 0, "L");
      $vRelatorio->Cell(130, 20, $vCidade, 0, 0, "L");
      $vRelatorio->Cell(50, 20, $vUf, 0, 0, "L");
      $vRelatorio->Cell(100, 20, $vProprietario, 0, 1, "L");
     };

//Envia o relatório para o browser (parâmetro "I") ou salva em arquivo externo (parâmetro "D")
$vRelatorio->Output("tabela.pdf", "I");

?>
