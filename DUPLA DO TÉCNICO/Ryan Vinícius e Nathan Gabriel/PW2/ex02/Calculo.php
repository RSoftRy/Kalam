<?php

$n1 = $_GET["n1"];
$temp = strtoupper($_GET["temp"]); 

if ($temp == "F") {

   
    $resultado = ($n1 * 1.8) + 32;
    print "A temperatura em Fahrenheit é: " . $resultado;

} 
else if ($temp == "C") {

  
    $resultado = ($n1 - 32) / 1.8;
    print "A temperatura em Celsius é: " . $resultado;

} 
else {
    print "Tipo de temperatura inválido (use F ou C)";
}

?>