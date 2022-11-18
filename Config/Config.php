<?php 
	
	//define("BASE_URL", "http://localhost/fortalezacc/");
	const BASE_URL = "http://localhost/streaming";
setlocale(LC_TIME, 'spanish');
	//Zona horaria
	date_default_timezone_set('America/Mexico_City');


	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "streaming_amc";
	const DB_USER = "streaming_amc";
	const DB_PASSWORD = "/*/*ia88tl41";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "Q";
	const NOMBRE_REMITENTE = "STREAMING";
	const EMAIL_REMITENTE ="carloscc_1997@outlook.com";

	const NOMBRE_EMPESA ="FORTALEZA CHARLY";
	const WEB_EMPRESA ="www.fortalezac.com";

	


 ?>