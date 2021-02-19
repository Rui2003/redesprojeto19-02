<?php


session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['takea'])&& is_numeric($_GET['takea'])) {
		$idtakeaway=$_GET['takea'];
		$con=new mysqli("localhost","root","","takeaway");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from takeaway where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idtakeaway);
				$stm->execute();
				$res=$stm->get_result();
				$ator=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar Take Away</title>
	  </head>
	  <body>
	  <h1>Editar Take Away</h1>


<?php 
$stm=$con->prepare('select * from takeaway');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	


}
 ?>




	  <form action="takeaway_update.php?takea=<?php  echo $takea['id']; ?>" method="post">
	<label>ID</label><input type="text" name="Nome" required value="<?php echo $takea['id'];?>"><br>
	<label>Restaurante</label><input type="text" name="Restaurante" value="<?php echo $takea['restaurante'];?>"><br>
	
	<input type="submit" name="enviar">
</form>


	  </body>
	  </html>
	  <?php
	}	
else{
	echo ("<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>");
	header("refresh:5; url=index.php");
	}
	$stm->close();
	}


}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}	
?>