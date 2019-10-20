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
			body{display: flex; justify-content: flex-start; align-items: center; flex-direction: column; padding: 2%;}

			.line{width: 100%; float: left; display: flex; justify-content: center; align-items: center;}
			.line ul{width: 100%; margin-top: 30px; display: flex; justify-content: center; flex-direction: row;}
			.line ul li{background-color: #ccc; margin: 0px 10px; text-align: center; padding: 1.5%; border-radius: 5px; display: flex; justify-content: center; align-items: center; flex-direction: column;}
			.line ul li span{background-color: #fff; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; border-radius: 50%; margin-bottom: 20px;}
			.line ul li p{margin-bottom: 15px;}
			.line ul li form a{border: none; font-size: .8em; margin-bottom: 10px; color: #333; margin-top: 0px; display: block; background-color: #fff; padding: 10px; border-radius: 50px; cursor: pointer;}
            .line ul li form input{border: none; font-size: .8em; margin-bottom: 10px; color: #333; margin-top: 0px; display: block; background-color: #fff; padding: 10px; border-radius: 50px; cursor: pointer;}
		</style>
	</head>
	<body>
		<h1>MENSAGENS ENVIADAS PARA VOCE</h1>
		<div class="line">
			<ul>
				<?php
                    if(isset($_GET['id'])){
                        $id_pessoa = $_GET['id'];
                        $sql = $conn->query("SELECT codigo_msg FROM pessoa WHERE id='$id_pessoa'");
                        $verifica = mysqli_num_rows($sql);
                        $ren = mysqli_fetch_array($sql);
                        $codigo_msg = $ren["codigo_msg"];

                        $sqlmensagem = $conn->query("SELECT * FROM msg WHERE id_mensagem='$codigo_msg'");
                        $verdade = mysqli_num_rows($sqlmensagem);

                        if($verdade == 0){
                ?>
                            <p>VOCÊ AINDA N POSSUI NENHUMA MENSAGEM</p>
                <?php
                        }

                        while($pimba = mysqli_fetch_array($sqlmensagem)){
                ?>
                            <li>
                                <p>NOME: <?php echo $pimba["de_para"]; ?></p>
                                <p>Mensagem: <?php echo $pimba["msg"]; ?></p>
                                <form method="POST">
                                    <input type="submit" name="exclui" value="excluir mensagem">
                                </form>
                            </li>
                <?php
                        }
                    }

                    if(isset($_POST["exclui"]) and isset($_GET['id'])){
                        $id_pessoa = $_GET['id'];
                        $sql = $conn->query("SELECT codigo_msg FROM pessoa WHERE id='$id_pessoa'");
                        $verifica = mysqli_num_rows($sql);
                        $ren = mysqli_fetch_array($sql);
                        $codigo_msg = $ren["codigo_msg"];

                        $deletamsg = $conn->query("DELETE FROM msg WHERE id_mensagem='$codigo_msg'"); 

                        echo "<script> alert('Mensagem apagada'); location.href = 'index.php'; </script>";
                    }
				?>
			</ul>
		</div>	
	</body>
</html>