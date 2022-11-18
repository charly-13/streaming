<?php 

class SesionesModel extends Mysql
{

	private $intIdSesion;
	private $strTema;
	private $strDescripcion;
	private $strUrl;
	private $strFecha;
	private $strHora;
	private $strImagen;
	private $strToken;

	public function __construct()
	{
		parent::__construct();
	}

	public function insertSesion(string $tema, string $descripcicion, string $fecha, string $hora, string $urlstreaming, string $imagen,string $token){
		$return = 0;
		$this ->strTema = $tema;
		$this ->strDescripcion = $descripcicion;
		$this ->strFecha = $fecha;
		$this ->strHora = $hora;
		$this ->strUrl = $urlstreaming;
		$this ->strImagen = $imagen;
		$this ->strToken = $token;

		$query_insert = "INSERT INTO sesiones(tema,descripcion,fecha,hora,url_streaming,programa,token) VALUES(?,?,?,?,?,?,?)";		
		$arrData = array(
			$this ->strTema,
			$this ->strDescripcion,			
			$this ->strFecha,
			$this ->strHora,
			$this ->strUrl,
			$this ->strImagen,
			$this ->strToken,
		);

		$request_insert = $this->insert($query_insert,$arrData);
		$return =$request_insert;

		return $return;
	}

	public function selectSesiones(){

		$sql = "SELECT * FROM sesiones WHERE status != 0";
		$request = $this->select_all($sql);
		return $request;

	}

	public function selectSesion(int $idsesion){
		$this->intIdsesion = $idsesion;
		$sql = "SELECT * FROM sesiones
		WHERE id_sesion = $this->intIdsesion";
		$request = $this->select($sql);
		return $request;
	}


}

?>