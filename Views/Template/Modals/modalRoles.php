 <!-- Modal -->
 <div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">NUEVO ROL</h5>
                 <span type="button" class=" btn bg-gradient-danger" data-bs-dismiss="modal" aria-label="Close">
                     X
                 </span>
             </div>
             <div class="modal-body">
                 <form id="formRol" name="formRol">
                     <input type="hidden" id="idRol" name="idRol" value="">
                     <div class="form-group">
                         <label for="txtNombre" class="col-form-label">Nombre:</label>
                         <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del rol" required="">
                     </div>
                     <div class="form-group">
                         <label for="txtDescripcion" class="col-form-label">Descripción:</label>
                         <textarea class="form-control" rows="2" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción del rol" required=""></textarea>
                     </div>
                     <div class="form-group">
                         <label for="listStatus">Estado</label>
                         <select class="form-control" id="listStatus" name="listStatus" required="">
                             <option value="1">Activo</option>
                             <option value="0">Inactivo</option>
                         </select>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                         <button type="submit" class="btn bg-gradient-primary" id="btnActionForm"><span id="btnText">Guardar</span></button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>