var tableRoles;
document.addEventListener('DOMContentLoaded', function(){

	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true, 
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Roles/getRoles",
            "dataSrc":""
        },
        "columns":[
        {"data":"idrol",className: "text-sm"},
        {"data":"nombrerol",className: "text-sm"},
        {"data":"descripcion",className: "text-sm"},
        {"data":"status",className: "text-sm"},
        {"data":"options",className: "text-sm"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


        //NUEVO ROL
        var formRol = document.querySelector("#formRol");
        formRol.onsubmit = function(e) {
            e.preventDefault();
            
            // var intIdRol = document.querySelector('#idRol').value;
            var strNombre = document.querySelector('#txtNombre').value;
            var strDescripcion = document.querySelector('#txtDescripcion').value;
            var intStatus = document.querySelector('#listStatus').value;        
            if(strNombre == '' || strDescripcion == '' || intStatus == '')
            {
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            //Detectamos si estamos en un navegador Crome o filefox si es así creamos un nuebvo elemento de XMLHttpRequest de lo contrarrio
            // agregamos un elemento ActiveXObject
            //OBTENEMOS CADA UNO DE LOS OBJETOS DE ACUERDO AL NAVEGADOR
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Roles/setRol';
            var formData = new FormData(formRol);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){

                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormRol').modal('hide');                        
                        document.getElementById('formRol').reset();
                        swal.fire("Roles de usuario",objData.msg,"success");
                        //Actualizamos la tabla
                        tableRoles.api().ajax.reload();
                        fntEditRol(); 

                    }else{
                        swal.fire("Error",objData.msg,'error');
                    }

                }
                
            }  
            
        }

    })

$('#tableRoles').DataTable();
function openModal(){
    document.querySelector('#idRol').value ="";   
    document.querySelector('#btnActionForm').classList.replace("bg-gradient-info", "bg-gradient-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();
    $('#modalFormRol').modal('show');
}


window.addEventListener('load', function() {
    fntEditRol();
    fntDelRol();
    fntPermisos();
}, false);

function fntEditRol(idRol) {
    document.querySelector('#titleModal').innerHTML = ('Actualizar Rol');
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("bg-gradient-primary", "bg-gradient-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idrol = idrol;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Roles/getRol/' + idRol;
    request.open('GET', ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idRol").value = objData.data.idrol;
                document.querySelector("#txtNombre").value = objData.data.nombrerol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;



                if (objData.data.status == 1) {
                    var optionSelect = '<option value="1" selected >Activo</option>';
                } else {
                    var optionSelect = '<option value="2" selected >Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
                `;
                document.querySelector("#listStatus").innerHTML = htmlSelect;
                $('#modalFormRol').modal('show');
            } else {
                swal.fire("Error", objData.msg, "error");
            }

        }
    }


    $('#modalFormRol').modal('show');
}
// FUNCIÓN PARA ELIMINAR ROL
function fntDelRol(idrol){
    var idrol = idrol;
    swal.fire({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el Rol?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
    }).then((result) => {
        if (result.isConfirmed) {

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Roles/delRol/';
            var strData = "idrol="+idrol;
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
                        tableRoles.api().ajax.reload(function(){
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

function fntPermisos(idrol){
    var idrol = idrol;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.modalPermisos').modal('show');
            document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
        }
    }
}

function fntSavePermisos (evnet){
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl=base_url+'/Permisos/setPermisos';
    var formElement=document.querySelector("#formPermisos");
    var formData= new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange=function(){
        if(request.readyState==4 && request.status==200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
                swal.fire("Permisos de usuario",objData.msg,'success');
                tableRoles.api().ajax.reload(function(){
                    $('.modalPermisos').modal('hide');
                    // fntEditRol();
                    // fntDelRol();
                    //  fntPermisos();
                });
            }else{
                swal.fire("Error",objData.msg,'error');
            }

        }
    }
}