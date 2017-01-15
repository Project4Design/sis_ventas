<?
$clientes   = new Clientes();

//$cliente = $clientes->consultaAuto();
?>
<section class="content-header">
  <h1> Ventas </h1>
</section>

<div class="content">
<?
	switch($opc){
		case 'ver':

	?>
		<h1>Hola</h1>

	<?php break;
	default: 
	//$cliente = $clientes->consultaAuto(); ?>

	<div class="row">
		<div class="col-md-12 ">
			<div class="box box-primary">
	          <div class="box-body box-profile">
	            <div class="box-body">
							<form id="compra" class="form-horizontal" action="funciones/compras.php" method="POST">
								<input id="action" type="hidden" name="action" value="buscar">
								<input type="hidden" name="idcliente" id="idcliente">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id" value="<?=$id?>">
								<?}?>
								<div class="row">
								<div class="form-group col-md-offset-2">
									<label for="cliente" class="col-md-1 control-label">Cliente: *</label>
									<div class="col-md-6">
										<input id="cliente" class="form-control" type="cliente"  placeholder="Cliente" name="cliente" autocomplete="off"  required>

							          <div class="resultados" id="resultados">
							            <ul id="resultados-box" class="resultados-box">
							            </ul>
							          </div>
          							</div>
								</div>
								</div>
								</div>	
								<div class="row">
									<div class="form-group">
										<label for="producto" class="col-md-1 control-label">Producto</label>
										<div class="col-md-10">
											<input id="producto" type="text" name="producto" class="form-control" placeholder="Producto" required="" readonly="">
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-5 col-md-offset-4">
										<div class="progress" style="display:none">
					            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
					            </div>
					          </div>
					          <p class="help-block" style="color:red">* Campos obligatorios</p>
					          <div class="alert" role="alert" style="display:none"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-5 col-md-offset-4">
										<input id="b-user" class="btn btn-flat btn-primary b-submit" type="submit" data-loading-text="Guardando..." value="Guardar">
										<a class="btn btn-flat btn-default" href="?ver=usuarios">Volver</a>
									</div>
								</div>
							</form>
						</div>
	          </div>
	          <!-- /.box-body -->
	        </div>
	        	
		</div>
	</div>
	<?php break; } ?>
</div>


<script type="text/javascript">

	$(function() {
    	//
    	var MIN = 3;

		  $("#cliente").keyup(function() {

		    var keyword = $("#cliente").val();
		    if (keyword.length >= MIN) {

		    	$.ajax({
		    		type: 'POST',
		    		cache: false,
		    		url: 'funciones/clientes.php',
		    		data: {action:'buscar',cliente:keyword},
		    		dataType: 'json',
		    		success: function(data){
		        		$('#resultados-box').html('');

		    			if(data.length>0){
				        	$('#resultados').attr('style','box-shadow: 0 3px 4px 3px rgba(0, 0, 0, .5);');
				        	$(data).each(function(key, value) {
				            	$('#resultados-box').append('<li class="result-item" id="'+value.id+'"">'+value.nombre+"</li>");
				          	});
				          	$("#resultados").show();
				        }



				        $('.result-item').click(function() {
				          var text = $(this).html();
				          $('#cliente').val(text);
				          $('#b-buscar').click();
				          $("#idcliente").val(this.id);
				          $("#producto").prop("readonly",false);

				        });
		    		},
		    		error: function(){
				      $('#resultados-box').html('');
				      $('#resultados').attr('style','');
		    		},
		    		complete: function(){

		    		}
		    	});
		       
		    } else {
		      $('#resultados-box').html('');
		      $('#resultados').attr('style','');
		    }
		  });

		  $("#cliente").blur(function(){
		      $("#resultados").fadeOut(500);
		    }).focus(function(){
		        $("#resultados").show();
		      });
    	/*var cantidad = $("#cantidad");
 		$('#cliente').autocomplete({
 			source: function(request, response) {
	        	$.ajax({
		          type: "post",
		          url: "funciones/clientes.php",
		          dataType: "json",
		          data: {
		            term : request.term,
		            cliente : $('#cliente').val(),
		            action: "buscar"
		          },
		          success: function(data) {

		            response(data);
		             $("#prueba").val(data);
		          },
		          error: function(){
		          },
		          complete: function(){

		          }
		        });
      		},
    		minLength: 2
  		});*/
	});

		function quitarAttr () { 
		if($("#cantidad").val() != ""){
			alert("si entro");
			//$('#cantidad').prop("readonly",false);
		}


	}
	
</script>

     