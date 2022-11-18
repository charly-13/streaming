<?php

class Login extends Controllers
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['login'])) {
			header('location:' . base_url() . '/dashboard');
		}
		parent::__construct();
	}

	public function login()
	{

		$data['page_tag'] = "Login - Streaming";
		$data['page_title'] = "Login";
		$data['page_name'] = "login";
		$data['page_functions_js'] = "functions_login.js";
		$this->views->getView($this, "login", $data);
	}

	public function loginUser()
	{
		// dep($_POST);
		if ($_POST) {
			if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {
				$strUsuario = strtolower(strClean($_POST['txtEmail']));
				$strPassword = hash("SHA256", $_POST['txtPassword']);
				$requestUser = $this->model->loginUser($strUsuario, $strPassword);
				// dep($requestUser);
				if (empty($requestUser)) {
					$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto');
				} else {
					$arrData = $requestUser;
					if ($arrData['status'] == 1) {
						$_SESSION['idUser'] = $arrData['idpersona'];
						$_SESSION['login'] = true;

						$arrData = $this->model->sessionLogin($_SESSION['idUser']);
						sessionUser($_SESSION['idUser']);	
						$arrResponse = array('status' => true, 'msg' => 'ok');
					} else {
						$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');
					}
				}
			}
			// sleep(5);
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function resetPass()
	{
		if ($_POST) {
			// error_reporting(0);
			if (empty($_POST['txtEmailReset'])) {
				$arrResponse = array("status" => false, "msg", "Error de datos");
			} else {
				$token = token();
				$strEmail = strtolower(strClean($_POST['txtEmailReset']));
				$arrData = $this->model->getUserEmail($strEmail);
				if (empty($arrData)) {
					$arrResponse = array("status" => false, "msg" => "El email que ingresaste no existe");
				} else {
					$idpersona = $arrData['idpersona'];
					$nombreUsuario = $arrData['nombres'] . ' ' . $arrData['apellidos'];
					$url_recovery = base_url() . '/login/confirmUser/' . $strEmail . '/' . $token;
					$requestUpdate = $this->model->setTokenUser($idpersona, $token);

					$dataUsuario = array(
						'nombreUsuario' => $nombreUsuario,
						'asunto' => 'Recuperar Cuenta -' . NOMBRE_REMITENTE,
						'url_recovery' => $url_recovery
					);
					


					if ($requestUpdate) {

						$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');
						// var_dump($sendEmail);
						// exit();

						if($sendEmail){
							$arrResponse = array("status" => true, "msg" => "Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña");

						}else{
							$arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, intenta más tarde");

						}
					} else {
						$arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, intenta más tarde");
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function confirmUser(string $params)
	{

		if (empty($params)) {
			header('Location: ' . base_url());
		} else {
			// echo $params;
			$arrParams = explode(',', $params);
			// dep($arrParams);
			$strEmail = strClean($arrParams[0]);
			$strToken = strClean($arrParams[1]);
			$arrResponse = $this->model->getUsuario($strEmail, $strToken);
			if (empty($arrResponse)) {
				header('Location: ' . base_url());
			} else {

				$data['page_tag'] = "Cambiar Contraseña";
				$data['page_name'] = "cambiar contraseña";
				$data['page_functions_js'] = "functions_login.js";
				$data['email'] = $strEmail;
				$data['token'] = $strToken;
				$data['idpersona'] = $arrResponse['idpersona'];
				$this->views->getView($this, "cambiar_password", $data);
			}
		}
		// echo json_encode(JSON_UNESCAPED_UNICODE);
		die();
	}
	public function setPassword()
	{
		if ($_POST) {
			if (empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])) {
				$arrResponse = array("status" => false, "msg" => "Error de datos");
			} else {
				$intIdpersona = intval($_POST['idUsuario']);
				$strPassword = $_POST['txtPassword'];
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];
				$strEmail = strClean($_POST['txtEmail']);
				$strToken = strClean($_POST['txtToken']);

				if ($strPassword != $strPasswordConfirm) {
					$arrResponse = array("status" => false, "msg" => "Las contraseñas no son iguales");
				} else {

					$arrResponseUser = $this->model->getUsuario($strEmail, $strToken);
					if (empty($arrResponseUser)) {
						$arrResponse = array("status" => false, "msg" => "Error de datos");
					} else {

						$strPassword = hash("SHA256", $strPassword);
						$requestPass = $this->model->insertPassword($intIdpersona, $strPassword);

						if ($requestPass) {
							$arrResponse = array("status" => true, "msg" => "Contraseña actualizada con éxito");
						} else {
							$arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, intente más tarde.");
						}
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}
	}
}
