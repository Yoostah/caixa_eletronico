<?php session_start();
require 'config.php';
require 'funcoes.php';
include "_scripts/s_index.php";

if(isset($_SESSION['conta']) && empty($_SESSION['conta']) == false){
	header('Location:caixa.php');
}else{
	if(isset($_POST['agencia']) && empty($_POST['agencia']) == false){
		$agencia = addslashes($_POST['agencia']);
		$conta = addslashes($_POST['conta']);
		$senha = addslashes($_POST['senha']);
		
		$sql = $pdo->prepare("SELECT * FROM contas where agencia = :agencia and conta = :conta and senha = :senha");
		$sql->bindValue(":agencia", $agencia);
		$sql->bindValue(":conta", $conta);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0){
			$_SESSION['conta'] = $conta;
			$_SESSION['agencia'] = $agencia;
			header('Location:caixa.php');
		}else{
			_JS_Alerta("Usuário não cadastrado");
			$_POST['erro'] = true;
		}

	}else{

	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Caixa Eletrônico</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
</head>
<body>
	<div class="fundo">
		<div class="conteudo">
			<div class="cabecalho">
				<img src="_imagens/logo.png" />
				<h2>Digite os dados da conta <br>para acessar o sistema</h2><br>
			</div>
			<div class="campos">
				<form id="login" method="POST">
					Agência: <br>
					<input id="agencia" type="text" name="agencia"><br><br>
					Conta: <br>
					<input id="conta" type="text" name="conta"><br><br>
					Senha: <br>
					<input id="senha" type="password" name="senha"><br><br>

					<button type="submit" name="btnLogar" onClick="return campo_vazio()" >Acessar Caixa Eletrônico</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
if(isset($_POST['erro']) && $_POST['erro'] == true){
			_PreencherCampos("agencia", $agencia);
			_PreencherCampos("conta", $conta);
			_PreencherCampos("senha", $senha);
}
?>