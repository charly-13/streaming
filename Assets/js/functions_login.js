
function formReset(){
  elemento = document.getElementById("formIngreso");
  elemento.style.display = "none";

  elemento = document.getElementById("formReset");
  elemento.style.display = "block";
}

document.addEventListener('DOMContentLoaded', function(){
   if(document.querySelector("#formLogin")){
      let formLogin = document.querySelector("#formLogin");
      formLogin.onsubmit=function(e){
        e.preventDefault();
        let strEmail = document.querySelector("#txtEmail").value;
        let strPassword = document.querySelector("#txtPassword").value;
        if(strEmail == "" || strPassword == ""){
            swal.fire("Por favor", "Escriba usuario y contraseña","error");
            return false;
        }else{
          var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          var ajaxUrl = base_url+'/Login/loginUser';
            var formData = new FormData(formLogin);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
              if(request.readyState != 4) return;
              if(request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                  window.location = base_url+'/dashboard';
                  //window.location.reload(false);
                }else{
                  swal.fire("Atención", objData.msg, "error");
                  document.querySelector('#txtPassword').value = "";
                }
              }else{
                swal.fire("Atención","Error en el proceso", "error");
              }
              // divLoading.style.display = "none";
              return false;
            }
        }

      }
   }



   if(document.querySelector("#formRecetPass")){
    let formRecetPass = document.querySelector("#formRecetPass");
    formRecetPass.onsubmit=function(e){
      e.preventDefault();
      let strEmail = document.querySelector("#txtEmailReset").value;
      if(strEmail==""){
            swal.fire("Por favor","Escribe tu correo electrónico","error");
            return false;
          //alert("error");
      }else{

        // divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? 
								new XMLHttpRequest() : 
								new ActiveXObject('Microsoft.XMLHTTP');
								
				var ajaxUrl = base_url+'/Login/resetPass'; 
				var formData = new FormData(formRecetPass);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;

					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							swal.fire({
								title: "",
								text: objData.msg,
								type: "success",
								confirmButtonText: "Aceptar",
								closeOnConfirm: false,
              }).then((result) => {
                if (result.isConfirmed) {
									window.location = base_url;                
								}
							});
						}else{
							swal.fire("Atención", objData.msg, "error");
						}
					}else{
						swal.fire("Atención","Error en el proceso", "error");
					}
					// divLoading.style.display = "none";
					return false;
				}	

      }
    }
   }

   if(document.querySelector("#formCambiarPass")){
    let formCambiarPass = document.querySelector("#formCambiarPass");
    formCambiarPass.onsubmit=function(e){
      e.preventDefault();
      let strPassword= document.querySelector("#txtPassword").value;
      let strPasswordConfirm = document.querySelector("#txtPasswordConfirm").value;
      let idUsuario = document.querySelector("#idUsuario").value;

      if (strPassword == "" || strPasswordConfirm == "") {
        swal.fire("Por favor", "Escribe la nueva contraseña", "error");
        return false;
      } else {
        if (strPassword.length < 8) {
          swal.fire("Atención", "La contraseña debe tener un mínimo 8 caracteres.", "info");
          return false;
        }
        if(strPassword != strPasswordConfirm){
         swal.fire("Atención","Las contraseñas no son iguales","error");
         return false;
        }
        var request = (window.XMLHttpRequest)? new XMLHttpRequest(): ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Login/setPassword';
        var formData = new FormData(formCambiarPass);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange=function(){
          if(request.readyState!=4) return;
          if(request.status==200){
            // console.log(request.responseText);
            var objData= JSON.parse(request.responseText);
            if(objData.status){
              swal.fire({
								title: "",
								text: objData.msg,
								type: "success",
								confirmButtonText: "Aceptar",
								closeOnConfirm: false,
              }).then((result) => {
                if (result.isConfirmed) {
									// window.location = base_url;
                  window.location = base_url+'/login';
								}
							});
            }else{
              swal.fire("Atención", objData.msg, "error");
            }
          }else{
            return false; 
          }
        }


      }
    }
   }



},false)
