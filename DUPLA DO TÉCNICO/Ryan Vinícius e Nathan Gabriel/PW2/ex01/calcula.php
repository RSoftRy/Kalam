<?php
    
    if(isset($_POST["n1"])) {
        $n1 = $_POST["n1"];

    if($n1 >= 100 && $n1<=200)
    {
        print "$n1 está entre 100 e 200";
    }

    else{
        print "$n1 não está entre 100 e 200";
    }
}

?>
<br><br>
<a href="index.php">Voltar</a>