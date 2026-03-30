<?php
    
    if(isset($_GET["n1"])) {
        $n1 = $_GET["n1"];

    if($n1 >= 100 && $n1<=200)
    {
        print "$n1 está entre 100 e 200";
    }

    else{
        print "$n1 não está entre 100 e 200";
    }
}

?>