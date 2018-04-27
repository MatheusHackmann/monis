<?php

require_once("../../classes/Sql.php");

$teste = new Sql();
$results = $teste->d0();


echo "Nome Do Host: ".$results['Host']."<br>";
echo "Nome De Usuário: ".$results['User']."<br>";
echo "Senha: ".$results['Pass']."<br>";
echo "Nome Do Banco: ".$results['DBName'];
