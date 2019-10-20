<?php 
	include("conexao.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>teste de mensagem</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<style type="text/css">
			*{margin: 0px; padding: 0px; font-family: Arial; box-sizing: border-box; outline: none; list-style: none; text-decoration: none;}
			body{display: flex; justify-content: flex-start; align-items: center; flex-direction: column;}

			.cada-container{width: 100%; padding: .5%; border-bottom: solid 1px #ccc; margin-bottom: 20px; display: flex; justify-content: flex-end; align-items: center;}
			.cada-container a{padding: 12px; text-align: center; border-radius: 5px; color: 
				#fff; background-color: #333;}

			.line{width: 100%; float: left; display: flex; justify-content: center; align-items: center;}
			.line ul{width: 100%; margin-top: 30px; display: flex; justify-content: center; align-items: center; flex-direction: row; flex-wrap: wrap;}
			.line ul li{width: 25%; height: 350px; background-color: #ccc; margin: 10px 10px; text-align: center; padding: 1.5%; border-radius: 5px; display: flex; justify-content: center; align-items: center; flex-direction: column;}
			.line ul li span{background-color: #fff; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; border-radius: 50%; margin-bottom: 20px;}
			.line ul li p{margin-bottom: 15px;}
			.line ul li form a{border: none; font-size: .8em; margin-bottom: 10px; color: #333; margin-top: 0px; display: block; background-color: #fff; padding: 10px; border-radius: 50px; cursor: pointer;}
			.line .alert{display: flex; justify-content: center; align-items: center; flex-direction: column;}
			.line .alert p{margin-bottom: 10px;}
			.line .alert a{padding: 12px; border-radius: 5px; color: #fff; text-align: center; background-color: #333;}

			.modal{width: 100%; height: 100%; position: fixed; display: none; justify-content: center; align-items: center; left: 0px; top: 0px; background-color: rgba(51,51,51,.6);}
			.modal .container-modal{width: 550px; display: flex; justify-content: center; align-items: center; flex-direction: column; background-color: #fff; padding: 1%; border-radius: 10px; text-align: center;}
			.modal .container-modal h1{color: #333; margin-bottom: 15px; border-bottom: solid 1px #ccc; padding-bottom: 10px;}
			.modal .container-modal p{color: #666; margin-bottom: 20px;}
			.modal .container-modal a{width: 55%; background-color: tomato; color: #fff; padding: 10px 15px; border-radius: 5px; display: block;}
		</style>
	</head>
	<body>
		<div class="cada-container">
			<a href="cadastro.php">Cadastrar novo usuário</a>
		</div>
		<h1>Enviar Mensagens</h1>
		<div class="line">
			<ul>
				<?php
					$sql = $conn->query("SELECT * FROM pessoa");
					$verifica = mysqli_num_rows($sql);

					if($verifica > 0){
						while($ren = mysqli_fetch_array($sql)){
				?>
							<li>
								<span><i class="fas fa-user"></i></span>
								<p>NOME: <?php echo $ren["nome"]; ?></p>
								<p>idade: <?php echo $ren["idade"]; ?></p>
								<p>email: <?php echo $ren["email"]; ?></p>
								<form method="GET">
				<?php
								$id_pessoa = $ren["id"];
								$sqlselect = $conn->query("SELECT codigo_msg FROM pessoa WHERE id='$id_pessoa'");
								$verify = mysqli_num_rows($sqlselect);
								$dados = mysqli_fetch_array($sqlselect);

								if($dados["codigo_msg"] == true){
				?>
									<a id="block" href="#" style="background-color: tomato; color: #fff;">MSG BLOQUED</a>
				<?php
								}else{
				?>
									<a href="mensagem.php?id=<?php echo $ren['id']; ?>">ENVIAR MENSAGEM</a>
				<?php
								}
				?>				
								<a href="vermensagem.php?id=<?php echo $ren['id']; ?>">VER MINHAS MENSAGENS</a>
							</form>
						</li>
				<?php
					}
				?>
			</ul>
				<?php
					}else{
						echo "
							<div class='alert'>
								<p>Infelizmente o sistema n possuí usuários cadastrados ainda</p>
								<a href='cadastro.php'>Cadastrar usuario</a>
							</div>
						";
					}
				?>		
			<div class="modal" id="modal">
				<div class="container-modal">
					<h1>OPS !</h1>
					<p>Desculpe, mas não é possivél enviar mensagem para este usario.</p>
					<a href="#" id="fechar">FECHAR</a>
				</div>
			</div>
			<script>
				function alerta(){
					var btn = document.getElementById("block");
					var modal = document.getElementById("modal");
					var btnclose = document.getElementById("fechar");

					btn.addEventListener('click', function(){
						modal.style.display = "flex";
					});

					btnclose.addEventListener('click', function(){
						modal.style.display = "none";
					});
				}

				alerta();
			</script>
		</div>	
	</body>
</html>