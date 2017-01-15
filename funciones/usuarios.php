<?
if(is_readable('../config/config.php')){
  require '../config/config.php';
}

class Usuarios{
	private $rh;
	private $user;
	private $nivel;
	private $fecha;
	private $hora;

	public function __CONSTRUCT()
	{
		$this->rh    = new ResponseHelper();
		$this->user  = isset($_SESSION['idpersona']) ? $this->user = $_SESSION['idpersona'] : $this->user = 0;
		//$this->nivel = isset($_SESSION['nivel']) ? $this->nivel = $_SESSION['nivel'] : $this->nivel = "X";
		$this->fecha = Base::Fecha();
		$this->hora  = Base::Hora();
	}

	public function consulta()
	{

    $query = Query::run("SELECT * FROM user");
    $data = array();

    while($registro = $query->fetch_array(MYSQLI_ASSOC)){
    	$data[] = (object)$registro;
    }

    return $data;
	}//consulta

	public function add($cedula,$nombres,$apellidos,$fecha_nac,$password,$direccion)
	{
		$query = Query::prun("SELECT cedula FROM user WHERE cedula = ? LIMIT 1",array("s",$cedula));

		if($query->result->num_rows>0){
    	$this->rh->setResponse(false,"Usuario ya registrado.");
		}else{
	
		  	$query = Query::prun("INSERT INTO user (cedula,nombres,apellidos,fecha_nac,password,direccion,fecha_reg)
											VALUES(?,?,?,?,?,?,?)",
											array("sssssss",$cedula,$nombres,$apellidos,$fecha_nac,$password,$direccion,$this->fecha));
		  	if($query->response){
					$this->rh->setResponse(true,"Registro exitoso!", true,"inicio.php?ver=usuarios");
		  	}else{
					$this->rh->setResponse(false,"Oops! Ah ocurrido un error!");
		  	}
		  
		}

		echo json_encode($this->rh);
		
	}//add

	public function CantUsu()
	{

	    $query = Query::run("SELECT count(*) AS total FROM user");
	    $registro = $query->fetch_array(MYSQLI_ASSOC);
	    $data = $registro['total'];

		return $data;
	}//cantidad de usuarios

	public function obtener($id)
	{

    $query = Query::prun("SELECT * FROM user WHERE idpersona = ?",array("i",$id));

    if($query->result->num_rows >0){
    	$data = (object)$query->result->fetch_array(MYSQLI_ASSOC);
		}else{
			$data = NULL;
		}

    return $data;
	}//obtener

	public function perfil()
	{
    $query = Query::run("SELECT * FROM user WHERE idpersona = $this->user");

    if($query->num_rows >0){
    	$data = (object)$query->fetch_array(MYSQLI_ASSOC);
		}else{
			$data = NULL;
		}

    return $data;
	}//perfil

	public function edit($id,$cedula,$nombres,$apellidos,$fecha_nac,$direccion)
	{
		$id = $this->user;
		
		/*$query = Query::prun("SELECT cedula FROM user WHERE cedula = ? AND idpersona != ? LIMIT 1",array("si",$cedula,$id));
		
		if($query->result->num_rows>0){
		  $this->rh->setResponse(false,"Ya existe un usuario registrado con esta cedula.");
		}else{*/
		  	$query = Query::prun("UPDATE user SET
		  													cedula    = ?,
															nombres   = ?,
															apellidos = ?,
															fecha_nac = ?,
															direccion = ?
														WHERE idpersona = ? LIMIT 1",
														array("sssssi",$cedula,$nombres,$apellidos,$fecha_nac,$direccion,$this->user));
		  	if($query->response){
					$this->rh->setResponse(true,"Cambios guardados con exito!",true,"inicio.php?ver=usuarios");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			//}
		
		echo json_encode($this->rh);

	}//Modificar usuario


	public function delete($idper)
	{
		$id = $this->user;
		
		$query = Query::prun("DELETE  FROM user WHERE idpersona = ? LIMIT 1",array("i",$idper));
		
	
		  	if($query->response){
						$this->rh->setResponse(true,"Borrado exito!",true,"inicio.php?ver=usuarios");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			
		
		echo json_encode($this->rh);

	}//borrar usuario
	public function newpass($actual,$nueva){

		$query = Query::run("SELECT password FROM user WHERE idpersona = $this->user LIMIT 1");

		if($query->num_rows>0){
			$us = (object) $query->fetch_array(MYSQLI_ASSOC);

			if(password_verify($actual,$us->password)){
				$query = Query::prun("UPDATE user SET password = ? WHERE idpersona = ? LIMIT 1",array("si",$nueva,$this->user));

				if($query->response){
					$this->rh->setResponse(true,"Contraseña actualizada");
				}else{
					$this->rh->setResponse(false,"Ha ocurrido un error. Intente mas tarde");
				}
			}else{
				$this->rh->setResponse(false,"Contraseña incorrecta");
			}
		}else{
			$this->rh->setResponse(false,"Ha ocurrido un error");
		}

		echo json_encode($this->rh);
	}//newpass

}//Class Usuarios

$modelUser = new Usuarios();

if(Base::IsAjax()):
	if(isset($_POST['action'])):
	  switch ($_POST['action']):
			case 'agregar':
				$cedula    = $_POST["cedula"];
				$nombres   = $_POST["nombres"];
				$apellidos = $_POST["apellidos"];
				$fecha_nac = $_POST["fecha_nac"];
				$password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$direccion = $_POST["direccion"];
								
				$modelUser->add($cedula,$nombres,$apellidos,$fecha_nac,$password,$direccion);
			break;

			case 'edit':
				$id        = $_POST["id"];
				$cedula    = $_POST["cedula"];
				$nombres   = $_POST["nombres"];
				$apellidos = $_POST["apellidos"];
				$fecha_nac = $_POST['fecha_nac'];
				$direccion = $_POST['direccion'];
				
				$modelUser->edit($id,$cedula,$nombres,$apellidos,$fecha_nac,$direccion);
			break;

			case 'recuperar':
				$actual = $_POST['actual'];
				$nueva  = password_hash($_POST['p2'], PASSWORD_DEFAULT);

				$modelUser->newpass($actual,$nueva);
			break;
			case 'delete':
				$idper = $_POST['id'];
				$modelUser->delete($idper);
			break;
		endswitch;
	endif;
endif;
?>