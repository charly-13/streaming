<?php 

	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if (empty($_SESSION['login'])) {
				header('location:' . base_url() . '/login');
			}
			getPermisos(2);
			
		}

		public function roles()
		{

			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 3;
			$data['page_tag'] = "ROLES DE USUARIO";
			$data['page_title'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_functions_js']="functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}

        public function getRoles(){
        $arrData= $this->model->selectRoles();            
		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
			if ($arrData[$i]['status'] == 1) {
				$arrData[$i]['status']='<span class="badge badge-sm badge-success">Activo</span>';
			}else{
				$arrData[$i]['status']='<span class="badge badge-sm badge-danger">Inactivo</span>';
			}


	

			if($_SESSION['permisosMod']['u']){ 
				$btnView = '<a href="javascript:;" class="btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['idrol'].')" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
				<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
			  </a>';
				$btnEdit = '<a href="javascript:;" class="mx-3 btnEditRol" onClick="fntEditRol('.$arrData[$i]['idrol'].')" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
				<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
			  </a>';
			}

			if($_SESSION['permisosMod']['d']){
				$btnDelete = '<a href="javascript:;" data-bs-toggle="tooltip" class="btnDelRol" onClick="fntDelRol('.$arrData[$i]['idrol'].')"  data-bs-original-title="Delete product">
				<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
			  </a>';
			}

            //Colocamos botones por cada registro
			$arrData[$i]['options']='<div class="text-center">'.$btnView .' '.$btnEdit.' '.$btnDelete.' </div>';		


		}
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        // dep($arrData);
        }

	public function getSelectRoles()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['status'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idrol'] . '">' . $arrData[$i]['nombrerol'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
		}

		public function getRol(int $idrol){
			$intIdrol=intval(strClean($idrol));
			if($intIdrol>0){
				$arrData=$this->model->selectRol($intIdrol);
				if(empty($arrData)){
                  $arrResponse=array('status'=>false,'msg'=>'Datos no encontrados');
				}else{
					$arrResponse=array('status'=>true,'data'=>$arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}

	public function setRol()
	{   $intIdRol = intval($_POST['idRol']);
		$strRol = strClean($_POST['txtNombre']);
		$strDescripcicion = strClean($_POST['txtDescripcion']);
		$intStatus = intval($_POST['listStatus']);
		// $request_rol = $this->model->insertRol($strRol, $strDescripcicion, $intStatus);
		if($intIdRol==0){
			// CREAMOS
			$request_rol = $this->model->insertRol($strRol, $strDescripcicion, $intStatus);
			$option=1;
		}else{
			//EDITAMOS
			$request_rol = $this->model->updateRol($intIdRol ,$strRol, $strDescripcicion, $intStatus);
			$option=2;
		}

		if ($request_rol > 0) {
			if($option==1){
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');

			}else{
				$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente');
			}
		} else if ($request_rol == 'exist') {
			$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe');
		} else {
			$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos');
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


	public function delRol()
	{
		if($_POST){ 
			// if($_SESSION['permisosMod']['d']){
				$intIdrol = intval($_POST['idrol']);
				$requestDelete = $this->model->deleteRol($intIdrol);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol correctamente');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			// }
		}
		die();
	}

	}
 ?>