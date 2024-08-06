<?php
require("tabela_texto.php");
$tabela =  new tabela;
system('clear');
system("ls > pastas.txt");
$linhas[] = "<?php";
function menu()
{
    global $tabela;
    $itens = retirar();
    $itens[] = "Finalizar"; 
    $tabela->montar_tabela($itens);
    escolha($itens);

}
function escolha($itens)
{
    global $linhas;
    $quantidade = count($itens);
    $linhas[] = "\$esc = readline(\"Escolha: \");";
    $linhas[] = "switch(\$esc){";
    for($i = 1 ; $i <= $quantidade ; $i++)
    {
        $caso = $i-1;
        if($itens[$i-1]!= "Finalizar")
        {
            $linhas[] = "case ".($i).":  \$pasta=\"$itens[$caso]\""."; break;";
        }
        else
        {
            $linhas[] = "case ".($i).": die"."; break;";
        }
    }
    $linhas[] = "default: "."system(\"php gerenciar.php\")"."; break;";
    $linhas[] = "}";
    $linhas[] = "system(\"ls '\$pasta'/*.php | sed 's|.*/||' | sed 's/\.php$//'  > programas.txt\");";
    $linhas[] = "\$arquivo = fopen(\"local.txt\",\"w\");";
    $linhas[] = "fwrite(\$arquivo,\$pasta);";
    $linhas[] = "fclose(\$arquivo);";
    $linhas[] = "system(\"php exe.php\");";
    $linhas[] = "?>";
    $arquivo = fopen("escolhapasta.php","w");
    for($i = 0 ;$i <count($linhas);$i++)
    {
        fwrite($arquivo,$linhas[$i]."\n");
    }
    fclose($arquivo);
}
function retirar()
{
    global $itens;
    global $tabela;
    for($i = 0 ; $i < count($itens);$i++)
    {
        if($itens[$i] != "gerenciar.php" && $itens[$i] != "tabela_texto.php" && $itens[$i] != "pastas.txt" && $itens[$i] != "escolhapasta.php" && $itens[$i] != "local.txt" && $itens[$i] != "exe.php" && $itens[$i] != "programas.txt" && $itens[$i] != "escolhaexe.php")
        {
            $itens_novos[] = $itens[$i];
        }
    }
    return $itens_novos;
}
$nome_arquivo = 'pastas.txt';
$itens = [];
if ($arquivo = fopen($nome_arquivo, "r")) 
{
    while (($linha = fgets($arquivo)) !== false)
    {
        $linha_limpa = trim($linha);
        $itens[] = $linha_limpa;
    }
    fclose($arquivo);
}
menu();
system("php escolhapasta.php");
?>
