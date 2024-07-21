<?php
$esc = readline("");
switch($esc){
case 1:  $pasta="Aula 1"; break;
case 2:  $pasta="Aula 2"; break;
case 3:  $pasta="Aula 3"; break;
case 4:  $pasta="Aula 4"; break;
case 5:  $pasta="Aula 5"; break;
case 6:  $pasta="Revisão1"; break;
case 7: die; break;
default: system("php gerenciar.php"); break;
}
system("ls '$pasta'/*.php | sed 's|.*/||' | sed 's/\.php$//'  > programas.txt");
$arquivo = fopen("local.txt","w");
fwrite($arquivo,$pasta);
fclose($arquivo);
system("php exe.php");
?>
