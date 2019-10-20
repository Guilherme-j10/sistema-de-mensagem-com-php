<?php 
	
	$nomeLocal = "localhost";
	$user = "root";
	$senha = "";
	$db_name = "chat";

	$conn = mysqli_connect($nomeLocal, $user, $senha, $db_name);

	if(!$conn){
		echo "falha na conexão".mysqli_connect_error();
	}else{
		echo "<script> console.log('foi'); </script>";
	}

?>