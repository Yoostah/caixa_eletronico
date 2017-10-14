<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<table border="1" width="50%">
			<tr>
				<th colspan="3">:: EXTRATO DA CONTA [ <span style="color: red; font-weight: bold"><?php echo $user['conta']?></span> ] ::</th>
			</tr> <?php
			$sql = $pdo->prepare("SELECT * FROM extrato WHERE agencia = :agencia AND conta = :conta");
			$sql->bindValue(":agencia", $user['agencia']);
			$sql->bindValue(":conta", $user['conta']);

			$sql->execute();

			if ($sql->rowCount() > 0){ ?>
				<tr style="font-weight: bold;">
					<td align="center">DATA DA MOVIMENTAÇÃO</td>
					<td align="center">VALOR</td>
					<td align="center">SALDO</td>
				</tr> <?php
				$extrato = $sql->fetchAll();
				foreach ($extrato as $movimento) { ?>
				<tr>
					<td><?php echo $movimento['data_operacao'] ?></td> <?php
					if($movimento['operacao'] == 1){
						$cor = 'green';
					}else{
						$cor = 'red';
					} ?>
					<td align="center" style="color: <?php echo $cor; ?>"><?php echo number_format($movimento['valor'],2, ',', ' ') ?></td>
					<td align="center" style="font-weight: bold"><?php echo number_format($movimento['saldo'],2, ',', ' ') ?></td>
				</tr><?php	
				} ?>
				<tr style="font-weight: bold;">
					<th colspan="2" align="right" style="color: red">SALDO FINAL => </th>
					<td align="center" style="background-color: black; color: white"><?php echo number_format($movimento['saldo'],2, ',', ' ') ?></td>
				</tr><?php
			}else{ ?>
				<tr>
					<td colspan="3" align="center" style="font-weight: bold; color: red">Nenhuma transação efetuada</td>
				</tr> <?php
			} ?>
		</table>
	</div>
</body>
</html>