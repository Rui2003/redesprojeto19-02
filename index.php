<?php
session_start();
$con=new mysqli("localhost","root", "","takeaway");

if($con->connect_errno!=0){
    echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
    exit;
}
else {
    if (!isset($_SESSION['login'])){
        $_SESSION['login']="incorreto";
    }
        if ($_SESSION['login']="correto"){

    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="ISO-8859-1">
    <title>Take Away</title>
    </head>
    <body>
        <a href="takeaway_create.php">Create</a>
        <h1>Lista de Restaurantes</h1>
        <?php
        $stm=$con->prepare('select * from takeaway');
        $stm->execute();
        $res=$stm->get_result();
        while($resultado = $res->fetch_assoc()){
            echo '<a href="takeaway_show.php?takea='.$resultado['id'].'">';
            echo $resultado["restaurante"];
            echo "</a> ";
            echo '<a href="takeaway_edit.php?takea='.$resultado['id'].'"> edit</a>';
            echo '<a href="takeaway_delete.php?takea='.$resultado['id'].'"> delete</a>';
            echo "<br>";
        }
        $stm->close();
        ?>
    <br>
    <br>
    <br>

    <!--<h1>Lista de Produtos</h1>
        <?php
        $stm=$con->prepare('select * from produtos');
        $stm->execute();
        $res=$stm->get_result();
        while($resultado = $res->fetch_assoc()){
            echo '<a href="artista_show.php?artista='.$resultado['id'].'">';
            echo $resultado["nome"];
            echo "</a> ";
            echo '<a href="artista_edit.php?artista='.$resultado['id'].'"> edit</a>';
            echo '<a href="artista_delete.php?artista='.$resultado['id'].'"> delete</a>';
            echo "<br>";
        }
        $stm->close();
        ?>
    -->

    </body>
    </html>

<?php
}//se login==correto
else {
    echo 'Para entrar nesta pagina necessita de efetuar <a href="login.php">login</a>';
    header('refresh: 2; url=login.php');
}

}//end if - if($con->connect_errno!=0)
?>
