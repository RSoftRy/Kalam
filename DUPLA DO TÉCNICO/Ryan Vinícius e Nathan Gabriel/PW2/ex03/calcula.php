<?php

$n1 = $_POST["n1"];
$n2 = $_POST["n2"];
$op = $_POST["op"];

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

<br><br>
<a href="index.php">Voltar</a>