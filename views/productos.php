<?
$productos   = new Productos();
?>
<section class="content-header">
  <h1> Productos </h1>
</section>

<div class="content">
<?
	switch($opc){
		case 'ver':
		$producto = $productos->obtenerProd($id);
	?>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
	          <div class="box-body box-profile">
	            <h1 class="profile-username text-center">#<?=$producto->codigo." ".$producto->nombre_prod?></h1>
	            <ul class="list-group list-group-unbordered">
	              <li class="list-group-item">
	                <b>Nombre</b> <span class="pull-right"><?=$producto->nombre_prod?></span>
	              </li>
	              <li class="list-group-item">
	                <b>Descripcion:</b> <span class="pull-right"><?=$producto->descripcion?></span>
	              </li>
	              <li class="list-group-item">
	                <b>Categoria:</b> <span class="pull-right"><?=$producto->nombre?></span>
	              </li>
	            </ul>
	          </div>
	          <!-- /.box-body -->
	        </div>
	        	<a class="btn btn-warning" href="?ver=usuarios&opc=edit&id=<?=$id?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar Producto</a>
	        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	       		<button class="btn btn-danger" data-toggle="modal" data-target="#el-usuario-<?=$user->idpersona?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar Producto</button>
		</div>

		<div class="col-md-6">
			<div class="box box-primary">
	           <div id="chartdiv"></div> 
	          <!-- /.box-body -->
	        </div>
	        	<a class="btn btn-warning" href="?ver=usuarios&opc=edit&id=<?=$id?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar Producto</a>
	        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	       		<button class="btn btn-danger" data-toggle="modal" data-target="#el-usuario-<?=$user->idpersona?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar Producto</button>
		</div>
	</div>

      <br>
      <br>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default color-palette-box">
		    <div class="box-header with-border">
		      <h3 class="box-title"><i class="fa fa-users"></i> Usuarios Que compraron este producto</h3>
		      <div class="pull-right">
          </div>
		    </div>
		    <div class="box-body">
			    <table id="data-table" class="table table-bordered table-hover">
			      <thead>
			        <tr>
			          <th class="text-center">#</th>
			          <th>Codigo</th>
			          <th>Nombre</th>
			          <th>Descripcion</th>
			          <th>Categoria</th>
			          <th>Accion</th>
			        </tr>
			      </thead>
			      <tbody>
						<? $i = 1;
							foreach ($produc as $prod) {
						?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td><?=$prod->codigo?></td>
								<td><?=$prod->nombre_prod?></td>
								<td><?=$prod->descripcion?></td>
								<td><?=$prod->nombre?></td>
								<td class="text-center">
									<a class="btn btn-flat btn-primary btn-sm" href="?ver=productos&opc=ver&id=<?=$prod->idproducto?>"><i class="fa fa-search"></i></a>
									<a class="btn btn-flat btn-success btn-sm" href="?ver=productos&opc=edit&id=<?=$prod->idproducto?>"><i class="fa fa-pencil"></i></a>
								</td>

							</tr>
						<?
							$i++;
							}
						?>        
			      </tbody>
			    </table>
			   </div>
		  </div>
		  
	</div>
</div>







		<!-- Modal eliminar usuario-->
      <div id="el-usuario-<?=$user->idpersona?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="box-titles modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="passModalLabel">¿Desea eliminar este usuario?</h4>
            </div>
            <div class="modal-body">
              <div class="row">
	          	<form id="fr-del-prod" action="funciones/usuarios.php" method="post">
		            <input type="hidden" name="action" value="delete">
		            <input type="hidden" name="id" value="<?=$user->idpersona?>">
		           
		            <ul>
		            	<li><strong>Nombre y apellido:</strong> <?=$user->nombres?> <?=$user->apellidos?> </li>
		            	<li><strong>Cedula:</strong> <?=$user->cedula?></li></li>
		            	<li><strong>Direccion:</strong> <?=$user->direccion?> </li></li>
		            </ul>
		            <div class="form-group">		
		              <div class="progress" style="display:none">
		                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
		                </div>
		              </div>
		              <div class="alert" role="alert alert-success" style="display:none"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
		            </div><br><br>
		            <center>
		              
		            </center>
         	</form>
              </div>
            </div>
            <div class="modal-footer">
				<button id="fr-b-del-prod" type="submit" class="btn btn-danger">Eliminar</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
          </div>
        </div>
      </div><!-- fin modal eliminar usuario -->
  

      
	<?
		break;
		case 'add':
		case 'edit':
		if($id>0){$producto = $productos->obtenerProd($id);}else{$user=NULL;}
    if($user==NULL){ $id = 0; $action = "agregar"; }else{ $action="edit"; }
		
	?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title"><i class="fa <?=($id>0)? 'fa-pencil':'fa-user-plus'?>"></i> <?=($id>0)?'Modificar':'Agregar'?> Producto</h3><br>
						</div>

						<div class="box-body">
							<form id="registro" class="form-horizontal" action="funciones/productos.php" method="POST">
								<input id="action" type="hidden" name="action" value="<?=$action?>">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id" value="<?=$id?>">
								<?}?>
								<div class="form-group">
								<?php $numero=rand(100, 10000000); ?>
									<label for="codigo" class="col-md-4 control-label">Codigo: *</label>
									<div class="col-md-5">
										<input id="codigo" class="form-control" type="codigo"  name="codigo" value="<?=($id>0)?$producto->codigo:$numero ?>"  required readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="nombre" class="col-md-4 control-label">Nombre: *</label>
									<div class="col-md-5">
										<input id="nombre" class="form-control" type="text" placeholder="Nombres" name="nombre" value="<?=($id>0)?$producto->nombre:'' ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="apellido" class="col-md-4 control-label">Descripcion: *</label>
									<div class="col-md-5">
										<input id="descripcion" class="form-control" type="text" placeholder="Descripcion" name="descripcion" value="<?=($id>0)?$producto->descripcion:''?>" required>
									</div>
								</div>

								<div class="form-group">
					                <label for="categoria" class="col-md-4 control-label">Categoria: *</label>
					                <div class="col-md-3">
					                  <select id="categoria" class="form-control" name="categoria" >
					                    <option value="">Seleccione...</option>
					                    <?php 	$productoCat = $productos->consultaCat();
					                    		foreach($productoCat as $prodCat){ ?>
					                    <option value="<?=$prodCat->id_categoria?>" <?if($id>0){echo $producto->nombre?'selected':'';} ?>><?if($id>0){echo $producto->nombre;}else{echo $prodCat->nombre;}?></option>
					                    <?php } ?>
					                  </select>
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
										<a class="btn btn-flat btn-default" href="?ver=productos">Volver</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	<?
		break;
		default:
		$produc = $productos->consultaProd();
	?>

		  <div class="box box-default color-palette-box">
		    <div class="box-header with-border">
		      <h3 class="box-title"><i class="fa fa-users"></i> Usuarios registrados</h3>
		      <div class="pull-right">
            <a class="btn btn-flat btn-sm btn-success" href="?ver=productos&opc=add"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar producto</a>
          </div>
		    </div>
		    <div class="box-body">
			    <table class="table table-striped table-bordered">
			      <thead>
			        <tr>
			          <th class="text-center">#</th>
			          <th>Codigo</th>
			          <th>Nombre</th>
			          <th>Descripcion</th>
			          <th>Categoria</th>
			          <th>Accion</th>
			        </tr>
			      </thead>
			      <tbody>
						<? $i = 1;
							foreach ($produc as $prod) {
						?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td><?=$prod->codigo?></td>
								<td><?=$prod->nombre_prod?></td>
								<td><?=$prod->descripcion?></td>
								<td><?=$prod->nombre?></td>
								<td class="text-center">
									<a class="btn btn-flat btn-primary btn-sm" href="?ver=productos&opc=ver&id=<?=$prod->idproducto?>"><i class="fa fa-search"></i></a>
									<a class="btn btn-flat btn-success btn-sm" href="?ver=productos&opc=edit&id=<?=$prod->idproducto?>"><i class="fa fa-pencil"></i></a>
								</td>

							</tr>
						<?
							$i++;
							}
						?>        
			      </tbody>
			    </table>
			   </div>
		  </div>
		  
	<?
		break;
	}
?>
</div> 

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script>

$(function () {
   $('#data-table').DataTable({
    'language':{
      'url':'../js/spanish.json',
    },
    responsive: true
  		});
  });
var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [{
    "country": "Ventas",
    "visits": 15,
    "color": "#FF0F00"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Visitors from country"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});
</script>



