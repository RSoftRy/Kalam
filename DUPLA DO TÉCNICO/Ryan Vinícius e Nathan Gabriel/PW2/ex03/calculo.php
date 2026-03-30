<?php

$n1 = $_GET["n1"];
$n2 = $_GET["n2"];
$op = $_GET["op"];

if ($op == "+"){

    $res = ($n1 + $n2);
    print "O resultado é $res";
}

else if ($op == "-"){

    $res = ($n1 - $n2);
    print "O resultado é $res";
}

else if ($op == "*"){

    $res = ($n1 * $n2);
    print "O resultado é $res";

}

else if ($op == "/"){

    $res = ($n1 / $n2);
    print "O resultado é $res";
}

else{
    print "Operador não identificado";
}

?>
