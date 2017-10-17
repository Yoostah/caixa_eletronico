<?php session_start();
require "config.php";
require "funcoes.php";
include "_scripts/s_deposito.php";


if(isset($_SESSION['conta']) && empty($_SESSION['conta']) == false){
	
	if(isset($_POST['vlr_deposito']) && empty($_POST['vlr_deposito']) == false){

		$agencia = addslashes($_SESSION['agencia']);
		$conta = addslashes($_SESSION['conta']);
		$valor_deposito = addslashes(str_replace(',', '.', $_POST['vlr_deposito']));

		$sql = $pdo->prepare("SELECT * FROM contas WHERE conta = :conta");
		$sql->bindValue(":conta", $conta);
		$sql->execute();

		if($sql->rowCount() > 0){
			$user = $sql->fetch();

			
			$sql = $pdo->prepare("UPDATE contas SET saldo = :saldo WHERE conta = :conta and agencia = :agencia");
			$sql->bindValue(":conta", $conta);
			$sql->bindValue(":agencia", $agencia);
			$sql->bindValue(":saldo", ($user['saldo'] + $valor_deposito));
			$sql->execute();

			$sql = $pdo->prepare("INSERT INTO extrato (agencia, conta, valor, operacao, data_operacao, saldo) VALUES (:agencia, :conta, :valor, :operacao, NOW(), :saldo)");
			$sql->bindValue(":agencia", $agencia);
			$sql->bindValue(":conta", $conta);
			$sql->bindValue(":valor", $valor_deposito);
			$sql->bindValue(":operacao", 1);
			$sql->bindValue(":saldo", ($user['saldo'] + $valor_deposito));
			$sql->execute();

			_JS_Alerta("Depósito Efetuado - Para verificar o novo saldo volte ao menu anterior.");

			
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
			<p>Digite o valor que deseja depositar:<br></p>
			R$ <input type="text" id="vlr_deposito" maxlength="15" size="15" name="vlr_deposito"><br><br>
			<button type=submit id="operacao" onclick="return campo_vazio()">Depositar</button>
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
