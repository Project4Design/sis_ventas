<?
if(is_readable('../config/config.php')){
  require '../config/config.php';
}


class Productos{
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

	public function consultaCat()
	{

	    $query = Query::run("SELECT * FROM categoria");
	    $data = array();

	    while($registro = $query->fetch_array(MYSQLI_ASSOC)){
	    	$data[] = (object)$registro;
    }

    return $data;
	}//consulta

	public function consultaProd()
	{

	    $query = Query::run("SELECT p.* , c.nombre  FROM productos AS p INNER JOIN categoria AS c ON p.idcategoria = c.id_categoria ");
	    $data = array();

	    while($registro = $query->fetch_array(MYSQLI_ASSOC)){
	    	$data[] = (object)$registro;
	    }

    return $data;
	}//consulta


	public function add($codigo,$nombre,$descripcion,$categoria)
	{
		$query = Query::prun("SELECT nombre_prod,codigo FROM productos WHERE codigo = ? and nombre_prod = ? LIMIT 1",array("ss",$codigo,$nombre));

		if($query->result->num_rows>0){
    	$this->rh->setResponse(false,"Producto ya registrado.");
		}else{
	
		  	$query = Query::prun("INSERT INTO productos (idcategoria,codigo,nombre_prod,descripcion)
											VALUES(?,?,?,?)",
											array("ssss",$categoria,$codigo,$nombre,$descripcion));
		  	if($query->response){
					$this->rh->setResponse(true,"Registro exitoso!", true,"inicio.php?ver=productos");
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

	public function obtenerCat($id)
	{

    $query = Query::prun("SELECT * FROM categoria WHERE idcategoria = ?",array("i",$id));

    if($query->result->num_rows >0){
    	$data = (object)$query->result->fetch_array(MYSQLI_ASSOC);
		}else{
			$data = NULL;
		}

    return $data;
	}//obtener categoria


	public function obtenerProd($id)
	{

    $query = Query::prun("SELECT p.* , c.nombre  FROM productos AS p INNER JOIN categoria AS c ON p.idcategoria = c.id_categoria WHERE p.idproducto = $id",array("i",$id));

	    if($query->result->num_rows >0){
	    	$data = (object)$query->result->fetch_array(MYSQLI_ASSOC);
			}else{
				$data = NULL;
			}

	    return $data;
	}//obtener productos todo

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

	public function edit($id,$nombre,$descripcion,$categoria)
	{
		//$id = $this->user;
		
		/*$query = Query::prun("SELECT cedula FROM user WHERE cedula = ? AND idpersona != ? LIMIT 1",array("si",$cedula,$id));
		
		if($query->result->num_rows>0){
		  $this->rh->setResponse(false,"Ya existe un usuario registrado con esta cedula.");
		}else{*/
		  	$query = Query::prun("UPDATE productos SET
		  													
															nombre_prod  = ?,
															descripcion = ?,
															idcategoria = ?
														WHERE idproducto = ? LIMIT 1",
														array("sssi",$nombre,$descripcion,$categoria,$id));
		  	if($query->response){
					$this->rh->setResponse(true,"Cambios guardados con exito!",true,"inicio.php?ver=productos");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			//}
		
		echo json_encode($this->rh);

	}//Modificar usuario


	public function delete($idpro)
	{
		$id = $this->user;
		
		$query = Query::prun("DELETE  FROM producto WHERE idproducto = ? LIMIT 1",array("i",$idpro));
		
	
		  	if($query->response){
						$this->rh->setResponse(true,"Borrado exito!",true,"inicio.php?ver=productos");
			  }else{
			    $this->rh->setResponse(false,"Ha ocurrido un error inesperado.");
			  }
			
		
		echo json_encode($this->rh);

	}//borrar producto
	
}//Class Usuarios

$modelProductos = new Productos();

if(Base::IsAjax()):
	if(isset($_POST['action'])):
	  switch ($_POST['action']):
			case 'agregar':
				$codigo    = $_POST["codigo"];
				$nombre   = $_POST["nombre"];
				$descripcion = $_POST["descripcion"];
				$categoria = $_POST["categoria"];
								
				$modelProductos->add($codigo,$nombre,$descripcion,$categoria);
			break;

			case 'edit':
				$id        = $_POST["id"];
				$nombre   = $_POST["nombre"];
				$descripcion = $_POST["descripcion"];
				$categoria = $_POST['categoria'];

				$modelProductos->edit($id,$nombre,$descripcion,$categoria);
			break;

			case 'delete':
				$idpro = $_POST['id'];
				$modelUser->delete($idpro);
			break;
		endswitch;
	endif;
endif;
?>