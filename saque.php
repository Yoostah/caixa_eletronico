<?php session_start();
require "config.php";
require "funcoes.php";
include "_scripts/s_saque.php";


if(isset($_SESSION['conta']) && empty($_SESSION['conta']) == false){
	
	if(isset($_POST['vlr_saque']) && empty($_POST['vlr_saque']) == false){

		$agencia = addslashes($_SESSION['agencia']);
		$conta = addslashes($_SESSION['conta']);
		$valor_saque = addslashes(str_replace(',', '.', $_POST['vlr_saque']));

		$sql = $pdo->prepare("SELECT * FROM contas WHERE conta = :conta");
		$sql->bindValue(":conta", $conta);
		$sql->execute();

		if($sql->rowCount() > 0){
			$user = $sql->fetch();

			if ($user['saldo'] >= $valor_saque){
				$sql = $pdo->prepare("UPDATE contas SET saldo = :saldo WHERE conta = :conta and agencia = :agencia");
				$sql->bindValue(":conta", $conta);
				$sql->bindValue(":agencia", $agencia);
				$sql->bindValue(":saldo", ($user['saldo'] - $valor_saque));
				$sql->execute();

				$sql = $pdo->prepare("INSERT INTO extrato (agencia, conta, valor, operacao, data_operacao, saldo) VALUES (:agencia, :conta, :valor, :operacao, NOW(), :saldo)");
				$sql->bindValue(":agencia", $agencia);
				$sql->bindValue(":conta", $conta);
				$sql->bindValue(":valor", $valor_saque);
				$sql->bindValue(":operacao", 2);
				$sql->bindValue(":saldo", ($user['saldo'] - $valor_saque));
				$sql->execute();

				_JS_Alerta("Saque Efetuado - Retire o dinheiro da máquina!");

			}else{
				_JS_Alerta("Saldo Insuficiente");
			}
		}
	}

?> 
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
	    <link rel="stylesheet" type="text/css" href="_css/caixa.css">
	</head>
	<body>
		<div class="tela">
		<form method="post">
			<p>Digite o valor que deseja sacar:<br><p>
			R$ <input type="text" id="vlr_saque" maxlength="15" size="15" name="vlr_saque"><br><br>
			<button type=submit id="operacao" onclick="return campo_vazio()">Sacar</button>
			<button type=button id="voltar" onclick="location.href='caixa.php'">Voltar ao Menu anterior</button>
		</form>
		</div>
	</body>
	</html>
<?php

}else{
	header("Location:index.php");
}
?>
