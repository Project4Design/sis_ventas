<?
if(is_readable('../config/config.php')){
  require '../config/config.php';
}

class Clientes{
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

    $query = Query::run("SELECT * FROM cliente");
    $data = array();

    while($registro = $query->fetch_array(MYSQLI_ASSOC)){
    	$data[] = (object)$registro;
    }

    return $data;
	}//consulta

	public function add($cedula,$nombres,$apellidos,$direccion)
	{
		$query = Query::prun("SELECT cedula FROM cliente WHERE cedula = ? LIMIT 1",array("s",$cedula));

		if($query->result->num_rows>0){
    	$this->rh->setResponse(false,"Cliente ya registrado.");
		}else{
	
		  	$query = Query::prun("INSERT INTO cliente (cedula,nombre,apellido,direccion,fecha_reg_cliente)
											VALUES(?,?,?,?,?)",
											array("sssss",$cedula,$nombres,$apellidos,$direccion,$this->fecha));
		  	if($query->response){
					$this->rh->setResponse(true,"Registrado con exito!",true,"inicio.php?ver=clientes");
		  	}else{
					$this->rh->setResponse(false,"Oops! Ah ocurrido un error!");
		  	}
		  
		}

		echo json_encode($this->rh);
		
	}//add

	public function CantUsu()
	{

	    $query = Query::run("SELECT count(*) AS total FROM cliente");
	    $registro = $query->fetch_array(MYSQLI_ASSOC);
	    $data = $registro['total'];

		return $data;
	}//cantidad de usuarios

	public function obtener($id)
	{

    $query = Query::prun("SELECT * FROM cliente WHERE idcliente = ?",array("i",$id));

    if($query->result->num_rows >0){
    	$data = (object)$query->result->fetch_array(MYSQLI_ASSOC);
		}else{
			$data = NULL;
		}

    return $data;
	}//obtener

	public function perfil()
	{
    $query = Query::run("SELECT * FROM cliente WHERE idcliente = $this->user");

    if($query->num_rows >0){
    	$data = (object)$query->fetch_array(MYSQLI_ASSOC);
		}else{
			$data = NULL;
		}

    return $data;
	}//perfil

	public function edit($id,$cedula,$nombres,$apellidos,$direccion)
	{
		//$id = $this->user;
		
		
		/*$query = Query::prun("SELECT cedula FROM user WHERE cedula = ? AND idpersona != ? LIMIT 1",array("si",$cedula,$id));
		
		if($query->result->num_rows>0){
		  $this->rh->setResponse(false,"Ya existe un usuario registrado con esta cedula.");
		}else{*/

		  	 $query = Query::prun("UPDATE cliente SET cedula    = ?, nombre    = ?, apellido = ?, direccion = ? WHERE idcliente = ? LIMIT 1", array("ssssi",$cedula,$nombres,$apellidos,$direccion,$id));

		  	if($query->response){
					$this->rh->setResponse(true,"Cambios guardados con exito!",true,"inicio.php?ver=clientes");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			//}
		
		echo json_encode($this->rh);

	}//Modificar usuario


	public function delete($idcl)
	{
		$id = $this->user;
		
		$query = Query::prun("DELETE  FROM cliente WHERE idcliente = ? LIMIT 1",array("i",$idcl));
		
	
		  	if($query->response){
					$this->rh->setResponse(true,"Se ha borrado con exito!",true,"inicio.php?ver=clientes");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			
		
		echo json_encode($this->rh);

	}//Modificar usuario


}//Class Usuarios

$modelUser = new Clientes();

if(Base::IsAjax()):
	if(isset($_POST['action'])):
	  switch ($_POST['action']):
			case 'agregar':
				$cedula    = $_POST["cedula"];
				$nombres   = $_POST["nombres"];
				$apellidos = $_POST["apellidos"];
				$direccion = $_POST["direccion"];
								
				$modelUser->add($cedula,$nombres,$apellidos,$direccion);
			break;

			case 'edit':
				$id        = $_POST["id"];
				$cedula    = $_POST["cedula"];
				$nombres   = $_POST["nombres"];
				$apellidos = $_POST["apellidos"];
				$direccion = $_POST['direccion'];
				
				$modelUser->edit($id,$cedula,$nombres,$apellidos,$direccion);
			break;

			/*case 'recuperar':
				$actual = $_POST['actual'];
				$nueva  = password_hash($_POST['p2'], PASSWORD_DEFAULT);

				$modelUser->newpass($actual,$nueva);
			break;*/
			case 'delete':
				$idcl = $_POST['id'];
				$modelUser->delete($idcl);
			break;
		endswitch;
	endif;
endif;
?>