<?php session_start();
require "config.php";
include "_scripts/s_caixa.php";

if(isset($_SESSION['conta']) && empty($_SESSION['conta']) == false){
	$conta = addslashes($_SESSION['conta']);

	$sql = $pdo->prepare("SELECT * FROM contas WHERE conta = :conta");
	$sql->bindValue(":conta", $conta);
	$sql->execute();

	if($sql->rowCount() > 0){
		$user = $sql->fetch();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CAIXA ELETRÔNICO - BANCO TUIUIU</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h1>CAIXA ELETRÔNICO - BANCO TUIUIU</h1>
		<a href="sair.php" >Sair do Sistema</a>
		<div align="left">
			<hr>
				<p>Bem vindo <b><?php echo $user['nome_titular'] ?></b></p>
				<p>Agência: <b><?php echo $user['agencia'] ?></b></p>
				<p>Conta: <b><?php echo $user['conta'] ?></b></p>
				<p>Saldo: R$ <b><?php echo number_format($user['saldo'],2, ',', ' ') ?></b></p>
			<hr>
		</div>
		<div>
			<button type="button" id="btn_extrato" onclick="mostra_extrato()">Mostrar Extrato</button>
			<button type="button" id="btn_saque" onclick="location.href='saque.php'" >Efetuar Saque</button>
			<button type="button" id="btn_deposito" onclick="location.href='deposito.php'" >Depositar</button>
		</div>
		<hr>
		<div id="extrato" style="display: none;">
			<?php include 'extrato.php'; ?>
		</div>

	</div>

</body>
</html>
<?php
}else{
	header('Location:index.php');
}	

?>