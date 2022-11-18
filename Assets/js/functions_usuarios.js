var tableUsuarios;
document.addEventListener('DOMContentLoaded',function(){
    

    tableUsuarios = $('#tableUsuarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true, 
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"nombrerol"},
            {"data":"status"},
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




    var formUsuario=document.querySelector("#formUsuario");
    formUsuario.onsubmit=function(e){
        e.preventDefault();
        var strNombre=document.querySelector("#txtNombre").value;
        var strApellido=document.querySelector("#txtApellido").value;
        var strEmail=document.querySelector("#txtEmail").value;
        var intTelefono=document.querySelector("#txtTelefono").value;
        var intTipousuario=document.querySelector("#listRolid").value;
        let intStatus = document.querySelector('#listStatus').value;
        var strPassword=document.querySelector("#txtPassword").value;  
        if(strNombre=='' || strApellido=='' || strEmail=='' || intTelefono =='' || intTipousuario=='' || intStatus==''){
           swal.fire("Atención", "Todos los campos son obligatorios","error");
           return false;
        } 

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal.fire("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 



        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl=base_url+'/Usuarios/setUsuario';
        var formData=new FormData(formUsuario);
        request.open("POST",ajaxUrl,true)
        request.send(formData);

        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status==200){
                var objData=JSON.parse(request.responseText);
                if(objData.status){
                  $("#modalFormUsuario").modal("hide");
                  formUsuario.reset();
                  swal.fire("Usuarios",objData.msg,"success");
                  tableUsuarios.api().ajax.reload(function(){});
                }else{
                    swal.fire("Error",objData.msg,"error");
                }
            }
        }

    }
},false);

window.addEventListener('load',function(){
fntRolesUsuario();
},false);


function fntRolesUsuario(){
    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector("#listRolid").innerHTML = request.responseText;
            // document.querySelector("#listRolid").value = 1;
            $('#listRolid').selectpicker('render');
        }
    }

}

function fntViewUsuario(idpersona){

    // alert(idpersona);
    // die();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request .open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                let estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
                 document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
          $('#modalViewUser').modal('show');

        }else{
        swal.fire("Error", objData.msg , "error");
        }

    }
}   

}

function fntEditUsuario(idpersona){

    // alert(idpersona);
    // die();
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    document.querySelector('#btnActionForm').classList.replace("bg-gradient-primary", "bg-gradient-success");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request .open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
 
        if(request.readyState == 4 && request.status == 200){
            var objData=JSON.parse(request.responseText);           
        }
        if(objData.status){
        document.querySelector("#idUsuario").value=objData.data.idpersona;
        document.querySelector("#txtNombre").value = objData.data.nombres;
        document.querySelector("#txtApellido").value = objData.data.apellidos;
        document.querySelector("#txtTelefono").value = objData.data.telefono;
        document.querySelector("#txtEmail").value=objData.data.email_user;
        document.querySelector("#listRolid").value=objData.data.idUsuario;
        $('#listRolid').selectpicker('render');

        if(objData.data.status == 1){
            document.querySelector("#listStatus").value = 1;
        }else{
            document.querySelector("#listStatus").value = 2;
        }
        $('#listStatus').selectpicker('render');
        }

      
}   
$("#modalFormUsuario").modal("show");

}



function fntDelUsuario(idPersona){
    var idPersona = idPersona;
    swal.fire({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el usuario?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
}).then((result) => {
    if (result.isConfirmed) {

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Usuarios/delUsuario/';
            var strData = "idUsuario="+idPersona;
            request.open("POST",ajaxUrl,true);
            //FORMA DE COMO SE ENVIAMOS LOS DATOS
             request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState==4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal.fire("Eliminar", objData.msg , "success");
                        tableUsuarios.api().ajax.reload(function(){
                            // fntRolesUsuario();
                            // fntEditRol();
                            // fntDelRol();
                            // fntPermisos();
                        });
                    }else{
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }           

        }

    });

}


function openModal(){
    document.querySelector('#idUsuario').value ="";
    document.querySelector('#btnActionForm').classList.replace("bg-gradient-success", "bg-gradient-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}




function openModalPerfil(){
    $('#modalFormPerfil').modal('show');
}

if (document.querySelector("#formDataPersonales")) {
    var formDataPersonales = document.querySelector("#formDataPersonales");
    formDataPersonales.onsubmit = function (e) {
        e.preventDefault();
        var txtNombres = document.querySelector("#txtNombres").value;
        var txtApellidos = document.querySelector("#txtApellidos").value;
        var intTelefono = document.querySelector("#intTelefono").value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Usuarios/putDpersonales';
        var formData = new FormData(formDataPersonales);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    swal.fire({
                        title: "",
                        text: objData.msg,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'No, cancelar!',
                    }).then((result) => {
                        if (result.isConfirmed) {

                        }

                    });

                }
            }
        }
    }

}



