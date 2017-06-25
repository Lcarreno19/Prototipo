<?php 
	$db = new Conexion();
	if (!empty($_POST['fecha1']) and !empty($_POST['fecha2'])) {
	$codvendedor = $_POST['codigo'];
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	//QUERY PARA MOSTRAR EL NETO
	$sql = $db->query("SELECT cao_fatura.co_cliente, sum(cao_fatura.total) as total, sum(cao_fatura.valor) as valor, cao_fatura.total_imp_inc, cao_fatura.co_os, cao_fatura.data_emissao, cao_fatura.comissao_cn FROM cao_fatura LEFT JOIN cao_os ON cao_fatura.co_os = cao_os.co_os and cao_fatura.co_sistema = cao_os.co_sistema WHERE (cao_fatura.data_emissao between '$fecha1' and '$fecha2') and cao_os.co_usuario='carlos.arruda' group by Month(cao_fatura.data_emissao)  ");
	
	//QUERY PARA MOSTRAR EL SALARIO BRUTO
	$sql1 = $db->query("SELECT brut_salario FROM cao_salario WHERE co_usuario='$codvendedor' "); 
	if ($db->rows($sql1) > 0) {
		while ($res = $db->recorrer($sql1)) {
			$bruto = $res['brut_salario'];
		}
	}else{
		$bruto = 0.00;
	}

 ?>
 	<div class="card-content table-responsive" style="position: relative;">
 		<table class="table table-hover table-striped table-bordered">
 			<thead style="background-color: #a38f84; color: white;">
 				<tr>
 					<th colspan="5" style="text-align: left; font-weight: bold;"><?php echo $_consultores[$codvendedor]['no_usuario']; ?> Desde <?php echo $fecha1; ?> Hasta <?php echo $fecha2; ?></th>
 				</tr>
 				<tr>
 					<th style="text-align: center; font-weight: bold;">Período</th>
 					<th style="text-align: center; font-weight: bold;">Receta líquida</th>
 					<th style="text-align: center; font-weight: bold;">Costo Fijo</th>
 					<th style="text-align: center; font-weight: bold;">Comision</th>
 					<th style="text-align: center; font-weight: bold;">Lucro</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php 
 					if ($db->rows($sql) > 0) {
						while ($r = $db->recorrer($sql)) {
							$valor = $r['valor'];
							$impuesto = $r['total_imp_inc'];
							$mtoimpu = ($valor * $impuesto)/100;
							$total = $valor - $mtoimpu;
    						$comision = $r['comissao_cn'];
    						$mtocomision = ($total * $comision)/100;
    						$lucro = $total - ($bruto+$mtocomision);
    						$fechadata = $r['data_emissao'];
    						$partes = explode('-',$fechadata);
    						$mes = $partes[1];
    						switch ($mes){
	 							case '1':
	    						 $tmp_mes="Enero";
	     						break;
	 							case '2':
	     						$tmp_mes="Febrero";
	     						break;
	 							case '3':
	     						$tmp_mes="Marzo";
	     						break;
	 							case '4':
	     						$tmp_mes="Abril";
	     						break;
	 							case '5':
	     						$tmp_mes="Mayo";
	     						break;
	 							case '6':
	     						$tmp_mes="Junio";
	     						break;
								 case '7':
	     						$tmp_mes="Julio";
	     						break;
	 							case '8':
	     						$tmp_mes="Agosto";
	     						break;
	 							case '9':
	     						$tmp_mes="Septiembre";
	     						break;
	 							case '10':
	     						$tmp_mes="Octubre";
	     						break;
	 							case '11':
	     						$tmp_mes="Noviembre";
	     						break;
	 							case '12':
	     						$tmp_mes="Diciembre";
	    						 break;
	    						}
    						$formato = $partes[0].' '.$tmp_mes.' de ';

 							 ?>
 						<tr>
 							<td style="text-align: center;"><?php echo $formato; ?></td>
 							<td style="text-align: right;"><?php echo number_format($total,2,',','.'); ?></td>
 							<td style="text-align: right;"><?php echo number_format($bruto,2,',','.'); ?></td>
 							<td style="text-align: right;"><?php echo number_format($mtocomision,2,',','.') ?></td>
 							<td style="text-align: right;"><?php echo number_format($lucro,2,',','.') ?></td>
 						</tr>
 		
 					<?php 
 					} 
 				}?>
 			</tbody>
 		</table>
 	</div>

 <?php
 	}else{
 		echo '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Coloque el formato de fecha.</div>';
 	}
 ?>