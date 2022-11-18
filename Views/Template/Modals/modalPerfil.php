 <!-- Modal -->
 <div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">ACTUALIZAR DATOS</h5>
                 <span type="button" class=" btn bg-gradient-danger" data-bs-dismiss="modal" aria-label="Close">
                     X
                 </span>
             </div>
             <div class="modal-body">
                 <form id="formPerfil" name="formPerfil">
                 <input type="hidden" id="idUsuario" name="idUsuario" value="">
                     <div class="form-group row">
                         <div class="col-12 col-lg-6">
                             <label class="form-label">Nombre(s)</label>
                             <div class="input-group">
                                 <input type="text" id="txtNombre" name="txtNombre" value="<?= $_SESSION['userData']['nombres'] ?>" class="form-control valid validText" placeholder="Ej. Marco Antonio" required="">
                             </div>
                         </div>

                         <div class="col-12 col-lg-6">
                             <label class="form-label">Apellidos</label>
                             <div class="input-group">
                                 <input type="text" id="txtApellido" name="txtApellido" class="form-control valid validText" placeholder="Ej. Bobadilla Cruz" required="">
                             </div>
                         </div>

                         <div class="col-12 col-lg-6">
                             <label class="form-label">Teléfono</label>
                             <div class="input-group">
                                 <input type="text" id="txtTelefono" name="txtTelefono"  class="form-control valid validNumber" placeholder="40-(770)-888-444" required="" onkeypress="return controlTag(event);">
                             </div>
                         </div>

                         <div class="col-12 col-lg-6">
                             <label class="form-label">Email</label>
                             <div class="input-group">
                                 <input type="email" id="txtEmail" name="txtEmail"  class="form-control valid validEmail" disabled  readonly placeholder="name@example.com" required="">
                             </div>
                         </div>

                         <div class="col-12 col-lg-6">
                             <label class="form-label">Tipo usuario </label>
                             <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                                                   
                             </select>
                         </div>
                         <div class="col-12 col-lg-6">
                             <label for="exampleFormControlSelect1">Status</label>
                             <select class="form-control" id="listStatus" name="listStatus"  required>
                                 <option value="1">Activo</option>
                                 <option value="2">Inactivo</option>                          
                             </select>
                         </div>


                         <div class="col-12 col-lg-12">
                             <label class="form-label">Password</label>
                             <div class="form-group">
                                 <input type="password" id="txtPassword" name="txtPassword"  class="form-control" placeholder="***********">
                             </div>
                         </div>

                         <div class="col-12 col-lg-12">
                             <label class="form-label">Confirmar Password</label>
                             <div class="form-group">
                                 <input type="password" id="txtPasswordConfirm" name="txtPasswordConfirm"  class="form-control" placeholder="***********">
                             </div>
                         </div>
                      

                        
                         <div class="modal-footer">
                             <button type="submit" class="btn bg-gradient-primary" id="btnActionForm"  ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"></span></button>
                             <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                         </div>
                     </div>
                 </form>


             </div>

         </div>
     </div>
 </div>

