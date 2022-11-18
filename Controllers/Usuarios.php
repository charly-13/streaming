<?php 

	class Usuarios extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if (empty($_SESSION['login'])) {
				header('location:' . base_url() . '/login');
			}
			
			getPermisos(2);
		}

		public function usuarios()
		{
			// $data['page_id'] = 1;
			if (empty($_SESSION['permisosMod']['r'])) { 
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "USUARIOS";
			$data['page_title'] = "Usuarios";
			$data['page_name'] = "usuarios";
			$data['page_functions_js']="functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);
		}

		public function setUsuario(){
			if($_POST){
				// dep($_POST);
				// die();
				// Verificamos que el array que mandamos venga con información
				if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
				{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
			}		
			
			else {

				// dep($_POST);
				// die();
				// Creamos las variables para almacenar los datos que recibimos
				$idUsuario = intval($_POST['idUsuario']);
				$strNombre = ucwords(strClean($_POST['txtNombre'])); //ucwords Convierte primer letra en mayuscula
				$strApellido = ucwords(strClean($_POST['txtApellido'])); //ucwords Convierte primer letra en mayuscula
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strEmail = strtolower(strClean($_POST['txtEmail']));
				$intTipoid	= intval($_POST['listRolid']);
				$intStatus = intval($_POST['listStatus']);

				if($idUsuario==0){
                    $option=1;
					$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);			
					$request_user = $this->model->insertUsuario($strNombre, $strApellido,
					$intTelefono,
					$strEmail,
					$strPassword,
					$intTipoid,
					$intStatus
					
				);

				}else{
					$option=2;
					$strPassword =  empty($_POST['txtPassword']) ? "": hash("SHA256",$_POST['txtPassword']);			
					$request_user = $this->model->updateUsuario($idUsuario,$strNombre, $strApellido,
					$intTelefono,
					$strEmail,
					$strPassword,
					$intTipoid,
					$intStatus
					
				);

				}

				// dep($request_user);
				// die();

				if ($request_user > 0) {
					if($option==1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente');
					}					
				} else if ($request_user == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos');
				}				
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getUsuarios(){
		$arrData= $this->model->selectUsuarios();
		// dep($arrData);
		// die();

		for ($i = 0; $i < count($arrData); $i++) {
			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
		if($arrData[$i]['status']==1){
			// $arrData[$i]['email_user'] = '<a href="mailto:'. $arrData[$i]['email_user'] .'"><h6 class="mb-0 text-sm"><span class="fa fa-mail-bulk" style="font-size: 13px" aria-hidden="true"></span> '. $arrData[$i]['email_user'] .'</h6></a>';
			// 	$arrData[$i]['telefono'] = '<a href="https://api.whatsapp.com/send?phone=' . $arrData[$i]['telefono'] . '&amp;text=¡Buen día! Te contacto del Equipo Fortaleza Charly" target="_blank"><p class="text-sm font-weight-bold text-secondary mb-0"><span class="fa fa-whatsapp" style="font-size: 18px; color:green;" aria-hidden="true"></span> ' . $arrData[$i]['telefono'] . '</p></a>';
				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-sm badge-success ">Activo</span>';
				} else  {
					$arrData[$i]['status'] = '<span class="badge badge-sm badge-danger">Inactivo</span>';
				}

				if($_SESSION['permisosMod']['r']){
					$btnView = '<a href="javascript:;" class="btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver usuario">
					<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
				  </a>';
				}


				if ($_SESSION['permisosMod']['u']) {
					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1)
					) {
						$btnEdit = '	<a href="javascript:;" class="mx-3 btnEditRol" onClick="fntEditUsuario(' . $arrData[$i]['idpersona'] . ')" data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
					<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
				  </a>';
					}else{
						$btnEdit = '	<a href="javascript:;" class="mx-3 btnEditRol" disabled data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
						<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
					  </a>';
					}
				}

				if($_SESSION['permisosMod']['d']){

					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
					($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
					($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'] )
					 ) {
					$btnDelete = '
					<a href="javascript:;" data-bs-toggle="tooltip" class="btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')"  data-bs-original-title="Delete product">
					  <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
					</a>';
				}else{
					$btnDelete = '
					<a href="javascript:;" data-bs-toggle="tooltip" class="btnDelUsuario" disabled  data-bs-original-title="Delete product">
					  <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
					</a>';
				}
				}

				$arrData[$i]['options'] = '
			<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete. '</div>';		
		}
		}
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        // dep($arrData);

	}

	public function getUsuario($idpersona){

	
		
			$idusuario = intval($idpersona);
			if($idusuario > 0)
			{
				$arrData = $this->model->selectUsuario($idusuario);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		
		die();
	}


	public function delUsuario(){

		if($_POST){
			
			$intIdpersona = intval($_POST['idUsuario']);
			// dep($intIdpersona);
			// die();
			$requestDelete = $this->model->deleteUsuario($intIdpersona);
			if($requestDelete){
				$arrResponse = array('status'=>true,'msg'=>'Se ha eliminado el usuario');
			}else{
				$arrResponse = array('status'=>false,'msg'=>'Error al eliminar el usuario');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function perfil(){
		$data['page_tag'] = "PERFIL";
		$data['page_title'] = "Perfil - Usuario";
		$data['page_name'] = "perfil";
		$data['page_functions_js']="functions_usuarios.js";
		$this->views->getView($this,"perfil",$data);
	}

	public function putDpersonales(){
		dep($_POST);
		die();
	}
        

	}
