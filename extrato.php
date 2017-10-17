<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
</head>
<body>
	<div class="tela_extrato">
		<table>
			<caption>:: EXTRATO DA CONTA [ <span class="conta"><?php echo $user['conta']?></span> ] ::</caption><?php
				$sql = $pdo->prepare("SELECT * FROM extrato WHERE agencia = :agencia AND conta = :conta");
				$sql->bindValue(":agencia", $user['agencia']);
				$sql->bindValue(":conta", $user['conta']);

				$sql->execute();

				if ($sql->rowCount() > 0){ ?>
				<thead>
					<tr>
						<th>DATA DA MOVIMENTAÇÃO</th>
						<th width="15%">VALOR</th>
						<th width="15%">SALDO</th>
					</tr> 
				</thead>
				<tbody><?php

				$extrato = $sql->fetchAll();
				$impar = 1;
				
				foreach ($extrato as $movimento) { ?>
					

					<tr id="extrato">
						<td><?php echo $movimento['data_operacao'] ?></td> <?php
						
						if($movimento['operacao'] == 1){
								$cor = 'green';
						}else{
								$cor = 'red';
						} ?>
						<td align="center" style="color: <?php echo $cor; ?>"><?php echo number_format($movimento['valor'],2, ',', ' ') ?></td>
						<td align="center" ><?php echo number_format($movimento['saldo'],2, ',', ' ') ?></td>
					</tr><?php	
					} ?>
					<thead id="final">
						<tr>
							<th id="saldo_final" colspan="2" >SALDO FINAL</th>
							<th id="saldo" align="center"><?php echo number_format($movimento['saldo'],2, ',', '') ?></th>
						</tr>
					</thead>
					<?php
				}else{ ?>
					<tr>
						<td colspan="3" align="center" style="font-weight: bold; color: red">Nenhuma transação efetuada</td>
					</tr> <?php
				} ?>
			</tbody>	
		</table>
	</div>
</body>
</html>