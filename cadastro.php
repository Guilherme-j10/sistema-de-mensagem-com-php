<?php
	include("conexao.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>cadastro</title>
	</head>
	<body>
		<form method="POST">
			<label>nome</label>
			<input type="text" name="nome"><br>
			<label>idade</label>
			<input type="text" name="idade"><br>
			<label>email</label>
			<input type="text" name="email"><br>
			<input type="submit" name="envia" value="enviar">
		</form>
		<?php 

			if(isset($_POST["envia"])){
				$nome = addslashes($_POST["nome"]);
				$idade = addslashes($_POST["idade"]);
				$email = addslashes($_POST["email"]);

				if(empty($nome) || empty($idade) || empty($email)){
					echo "<p>Preencha todos os campos</p>";
				}else{
					$sql = $conn->query("INSERT INTO pessoa (nome, idade, email) VALUES ('$nome', '$idade', '$email')");
				}
			}

		?>
	</body>
</html>