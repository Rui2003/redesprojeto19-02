<?php

if($_SERVER['REQUEST_METHOD']='POST'){
    $restaurante="";

    if(isset($_POST['restaurante'])){
        $restaurante=$_POST['restaurante'];
    }
    else{
        echo '<script>alert("É obrigatorio o preenchimento do restaurante.");</script>';
    }
$con = new mysqli("localhost","root","","takeaway");

if($con->connect_errno!=0){
    echo "Ocorreu um erro no acesso à base de dados.<br>". $con->connect_error;
    exit;
}
else{
    $sql="insert into takeaway(restaurante)values(?);";
    $stm = $con->prepare ($sql);

    if($stm!=false){
        $stm->bind_param("s",$restaurante);
        $stm->execute();
        $stm->execute();
        $stm->close();

        echo '<script>alert("restaurante alterado com sucesso!!");</script>';
        echo "Aguarde um momento.A reencaminhar página";
        header('refresh:5;url=index.php');

    }
    else{
}
    }
}
else{
    echo "<h1>Houve um erro ao processar o seu pedido! <br>Irá ser reencaminhado!</h1>";
    header("refresh:5; url=index.php");
}
