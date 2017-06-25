<?php 
	$db = new Conexion();
	if (!empty($_POST['fecha1']) and !empty($_POST['fecha2'])) {
		$fecha1 = $_POST['fecha1'];
		$fecha2 = $_POST['fecha2'];
		$x = 0;
	 	 $sql2 = $db->query("SELECT cao_usuario.no_usuario,cao_usuario.co_usuario FROM cao_usuario LEFT JOIN permissao_sistema ON cao_usuario.co_usuario = permissao_sistema.co_usuario WHERE permissao_sistema.co_sistema = '1' and permissao_sistema.in_ativo= 'S' and permissao_sistema.co_tipo_usuario='0,1,2'");
			$totalgananciasconsultores = 0;
			$totalbrutoconsultores = 0;
			$totalgananciacon = 0;
	  		$totalbruto = 0;
	  		if ($db->rows($sql2) > 0) {
	  			while ($result = $db->recorrer($sql2)) {
	  				$codvendedor = $result['co_usuario'];
	  				$nomvendedor = $result['no_usuario'];

	  					//QUERY PARA MOSTRAR EL NETO DENTRO DEL WHILE PARA HACERLO CON CADA VENDEDOR
	  			$sql = $db->query("SELECT cao_fatura.co_cliente, sum(cao_fatura.total) as total, sum(cao_fatura.valor) as valor, cao_fatura.total_imp_inc, cao_fatura.co_os, cao_fatura.data_emissao, cao_fatura.comissao_cn FROM cao_fatura LEFT JOIN cao_os ON cao_fatura.co_os = cao_os.co_os and cao_fatura.co_sistema = cao_os.co_sistema WHERE (cao_fatura.data_emissao between '$fecha1' and '$fecha2') and cao_os.co_usuario='$codvendedor' group by Month(cao_fatura.data_emissao)  ");

						//QUERY PARA MOSTRAR EL SALARIO BRUTO
				$sql1 = $db->query("SELECT brut_salario FROM cao_salario WHERE co_usuario='$codvendedor' "); 
					if ($db->rows($sql1) > 0) {
						while ($res = $db->recorrer($sql1)) {
							$bruto = $res['brut_salario'];
							$totalbruto = $totalbruto + $bruto;
						}
					}else{
						$bruto = 0.00;
					}
					if ($db->rows($sql) > 0) {
						while ($r = $db->recorrer($sql)) {
							$valor = $r['valor'];
							$impuesto = $r['total_imp_inc'];
							$mtoimpu = ($valor * $impuesto)/100;
							$total = $valor - $mtoimpu;
    						$totalgananciacon = $totalgananciacon + $total;
	    					} 						
	    				}
	  				    $datos_graficos = array(
	    					'Nombre' => $nomvendedor, 
	    					'total' => $totalgananciacon
	    					);
	    			$totalgananciasconsultores += $totalgananciacon;
				$x++;
	  			}

	  		}
	  						echo json_encode($datos_graficos);


 	}else{
 		echo '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Coloque el formato de fecha.</div>';
 	}
 ?>