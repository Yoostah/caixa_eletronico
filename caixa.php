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
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
</head>
<body>
	<div class="fundo">
		<div class="conteudo_caixa">
			<div class="cabecalho">
				<img id="logo" src="_imagens/logo.png" />
				<button type="button" onclick="location.href='sair.php'">Sair do Sistema</button>
				<h2 id="nome_pag">CAIXA ELETRÔNICO</h2><br>
			</div>	
			<div class="info_cliente">
					<p>Bem vindo <span id="dados"><?php echo $user['nome_titular'] ?></span></p>
					<p>Agência: <span id="dados"><?php echo $user['agencia'] ?></span></p>
					<p>Conta:  <span id="dados"><?php echo $user['conta'] ?></span></p>
					<p>Saldo: R$  <span id="dados"><?php echo number_format($user['saldo'],2, ',', ' ') ?></span></p>
			</div>
			<div class=caixa_botoes>
				<button type="button" id="btn_extrato" onclick="mostra_extrato()">Mostrar Extrato</button>
				<button type="button" id="btn_saque" onclick="location.href='saque.php'" >Efetuar Saque</button>
				<button type="button" id="btn_deposito" onclick="location.href='deposito.php'" >Depositar</button>
			</div>
			<div class="extrato" id="extrato" style="height:335; display: none; overflow: scroll" >
				<?php include 'extrato.php'; ?>
			</div>
		</div>	
	</div>

</body>
</html>
<?php
}else{
	header('Location:index.php');
}	

?>