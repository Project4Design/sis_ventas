<?
$clientes   = new Clientes();
?>
<section class="content-header">
  <h1> Clientes </h1>
</section>

<div class="content">
<?
	switch($opc){
		case 'ver':
		$client = $clientes->obtener($id);
	?>
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
			          <div class="box-body box-profile">
			            <h1 class="profile-username text-center"><?=$client->nombre." ".$client->apellido?></h1>
			            <ul class="list-group list-group-unbordered">
			              <li class="list-group-item">
			                <b>Cedula</b> <span class="pull-right"><?=$client->cedula?></span>
			              </li>
			              <li class="list-group-item">
			                <b>Direccion:</b> <span class="pull-right"><?=$client->direccion?></span>
			              </li>
			             <li class="list-group-item">
			               <b>Fecha de registro:</b> <span class="pull-right"><?=$client->fecha_reg_cliente?></span>
			             </li>
			            </ul>
	          </div>
	          <!-- /.box-body -->
	        </div>

	        	<a class="btn btn-success" href="?ver=clientes&opc=edit&id=<?=$id?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar Cliente</a>

	        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	       		
				</div>
<!--- Compras hechas por ese cliente -->
				<div class="col-md-6">
					<div class="box box-primary">
			          <div class="box-body box-profile">
			          <h3 class="text-left"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</h3>
			          <hr>
			           <table class="table table-striped table-bordered">
			           	<thead>
			           	  <tr>
			           		<th>Nombre</th>
			           		<th>Descripcion</th>
			           		<th>Catgoria</th>
			           		<th>imagen</th>
			           		<th>Precio</th>
			           	  </tr>
			           	  <tbody>
			           	  	<tr>
			           	  		<td>Prueba</td>
			           	  		<td>Prueba</td>
			           	  		<td>Prueba</td>
			           	  		<td>Prueba</td>
			           	  		<td>Prueba</td>
			           	  	</tr>
			           	  </tbody>		    
			           	</thead>
			           	<tbody>
			           		
			           	</tbody>
			           </table>
	          </div>
	          <!-- /.box-body -->
	        </div>
		<div class="row">
			<div class="col-md-4 col-lg-offset-4">
	        	<a href="#" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
	        </div>
	    </div>

	        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				</div>
			</div>

      
	<?php 
	$users = $clientes->consulta();
	foreach ($users as $u) { ?>

  
<!-- Modal modificar usuario-->
      <div id="mod-usuario-<?=$u->idpersona?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="box-titles modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="passModalLabel">Reestablecer contraseña</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="registro" class="form-horizontal" action="funciones/clientes.php" method="POST">
								<input id="action" type="hidden" name="action" value="edit">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id" value="<?=$id?>">
								<?}?>
								<div class="form-group">
									<label for="email" class="col-md-4 control-label">Cedula: *</label>
									<div class="col-md-5">
										<input id="cedula" class="form-control" type="cedula" readonly name="cedula" value="<?=($id>0)?$user->cedula:'' ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="nombre" class="col-md-4 control-label">Nombres: *</label>
									<div class="col-md-5">
										<input id="nombre" class="form-control" type="text" name="nombres" value="<?=($id>0)?$user->nombres:'' ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="apellido" class="col-md-4 control-label">Apellidos: *</label>
									<div class="col-md-5">
										<input id="apellido" class="form-control" type="text" name="apellidos" value="<?=($id>0)?$user->apellidos:''?>" required>
									</div>
								</div>

								

								<div class="form-group">
									<label for="division" class="col-md-4 control-label">Direccion: *</label>
									<div class="col-md-5">
										<input type="text" name="direccion" class="form-control" value="<?=($id>0)?$user->direccion:''?>" required>
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
										<a class="btn btn-flat btn-default" href="?ver=clientes">Volver</a>
									</div>
								</div>
							</form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- fin modal modificar usuario -->
      <?php } ?>

	<?
		break;
		case 'add':
		case 'edit':
		if($id>0){$cl = $clientes->obtener($id);}else{$cl=NULL;}
    if($cl==NULL){ $id = 0; $action = "agregar"; }else{ $action="edit"; }
		
	?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				<a class="btn btn-flat btn-default" href="?ver=clientes"><i class="fa fa-backward" aria-hidden="true"></i> Volver</a>
				<p>
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title"><i class="fa <?=($id>0)? 'fa-pencil':'fa-user-plus'?>"></i> <?=($id>0)?'Modificar':'Agregar'?> Cliente</h3><br>
						</div>

						<div class="box-body">
							<form id="registro" class="form-horizontal" action="funciones/clientes.php" method="POST">
								<input id="action" type="hidden" name="action" value="<?=$action?>">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id"  value="<?=($id>0)?$id:'0';?>">
								<?}?>
								<div class="form-group">
									<label for="email" class="col-md-4 control-label">Cedula: *</label>
									<div class="col-md-5">
										<input id="cedula" class="form-control" type="cedula"  placeholder="Cedula" name="cedula" value="<?=($id>0)?$cl->cedula:'' ?>"  required>
									</div>
								</div>

								<div class="form-group">
									<label for="nombre" class="col-md-4 control-label">Nombres: *</label>
									<div class="col-md-5">
										<input id="nombre" class="form-control" type="text" placeholder="Nombres" name="nombres" value="<?=($id>0)?$cl->nombre:'' ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="apellido" class="col-md-4 control-label">Apellidos: *</label>
									<div class="col-md-5">
										<input id="apellido" class="form-control" type="text" placeholder="Apellidos" name="apellidos" value="<?=($id>0)?$cl->apellido:''?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="division" class="col-md-4 control-label">Direccion: *</label>
									<div class="col-md-5">
										<input type="text" name="direccion" class="form-control" placeholder="Direccion" value="<?=($id>0)?$cl->direccion:''?>" required>
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
				</div>
			</div>
	<?
		break;
		default:
		$client = $clientes->consulta();
	?>

		  <div class="box box-default color-palette-box">
		    <div class="box-header with-border">
		      <h3 class="box-title"><i class="fa fa-users"></i> Clientes registrados</h3>
		      <div class="pull-right">
            <a class="btn btn-flat btn-sm btn-success" href="?ver=clientes&opc=add"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar cliente</a>
          </div>
		    </div>
		    <div class="box-body">
			    <table class="table table-striped table-bordered">
			      <thead>
			        <tr>
			          <th class="text-center">#</th>
			          <th>Cedula</th>
			          <th>Nombres</th>
			          <th>Apellidos</th>
			          <th>Direccion</th>
			          <th>Accion</th>
			        </tr>
			      </thead>
			      <tbody>
						<? $i = 1;
							foreach ($client as $cl) {
						?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td><?=$cl->cedula?></td>
								<td><?=$cl->nombre?></td>
								<td><?=$cl->apellido?></td>
								<td><?=$cl->direccion?></td>
								<?=$cl->idcliente?>
								<td class="text-center">
									<a class="btn btn-flat btn-primary btn-sm" href="?ver=clientes&opc=ver&id=<?=$cl->idcliente?>"><i class="fa fa-search"></i></a>
									<a class="btn btn-flat btn-success btn-sm" href="?ver=clientes&opc=edit&id=<?=$cl->idcliente?>"><i class="fa fa-pencil"></i></a>
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



