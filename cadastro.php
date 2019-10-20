<?php
	include("conexao.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>cadastro</title>
		<style type="text/css">
			
			*{margin: 0px; padding: 0px; font-family: Arial; box-sizing: border-box; outline: none; list-style: none; text-decoration: none;}
			body{display: flex; justify-content: flex-start; align-items: center; flex-direction: column; padding: 2%;}

			h1{margin-bottom: 20px;}

			form{width: 40%; display: flex; justify-content: center; align-items: center; flex-direction: column;}
			form label, input{width: 100%;}
			form label{color: #444; margin-bottom: 10px; text-transform: uppercase;}
			form input{padding: 12px; font-size: 1em; border: none; border-bottom: solid 1px #ccc;}
			form #sub{border-bottom: none; background-color: #333; color: #fff; text-align: center; text-transform: uppercase; border-radius: 5px; cursor: pointer;}

		</style>
	</head>
	<body>
		<h1>Cadastrar usuário</h1>
		<form method="POST">
			<label>nome</label>
			<input type="text" name="nome" placeholder="digite o nome"><br>
			<label>idade</label>
			<input type="text" name="idade" placeholder="digite a idade"><br>
			<label>email</label>  
			<input type="text" name="email" placeholder="digite o email"><br>
			<input type="submit" id="sub" name="envia" value="enviar">
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
					echo "<script> location.href = 'index.php'; </script>";
				}
			}

		?>
	</body>
</html>