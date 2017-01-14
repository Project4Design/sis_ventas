<?
$usuarios   = new Usuarios();
?>
<section class="content-header">
  <h1> Usuarios </h1>
</section>

<div class="content">
<?
	switch($opc){
		case 'ver':
		$user = $usuarios->obtener($id);
	?>
			<div class="row">
				<div class="col-md-6 col-lg-offset-3">
					<div class="box box-primary">
	          <div class="box-body box-profile">
	            
	            <h1 class="profile-username text-center"><?=$user->nombres." ".$user->apellidos?></h1>
	            <ul class="list-group list-group-unbordered">
	              <li class="list-group-item">
	                <b>Cedula</b> <span class="pull-right"><?=$user->cedula?></span>
	              </li>
	              <li class="list-group-item">
	                <b>Email:</b> <span class="pull-right"><?=$user->direccion?></span>
	              </li>
	              <li class="list-group-item">
	                <b>Fecha de registro:</b> <span class="pull-right"><?=$user->fecha_reg?></span>
	              </li>
	              <li class="list-group-item">
	                <b>Fecha de nacimiento:</b> <span class="pull-right"><?=$user->fecha_nac?></span>
	              </li>
	              
	            </ul>
	          </div>
	          <!-- /.box-body -->
	        </div>
	        	<button class="btn btn-success" data-toggle="modal" data-target="#passModal"><i class="fa fa-key" aria-hidden="true"></i> Reesteblecer contraseña</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	        	<button class="btn btn-warning" data-toggle="modal" data-target="#mod-usuario-<?=$user->idpersona?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar usuario</button>

	        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	       		 <button class="btn btn-danger" data-toggle="modal" data-target="#el-usuario-<?=$user->idpersona?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar usuario</button>
				</div>
			</div>

      <!-- Modal modificar contraseña -->
      <div id="passModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="box-titles modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="passModalLabel">Reestablecer contraseña</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="pass-user" class="col-md-8 col-md-offset-2" action="funciones/usuarios.php" method="post">
                  <input type="hidden" name="id" value="<?=$id?>">
                  <input type="hidden" name="action" value="recuperar">
                  <p class="text-center">Reestablecer contraseña para este usuario.</p>

                  <div class="form-group">
                    <label for="actual" class="control-label">Contraseña actual: *</label>
                    <input id="actual" class="form-control" type="password" name="actual" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="p1" class="control-label">Contraseña nueva: *</label>
                    <input id="p1" class="form-control" type="password" name="p1" required>
                  </div>
                  <div class="form-group">
                    <label for="p2" class="control-label">Repetir contraseña: *</label>
                    <input id="p2" class="form-control" type="password" name="p2" required>
                  </div>
               

                  <div class="progress" style="display:none">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
                  </div>

                  <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>

                  <center>
                    <button id="b-recuperar" class="btn btn-primary" type="submit" data-loading-text="Cargando..." >Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- fin modal modificar contraseña -->
	<?php 
	$users = $usuarios->consulta();
	foreach ($users as $u) { ?>
		<!-- Modal eliminar usuario-->
      <div id="el-usuario-<?=$u->idpersona?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modModalLabel">
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
		            <input type="hidden" name="id" value="<?=$u->idpersona?>">
		           
		            <ul>
		            	<li><strong>Nombre y apellido:</strong> <?=$u->nombres?> <?=$u->apellidos?> </li>
		            	<li><strong>Cedula:</strong> <?=$u->cedula?></li></li>
		            	<li><strong>Direccion:</strong> <?=$u->direccion?> </li></li>
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
                <form id="registro" class="form-horizontal" action="funciones/usuarios.php" method="POST">
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
									<label for="cedula" class="col-md-4 control-label">Fecha de nacimiento: *</label>
									<div class="col-md-5">
										<input id="datepicker" class="form-control" type="text" name="fecha_nac" value="<?=($id>0)?$user->fecha_nac:''?>" required>
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
										<a class="btn btn-flat btn-default" href="?ver=usuarios">Volver</a>
									</div>
								</div>
							</form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- fin modal modificar usuario -->
      <?php } ?>
      <script type="text/javascript">
      $(document).ready(function(){

        $('#b-recuperar').click(function(e){
          e.preventDefault();
          $('#pass-user .alert').hide('fast');
          $('#b-recuperar').button('loading');
          $('#pass-user .progress').show();

          var form = $('#pass-user');
          var action = form.attr('action');
          var pasas = false;
          
          var fields = $('#pass-user input').filter('[required]').length;
          $('#pass-user input').filter('[required]').each(function(){
            var val = $(this).val();
            if(val == ""){
              $(this).closest('.form-group').addClass('has-error');
            }
            else{
              $(this).closest('.form-group').removeClass('has-error');
              fields = fields-1;
            }
          });

          if(fields!=0){
            $('#pass-user .alert').removeClass('alert-success').addClass('alert-danger');
            $('#pass-user .alert #msj').html('Debe completar todos los campos requeridos');
            $('#pass-user .progress').hide();
            $('#b-recuperar').button('reset');
            $('#pass-user .alert').show().delay(7000).hide('slow');
          }else{
            var p1 = $('#p1').val();
            var p2 = $('#p2').val();

            if(p1===p2){
              pasa = true;
            }else{
              $('#pass-user .alert').removeClass('alert-success').addClass('alert-danger');
              $('#pass-user .alert #msj').html('Las contraseñas no coinciden');
              $('#pass-user .progress').hide();
              $('#b-recuperar').button('reset');
              $('#pass-user .alert').show().delay(7000).hide('slow');
            }

            if(pasa){
              $.ajax({
                type: 'POST',
                cache: false,
                url: action,
                data: form.serialize(),
                dataType: 'json',
                success: function(r){
                  if(r.response){
                    $('#pass-user .alert').removeClass('alert-danger').addClass('alert-success');
                    $('#pass-user')[0].reset();
                  }else{
                    $('#pass-user .alert').removeClass('alert-success').addClass('alert-danger');
                  }
                  $('#password').html(r.data);
                  $('#pass-user .alert #msj').html(r.msj);
                },
                error: function(){
                  $('#pass-user .alert').removeClass('alert-success').addClass('alert-danger');
                  $('#pass-user .alert #msj').html('Ha ocurrido un error inesperado');
                },
                complete: function(){
                  $('#b-recuperar').button('reset');
                  $('#pass-user .progress').hide('fast');
                  $('#pass-user .alert').show().delay(7000).hide('slow');
                }
              })
            }
          }
        });
		  
      });
    </script>
	<?
		break;
		case 'add':
		case 'edit':
		if($id>0){$user = $usuarios->obtener($id);}else{$user=NULL;}
    if($user==NULL){ $id = 0; $action = "agregar"; }else{ $action="edit"; }
		
	?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title"><i class="fa <?=($id>0)? 'fa-pencil':'fa-user-plus'?>"></i> <?=($id>0)?'Modificar':'Agregar'?> Usuario</h3><br>
						</div>

						<div class="box-body">
							<form id="registro" class="form-horizontal" action="funciones/usuarios.php" method="POST">
								<input id="action" type="hidden" name="action" value="<?=$action?>">
								<?
								if($id>0){ ?>
									<input type="hidden" name="id" value="<?=$id?>">
								<?}?>
								<div class="form-group">
									<label for="email" class="col-md-4 control-label">Cedula: *</label>
									<div class="col-md-5">
										<input id="cedula" class="form-control" type="cedula"  placeholder="Cedula" name="cedula" value="<?=($id>0)?$user->cedula:'' ?>"  required>
									</div>
								</div>

								<div class="form-group">
									<label for="nombre" class="col-md-4 control-label">Nombres: *</label>
									<div class="col-md-5">
										<input id="nombre" class="form-control" type="text" placeholder="Nombres" name="nombres" value="<?=($id>0)?$user->nombres:'' ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="apellido" class="col-md-4 control-label">Apellidos: *</label>
									<div class="col-md-5">
										<input id="apellido" class="form-control" type="text" placeholder="Apellidos" name="apellidos" value="<?=($id>0)?$user->apellidos:''?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="cedula" class="col-md-4 control-label">Fecha de nacimiento: *</label>
									<div class="col-md-5">
										<input id="datepicker" class="form-control" type="text" placeholder="Fecha de nacimiento" name="fecha_nac" value="<?=($id>0)?$user->fecha_nac:''?>" required>
									</div>
								</div>

								 <?php if($id==0){
									      ?>
								 <div class="form-group">
								    <label for="pass" class="col-md-4 control-label">Contraseña: *</label>
									    <div class="col-md-5">
									      <input type="password" class="form-control" id="pass" placeholder="Contrase&ntilde;a" name="password" required>
										</div>
								 </div>
									 <?php } ?>
									      

								<div class="form-group">
									<label for="division" class="col-md-4 control-label">Direccion: *</label>
									<div class="col-md-5">
										<input type="text" name="direccion" class="form-control" placeholder="Direccion" value="<?=($id>0)?$user->direccion:''?>" required>
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
		$users = $usuarios->consulta();
	?>

		  <div class="box box-default color-palette-box">
		    <div class="box-header with-border">
		      <h3 class="box-title"><i class="fa fa-users"></i> Usuarios registrados</h3>
		      <div class="pull-right">
            <a class="btn btn-flat btn-sm btn-success" href="?ver=usuarios&opc=add"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar usuario</a>
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
			          <th>Fecha de nacimiento</th>
			          <th>Direccion</th>
			          <th>Accion</th>
			        </tr>
			      </thead>
			      <tbody>
						<? $i = 1;
							foreach ($users as $d) {
						?>
							<tr>
								<td class="text-center"><?=$i?></td>
								<td><?=$d->cedula?></td>
								<td><?=$d->nombres?></td>
								<td><?=$d->apellidos?></td>
								<td><?=$d->fecha_nac?></td>
								<td><?=$d->direccion?></td>
								<td class="text-center">
									<a class="btn btn-flat btn-primary btn-sm" href="?ver=usuarios&opc=ver&id=<?=$d->idpersona?>"><i class="fa fa-search"></i></a>
									<a class="btn btn-flat btn-success btn-sm" href="?ver=usuarios&opc=edit&id=<?=$d->idpersona?>"><i class="fa fa-pencil"></i></a>
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



