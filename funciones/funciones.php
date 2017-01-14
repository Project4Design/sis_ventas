<?

require_once "../config/config.php";


class Sesiones{
	private $rh;
	public function __CONSTRUCT()

	{

		$this->rh = new ResponseHelper();
	}

	public function login($cedula,$password){

		$result = Query::prun("SELECT * FROM user WHERE cedula = ? LIMIT 1",array("i",$cedula));

		if($result->result->num_rows>0){

			$user = (object)$result->result->fetch_array(MYSQLI_ASSOC);

			if(password_verify($password,$user->password)){

				$_SESSION['idpersona'] = $user->idpersona;
				$_SESSION['cedula']  = $user->cedula;
				$_SESSION['nombres']  = $user->nombres;
				$_SESSION['apellidos']  = $user->apellidos;
				//$_SESSION['nivel']  = $user->user_nivel;

				$this->rh->setResponse(true,"Iniciando sesion",true,"inicio.php");
			}else{

				$this->rh->setResponse(false,"Usuario y/o clave incorrectos");
			}
		}else{

			$this->rh->setResponse(false,"Usuario y/o clave incorrectos");
		}
		echo json_encode($this->rh);
	}//Login

	public function logout(){
    session_unset();
    session_destroy();

    $this->rh->setResponse(true);
    $this->rh->redirect = "index.php";
    echo json_encode($this->rh);

	}//log-out

}//Class Funciones
// Logica

$modelSesiones = new Sesiones();

if(Base::IsAjax()):
	if(isset($_POST['action'])):
	  switch ($_POST['action']):
			case 'login':
				$cedula   = $_POST['cedula'];
				$password = $_POST['password'];

				$modelSesiones->Login($cedula,$password);
			break;
			case 'logout':
				$modelSesiones->logout();
			break;
		endswitch;
	endif;
endif;


?>