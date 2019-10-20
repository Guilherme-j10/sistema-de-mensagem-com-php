<?php
	include("conexao.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>cadastro</title>
		<style>
			*{margin: 0px; padding: 0px; font-family: Arial; box-sizing: border-box; outline: none; list-style: none; text-decoration: none;}
			body{display: flex; justify-content: flex-start; align-items: center; flex-direction: column; padding: 2%;}

			form{margin-top: 30px; display: flex; justify-content: center; align-items: center; flex-direction: column;}
			form label, input{width: 100%;}
			form label{color: #666;}
			form input, textarea{border: none; padding: 12px;}
			form input{border-bottom: solid 1px #ccc;}
			form textarea{resize: none; border: solid 1px #ccc; border-radius: 10px;}
			form #btn{background-color: #4287f5; color: #Fff; font-size: 1.2em; padding: 6px 3px; border-radius: 3px; cursor: pointer;}
		</style>
	</head>
	<body>
		<?php
			if(isset($_GET["id"])){
				$id = $_GET["id"];
				$sqlConsult = $conn->query("SELECT nome FROM pessoa WHERE id='$id'");
				$blz = mysqli_num_rows($sqlConsult);
				$retorn = mysqli_fetch_array($sqlConsult);
				$nome = $retorn['nome'];

				echo "<h1>ENVIAR MENSAGEM PARA: ".$nome."</h1>";
			}
		?>
		<form method="POST">
			<label>SEU NOME</label><br>
			<input type="text" name="de_para" placeholder="Digite seu nome"><br>
			<label>MENSAGEM</label><br>
			<textarea name="mensagem" cols="30" rows="10"></textarea><br>
			<input id="btn" type="submit" name="envia" value="enviar">
		</form>
		<?php 

			if(isset($_POST["envia"]) and isset($_GET["id"])){
				$de_para = addslashes($_POST["de_para"]);
                $mensagem = addslashes($_POST["mensagem"]);
                $id_pessoa = $_GET['id'];

				if(empty($de_para) || empty($mensagem)){
					echo "<p>Preencha todos os campos</p>";
				}else{
                    $sql = $conn->query("INSERT INTO msg (de_para, msg) VALUES ('$de_para', '$mensagem')");

                    $sqlmsg = $conn->query("SELECT id_mensagem FROM msg ORDER BY 1 DESC");
                    $ver = mysqli_num_rows($sqlmsg);
                    $torn = mysqli_fetch_array($sqlmsg);
                    $id_msg = $torn["id_mensagem"];

                    $sql2 = $conn->query("UPDATE pessoa SET codigo_msg = '$id_msg' WHERE id = '$id_pessoa'");
                    
                    echo "<script> location.href = 'index.php'; </script>";
				}
			}

		?>
	</body>
</html>