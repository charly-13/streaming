var tableSesiones;
document.addEventListener('DOMContentLoaded',function(){

	    tableSesiones = $('#tableSesiones').dataTable( {
		"aProcessing":true,
		"aServerSide":true, 
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Sesiones/getSesiones",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_sesion"},
            {"data":"tema",className: "align-middle text-center text-sm"},            
            {"data":"fecha",className: "align-middle text-center text-sm"},
            {"data":"activo",className: "align-middle text-center text-sm"},
            {"data":"actual",className: "align-middle text-center text-sm"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });




    //validamos si existe elemento foto
    if(document.querySelector("#foto")){
    	var foto = document.querySelector("#foto");
    	foto.onchange = function(e) {
    		var uploadFoto = document.querySelector("#foto").value;
    		var fileimg = document.querySelector("#foto").files;
    		var nav = window.URL || window.webkitURL;
    		var contactAlert = document.querySelector('#form_alert');
    		if(uploadFoto !=''){
    			var type = fileimg[0].type;
    			var name = fileimg[0].name;
    			if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
    				contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
    				if(document.querySelector('#img')){
    					document.querySelector('#img').remove();
    				}
    				document.querySelector('.delPhoto').classList.add("notBlock");
    				foto.value="";
    				return false;
    			}else{  
    				contactAlert.innerHTML='';
    				if(document.querySelector('#img')){
    					document.querySelector('#img').remove();
    				}
    				document.querySelector('.delPhoto').classList.remove("notBlock");
    				var objeto_url = nav.createObjectURL(this.files[0]);
    				document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
    			}
    		}else{
    			alert("No selecciono foto");
    			if(document.querySelector('#img')){
    				document.querySelector('#img').remove();
    			}
    		}
    	}
    }

    if(document.querySelector(".delPhoto")){
    	var delPhoto = document.querySelector(".delPhoto");
    	delPhoto.onclick = function(e) {
    		removePhoto();
    	}
    }

// NUEVA SESIÓN
var formSesion = document.querySelector("#formSesion");
formSesion.onsubmit = function(e){
	e.preventDefault();
	var intIdSesion = document.querySelector('#idSesion').value;
	var strTema = document.querySelector('#txtTema').value;
	var strDescripcion = document.querySelector('#txtDescripcion').value;
	var strUrlStreaming = document.querySelector('#txtUrlStreaming').value;
	var strFecha = document.querySelector('#txtFecha').value;
	var strHora = document.querySelector('#txtHora').value;
	
	if(strTema == '' || strFecha=='' || strHora==''){
	
		 swal.fire("Atención", "Todos los campos son obligatorios." , "error");
		// alert("campos obligatrios")
		return false;
	}
	// divLoading.style.display="flex";
	var request =(window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Sesiones/setSesion';
	var formData = new FormData(formSesion);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
		if(request.readyState==4 && request.status==200){
			var objData = JSON.parse(request.responseText);
			if(objData.status){
				$("#modalFormSesion").modal("hide");
				formSesion.reset();
				swal.fire("Sesión",objData.msg,"success");			
				 // toastr.success(objData.msg);
				tableSesiones.api().ajax.reload();
			}else{
               swal.fire("Error", objData.msg,"error");
			}
		}
		// divLoading.style.display="none";
		return false;
	}
}

},false);

function fntViewInfo(idsesion){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Sesiones/getSesion/'+idsesion;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#sesionId").innerHTML = objData.data.id_sesion;
                document.querySelector("#sesionTema").innerHTML = objData.data.tema;
                 document.querySelector("#sesionDescripcion").innerHTML = objData.data.descripcion;
                // document.querySelector("#sesionurlregistro").innerHTML = objData.data.tema;
                document.querySelector("#sesionurlstreaming").innerHTML = objData.data.url_streaming;
                // document.querySelector("#celTema").innerHTML = objData.data.tema;
                document.querySelector("#imgPrograma").innerHTML = '<img class="w-25" src="'+objData.data.url_programa+'"></img><br>';
                $('#modalViewCategoria').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }

       $('#modalViewSesion').modal('show');
}




function removePhoto(){
	document.querySelector('#foto').value ="";
	document.querySelector('.delPhoto').classList.add("notBlock");
	document.querySelector('#img').remove();
}

function openModal(){

	    document.querySelector('#idSesion').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("bg-gradient-primary", "bg-gradient-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Sesión";
    document.querySelector("#formSesion").reset();
	$("#modalFormSesion").modal("show");
}
