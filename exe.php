<?php
system('clear');
require("tabela_texto.php");
$tabela = new tabela;
$nome_arquivo = 'programas.txt';
$itens = [];
$linhas[] = "<?php";
function menu()
{
    global $tabela;
    global $itens;
    $tabela->montar_tabela($itens);
    escolha($itens);
    system("php escolhaexe.php");
}
function escolha($itens)
{
    global $linhas;
    global $tabela;
    $local = $tabela->especial();
    $quantidade = count($itens);
    $linhas[] = "\$esc = readline(\"Escolha: \");";
    $linhas[] = "switch(\$esc){";
    for($i = 1 ; $i <= $quantidade ; $i++)
    {
        $caso = $i-1;
        if($itens[$i-1] != "Finalizar")
        {
            $linhas[] = "case ".($i).": "." system(\"clear ; php '$local[0]'/'$itens[$caso].php'\");readline(\"\");system(\"php exe.php\")"."; break;";
        }
        else
        {
            $linhas[] = "case ".($i).": "." system(\"clear ; php gerenciar.php\")"."; break;";
        }
    }
    $linhas[] = "default: "."system(\"php exe.php\")"."; break;";
    $linhas[] = "}";
    $linhas[] = "?>";
    $arquivo = fopen("escolhaexe.php","w");
    for($i = 0 ;$i <count($linhas);$i++)
    {
        fwrite($arquivo,$linhas[$i]."\n");
    }
    fclose($arquivo);
}
if ($arquivo = fopen($nome_arquivo, "r")) 
{
    while (($linha = fgets($arquivo)) !== false)
    {
        $linha_limpa = trim($linha);
        $itens[] = $linha_limpa;
    }
    fclose($arquivo);
    $itens[] = "Finalizar";
}
menu();
