<?php 
class Sesiones extends Controllers{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('location:' . base_url() . '/login');
		}

		getPermisos(3);
	}

	public function sesiones()
	{
			// $data['page_id'] = 1;
		if (empty($_SESSION['permisosMod']['r'])) { 
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "SESIONES";
		$data['page_title'] = "Sesiones";
		$data['page_name'] = "sesiones";
		$data['page_functions_js']="functions_sesiones.js";
		$this->views->getView($this,"sesiones",$data);
	}

	public function setSesion(){

		if($_POST){
			if(empty($_POST['txtTema']) || empty($_POST['txtFecha']) || empty($_POST['txtHora'])){
				$arrResponse = array('status'=>false,'msg'=>'Datos incorrectos');
			}else{
				$intIdSesion = intval($_POST['idSesion']);
				$strTema = strClean($_POST['txtTema']);
				$strDescripcion = strClean($_POST['txtDescripcion']);
				$strUrlStreaming = strClean($_POST['txtUrlStreaming']);
				$strFecha = strClean($_POST['txtFecha']);
				$strHora = strClean($_POST['txtHora']);
				$token = token();

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPrograma 	= 'portada_programa.png';
				$request_sesion = "";
				if($nombre_foto != ''){
					$imgPrograma = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
				}

				if($intIdSesion == 0)
				{
						//CREAR
					$request_sesion = $this->model->insertSesion($strTema,$strDescripcion,$strFecha,$strHora,$strUrlStreaming,$imgPrograma,$token);
					$option=1;
				}


				if($request_sesion>1){
					if($option==1){
						$arrResponse = array('status'=>true,'msg'=>'¡Datos guardados correctamente!');
						if($nombre_foto != ''){ uploadImage($foto,$imgPrograma); }
					}

				}

			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

		}
		die();
	}

	public function getSesiones(){
		$arrData = $this->model->selectSesiones();
		for ($i =0; $i < count($arrData); $i++){
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
			$fecha='';
			$hora='';

			if($arrData[$i]['activo']==1){
				$arrData[$i]['activo'] ='<span class="badge badge-sm badge-success">Activo</span>';
			}else{
				$arrData[$i]['activo'] ='<span class="badge badge-sm badge-danger">Inactivo</span>';
			}

			$btnView = '<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Ver información" onclick="fntViewInfo('.$arrData[$i]['id_sesion'].')">
			<i class="fas fa-eye text-secondary" aria-hidden="true" style="color:green !important"></i>
			</a>';

			$btnEdit = '<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Editar sesión" onclick="fntEditInfo('.$arrData[$i]['id_sesion'].')">
			<i class="fas fa-user-edit text-secondary" aria-hidden="true" style="color:orange !important"></i>
			</a>';

			$btnDelete = '<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Eliminar sesión" onclick="fntDelInfo('.$arrData[$i]['id_sesion'].')">
			<i class="fas fa-trash text-secondary" aria-hidden="true" style="color:red !important"></i>
			</a>';

			// $arrData['url_portada']=strftime("%A, %d de %B del %Y",strtotime($arrData['fecha']));

			// $fecha = $arrData[$i]['fecha'];
			// echo $fecha;
			// $fechac= strftime("%A, %d de %B del %Y",strtotime($fecha));
			// $arrData[$i]['fecha']=strftime("%A, %d de %B del %Y",strtotime($fecha));
			 // $hora  = $arrData[$i]['hora']; 
			 // echo $fecha;
			 // $horarioCompleto = $fecha.', '.$hora.'hrs';
			 // echo $horarioCompleto;

			// if($arrData[$i]['fecha']!=''){

			// 	$arrData[$i]['fecha']=	 $arrData[$i]['fecha'];
			// } 

			// $fecha= strftime("%A, %d de %B del %Y",strtotime($arrData[$i]['fecha']));
			 // $hora  = $arrData[$i]['hora']; 
			 // $horarioCompleto = $fecha.', '.$hora.'hrs';
			// // echo $fecha;

			// $arrData[$i]['fecha'] = $fecha;

			$arrData[$i]['options']='<div class="text-center">'.$btnView. ' '.$btnEdit.' ' .$btnDelete.'</div>';







			// echo $horarioCompleto;
			
		}

		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();

	}

	public function getSesion($idsesion){

		$intIdSesion = intval($idsesion);
		$arrData = $this->model->selectSesion($intIdSesion);
		if(empty($arrData)){
			$arrData = array('status' => false, 'msg' => 'Datos no encontrados');
		}else{
			$arrData['url_programa']=media().'/img/programas/'.$arrData['programa'];
			$arrResponse=array('status'=>true,'data'=>$arrData);
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();

	}
}
?>