<!DOCTYPE html>
	<html>
			<head>
				<?php include_once("html/overall/header.php");?>
        <style>
          #chartdiv {
              width: 100%;
              height: 500px;
          }

          #chartdiv2 {
            width   : 100%;
            height    : 500px;
            font-size : 11px;
            }             
        </style>

        <!-- Resources -->
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/pie.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
        <script src="//www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>

			</head>
		<body class="rtl">
			<section id="menu-0">
				<?php include_once("html/overall/topnav.php");?>
			</section>
			<section class="mbr-info mbr-info-extra mbr-section mbr-section-md-padding" id="msg-box1-0" style="background-color: rgb(242, 242, 242); padding-top: 10px; padding-bottom: 40px;">
    			<div class="container">
      			  <div class="row">
            		<div class="mbr-table-md-up">
                		<div class="mbr-table-cell mbr-right-padding-md-up col-md-8 text-xs-center text-md-left">
                		</div>
                		<div class="mbr-table-cell col-md-4">
                		</div>
            		</div>
        		  </div>
    			</div>
			</section>
			<section class="mbr-section mbr-section-hero mbr-section-full" id="header5-2" style="background-color: rgb(204, 204, 204);  margin-top: 40px;">
    			<div class="mbr-table-cell">
					<form action="" id="formulario">
        			<div class="container">
    					<div class='col-md-3'>
    					<span>Desde:</span>
       				 		<div class="form-group">
            					<div class='input-group'>
                					<input type='date' class="form-control" id="fecha1"/>
               							<span class="input-group-addon">
                    						<i class="material-icons">date_range</i>
                						</span>
            					</div>
        					</div>
    					</div>
    					<div class='col-md-3'>
    					<span>Hasta:</span>
        					<div class="form-group">
           						<div class='input-group'>
                					<input type='date' class="form-control" id="fecha2"/>
                					<span class="input-group-addon">
                    					<i class="material-icons">date_range</i>
                					</span>
            					</div>
        					</div>
    					</div>
    					<div class="col-md-6">
    						<a class="btn btn-xs btn-primary" style="margin-top: 30px;" onclick="Consulta1();">Relatório</a>
    						<a class="btn btn-xs btn-primary" style="margin-top: 30px;" onclick="Consulta2();">Gráfico</a>
    						<a class="btn btn-xs btn-primary" style="margin-top: 30px;" onclick="Consulta3();">Pizza</a>
    					</div>
    				</div>
    				<div class="container">
    					<div class="col-md-4">
    						<span>Consultor:</span>
    						<select class="form-control" id="SeleccionVendedor">
    							<?php 
    							$db = new Conexion();
    							foreach ($_consultores as $id_consultores => $consultores_array) {
    							echo "<option value=".$_consultores[$id_consultores]['co_usuario'].">".$_consultores[$id_consultores]['no_usuario']."</option>";
    							}?>	
    						</select>
    					</div>	
    					<div class="col-md-12">
   							<div id="creartablaprecio" style="margin-top: 25px;"></div>
                 <img src="views/assets/images/loading.gif" alt="Cargando" id="loading-image" style="display: block; margin: auto; z-index: 1000; width: 120px;">
                <div id="chartdiv" style="display: none;"></div>
                <div id="chartdiv2" style="display: none;"></div>
    					</div>
					</div>
					</form>
    			</div>
			</section>
			<section class="mbr-section mbr-section-md-padding" id="social-buttons1-3" style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 60px;">
				<?php include_once("html/overall/redsocial.php");?>
			</section>
			<footer>
				<?php include_once("html/overall/footer.php");
				include_once("core/bin/functions/Consultores.php");?>
        <script type="text/javascript">
        $('#loading-image').hide(); 
	         function Consulta1(){
            $('#chartdiv').css('display', 'none');
            $('#chartdiv2').css('display', 'none');
            $('#creartablaprecio').css('display', 'block');
              var codigo = $('#SeleccionVendedor').val();
              var fecha1 = $('#fecha1').val();
              var fecha2 = $('#fecha2').val();
              var dataString = 'codigo='+ codigo + '&fecha1=' + fecha1 + '&fecha2=' + fecha2;
               $.ajax({
                 type: "POST",
                  url: "ajax.php?mode=consulta1",
                  data: dataString,
                  beforeSend: function(){
                    $('#loading-image').show();
                  },
                  complete: function(){
                  $('#loading-image').hide();
                  },
                    success: function(data){
                  $('#creartablaprecio').html(data);
                  }
                });
            }

            function Consulta2(){
              $('#chartdiv').css('display', 'block');
              $('#chartdiv2').css('display', 'none');
              $('#creartablaprecio').css('display', 'none');
              var codigo = $('#SeleccionVendedor').val();
              var fecha1 = $('#fecha1').val();
              var fecha2 = $('#fecha2').val();
              var dataString = 'codigo='+ codigo + '&fecha1=' + fecha1 + '&fecha2=' + fecha2;
                $.ajax({
                  type: "POST",
                  url: "ajax.php?mode=consulta2",
                  data: dataString,
                    beforeSend: function(){
                      $('#loading-image').show();
                    },
                    complete: function(){
                      $('#loading-image').hide();
                    },
                success: function(data){
                      var valores = eval(data);
                      var ene = valores[0];
                      var feb = valores[1];
                      var marz = valores[2];
                      var abril = valores[3];
                      var mayo = valores[4];
                      var jun = valores[5];
                      var jul = valores[6];
                      var ago = valores[7];
                      var sept = valores[8];
                      var oct = valores[9];
                      var nov = valores[10];
                      var dic = valores[11];
                      
                        var chart = AmCharts.makeChart( "chartdiv", {
                          "type": "serial",
                          "theme": "light",
                          "dataProvider": [ {
                            "mes": "Ene",
                            "total": ene
                          }, {
                            "mes": "Feb",
                            "total": feb
                          }, {
                            "mes": "Mar",
                            "total": marz
                          }, {
                            "mes": "Abr",
                            "total": abril
                          }, {
                            "mes": "May",
                            "total": mayo
                          }, {
                            "mes": "Jun",
                            "total": jun
                          }, {
                            "mes": "Jul",
                            "total": jul
                          }, {
                            "mes": "Ago",
                            "total": ago
                          }, {
                            "mes": "Sep",
                            "total": sept
                          }, {
                            "mes": "Oct",
                            "total": oct
                          }, {
                            "mes": "Nov",
                            "total": nov
                          },{
                            "mes": "Dic",
                            "total": dic
                          } ],
                          "valueAxes": [ {
                              "gridColor": "#FFFFFF",
                              "gridAlpha": 0.2,
                              "dashLength": 0
                          } ],
                              "gridAboveGraphs": true,
                              "startDuration": 1,
                              "graphs": [ {
                                  "balloonText": "[[category]]: <b>[[value]]</b>",
                                  "fillAlphas": 0.8,
                                  "lineAlpha": 0.2,
                                  "type": "column",
                                  "valueField": "total"
                                } ],
                                "chartCursor": {
                                  "categoryBalloonEnabled": false,
                                  "cursorAlpha": 0,
                                  "zoomable": false
                                },
                                  "categoryField": "mes",
                                  "categoryAxis": {
                                    "gridPosition": "start",
                                    "gridAlpha": 0,
                                    "tickPosition": "start",
                                    "tickLength": 20
                                },
                                  "export": {
                                      "enabled": true
                                    }

                          } );
                      }
                    });
          }
                       function Consulta3(){
                        $('#chartdiv').css('display', 'none');
                        $('#chartdiv2').css('display', 'block');
                          $('#creartablaprecio').css('display', 'none');
                          var fecha1 = $('#fecha1').val();
                          var fecha2 = $('#fecha2').val();
                          var dataString = 'fecha1=' + fecha1 + '&fecha2=' + fecha2;
                              $.ajax({
                               type: "POST",
                               url: "ajax.php?mode=consulta3",
                               data: dataString,
                              beforeSend: function(){
                                $('#loading-image').show();
                                },
                              complete: function(){
                                $('#loading-image').hide();
                                },
                              success: function(data){
                                var consultor = data['Nombre'];
                                var total = data['total'];
                                var chart = AmCharts.makeChart("chartdiv2", {
                                  "type": "pie",
                                  "theme": "light",
                                  "innerRadius": "40%",
                                  "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
                                  "dataProvider": [{
                                    "vendedor": "Consultor",
                                    "total": 1234
                                  },{
                                    "vendedor": "Consultor2",
                                    "total" : 1222
                                  }],
                                  "balloonText": "[[value]]",
                                  "valueField": "total",
                                  "titleField": "vendedor",
                                  "balloon": {
                                      "drop": true,
                                      "adjustBorderColor": false,
                                      "color": "#FFFFFF",
                                      "fontSize": 16
                                    },
                                   "export": {
                                       "enabled": true
                                    }
                                  });
                                }
                              });
                          }

				</script>
			</footer>
			<input name="animation" type="hidden">
   			<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon"></i></a></div>
  		</body>
	</html>

