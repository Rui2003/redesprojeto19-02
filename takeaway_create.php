<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo




if ($_SERVER['REQUEST_METHOD']=="POST") {
	$id="";
	$restaurante="";

	if (isset($_POST['id'])) {
		$id=$_POST['id'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do id.');</script>";
	}
	if (isset($_POST['restaurante'])) {
		$restaurante=$_POST['restaurante'];
	}
	$con=new mysqli("localhost","root","","takeaway");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into takeaway (restaurante) values (?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('s',$restaurante);
			$stm->execute();
			$stm->close();

			echo "<script>alert('Restaurante adicionado com sucesso')</script>";

			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:5; url=index.php");
		} 
	} //end if
} //if
else{
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Adicionar TakeAway</title>
</head>
<body>
<h1>Adicionar Takeaway</h1>
<form action="takeaway_create.php" method="post">
	<label>Restaurante</label><input type="text" name="restaurante" required><br>
	
	<input type="submit" name="enviar">
</form>
</body>
</html>
<?php  
}


}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>