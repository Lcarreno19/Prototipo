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
		$i = 1;

 					if ($db->rows($sql) > 0) {
						while ($r = $db->recorrer($sql)) {
							$valor[$i] = $r['valor'];
							$impuesto[$i] = $r['total_imp_inc'];
							$mtoimpu[$i] = ($valor[$i] * $impuesto[$i])/100;
							$total[$i] = $valor[$i] - $mtoimpu[$i];
    						$comision[$i] = $r['comissao_cn'];
    						$mtocomision[$i] = ($total[$i] * $comision[$i])/100;
    						$lucro[$i] = $total[$i] - ($bruto+$mtocomision[$i]);
    						$fechadata[$i] = $r['data_emissao'];
    						$partes[$i] = explode('-',$fechadata[$i]);
    						$mes[$i] = $partes[$i][1];
    						$i++;
	    					} 						
	    				}
 					}else{
 						echo '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Coloque el formato de fecha.</div>';
 					}
 						    			$datos_graficos = array(
 						$mes[1] => round($total[1],2),
						$mes[2] => round($total[2],2),
						$mes[3] => round($total[3],2),
						$mes[4] => round($total[4],2),
						$mes[5] => round($total[5],2),
						$mes[6] => round($total[6],2),
						$mes[7] => round($total[7],2),
						$mes[8] => round($total[8],2),
						$mes[9] => round($total[9],2),
						$mes[10] => round($total[10],2),
						$mes[11] => round($total[11],2),
						$mes[12] => round($total[12],2)
 						);
 					echo json_encode($datos_graficos);
 ?>