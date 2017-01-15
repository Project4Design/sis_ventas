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
	//$cliente = $clientes->consultaAuto();?>

	<div class="row">
		<div class="col-md-12 ">
			<div class="box box-primary">
	          <div class="box-body box-profile">
	            <div class="box-body">
							<form id="compra" class="form-horizontal" action="funciones/compras.php" method="POST">
								<input id="action" type="hidden" name="action" value="<?=$action?>">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id" value="<?=$id?>">
								<?}?>
								<div class="row">
								<div class="form-group col-md-offset-2">
									<label for="cliente" class="col-md-1 control-label">Cliente: *</label>
									<div class="col-md-4">
										<input id="cliente" class="form-control" type="cliente"  placeholder="Cliente" name="cliente" autocomplete="off" onKeyUp="buscar();" required>
										<div id="resultadoBusqueda"></div>
									</div>
						
									
									<label for="nombre" class="col-md-1 control-label">Cantidad: *</label>
									<div class="col-md-3">
										<input id="nombre" class="form-control" type="text" placeholder="Cantidad" name="cantidad" value="<?=($id>0)?$user->nombres:'' ?>" required readonly>
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

$(document).ready(function() {
    $("#resultadoBusqueda").html('<p>JQUERY VACIO</p>');
});

function buscar() {
    var textoBusqueda = $("input#cliente").val();
 
     if (textoBusqueda != "") {
        $.post("funciones/clientes.php", {valorBusqueda: textoBusqueda, action: buscar}, function(data) {
            $("#resultadoBusqueda").html(data);
         }); 
     } else { 
        $("#resultadoBusqueda").html('<p>JQUERY VACIO</p>');
        };
};
</script>

     