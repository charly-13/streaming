 <!-- Modal -->
 <div class="modal fade" id="modalFormSesion" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog  modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header headerRegister">
                 <h5 class="modal-title" id="titleModal">NUEVA SESIÓN</h5>
                 <span type="button" class=" btn bg-gradient-danger" data-bs-dismiss="modal" aria-label="Close">
                     X
                 </span>
             </div>
             <div class="modal-body">

                 <form id="formSesion" name="formSesion">
                     <input type="hidden" id="idSesion" name="idSesion" value="">

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Tema de la sesión <span class="required">*</span></label>
                              <input class="form-control" id="txtTema" name="txtTema" type="text" placeholder="Ej. Cadera dolorosa después de una ATC primaria" required="">
                          </div>

                          <div class="form-group">
                              <label class="control-label">Descripción</label>

                              <textarea id="txtDescripcion" name="txtDescripcion" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                              <label class="control-label">URL Streaming</label>
                              <input class="form-control" id="txtUrlStreaming" name="txtUrlStreaming" type="text" placeholder="Ej. https://vimeo.com/event/947367/embed" required="">
                          </div>


                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleSelect1">Fecha <span class="required">*</span></label>
                                    <input class="form-control" id="txtFecha" name="txtFecha" type="date" placeholder="Nombre Categoría" required="" value="2022-11-23">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleSelect1">Hora <span class="required">*</span></label>
                                    <input class="form-control" id="txtHora" name="txtHora" type="time" placeholder="Nombre Categoría" required="" value="20:00:00">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="photo">
                            <label for="foto">Programa = Foto (570x380)</label>
                            <div class="prevPhoto">
                              <span class="delPhoto notBlock">X</span>
                              <label for="foto"></label>
                              <div>
                                <img id="img" src="<?= media(); ?>/img/programas/portada_programa.png">
                            </div>
                        </div>
                        <div class="upimg">
                          <input type="file" name="foto" id="foto">
                      </div>
                      <div id="form_alert"></div>
                  </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary" id="btnActionForm"  ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>
</div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalViewSesion" tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog  modal-lg" role="document">
     <div class="modal-content">
         <div class="modal-header headerRegister">
             <h5 class="modal-title" id="titleModal">Informacion de la Sesión</h5>
             <span type="button" class=" btn bg-gradient-danger" data-bs-dismiss="modal" aria-label="Close">
                 X
             </span>
         </div>
         <div class="modal-body">

             <form id="formSesion" name="formSesion">
                 <input type="hidden" id="idSesion" name="idSesion" value="">

                 <div class="card">
            <div class="card-header pb-0">
              <h6 id="sesionTema">Fracturas periprotesicas de fémur en el paciente senil</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Clave de sesión:</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">CLAV-1000-<span id="sesionId"></span></p>                  
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-html5 text-danger text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Descripción :</h6>                   
                    <p class="text-sm mt-3 mb-2" id="sesionDescripcion">
                      People care about how you see the world, how you think.
                    </p>
        
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-cart text-info text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Fecha :</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">lunes, 07 de noviembre del 2022,20:00:00hrs</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-credit-card text-warning text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">Programa:</h6>
                    <span id="imgPrograma"></span>
          <!--          <img src="<?= media(); ?>/img/programa_portada.jpg" class="w-25"><br> -->
                
                    <span class="badge badge-sm bg-gradient-warning">Explorar</span>
                
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="ni ni-key-25 text-primary text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">No de Asistentes :</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">103</p>
    
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="ni ni-archive-2 text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">url del registro:</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0" id="sesionurlregistro">https://www.google.com/</p>

                    <span class="badge badge-sm bg-gradient-success">Visitar registro</span>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="ni ni-check-bold text-info text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">url del streaming:</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0" id="sesionurlstreaming">https://vimeo.com/event/2403716/embed</p>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step">
                    <i class="ni ni-box-2 text-warning text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">urls Preguntas Ponentes</h6>                

                    <span class="badge badge-sm bg-gradient-info">Preguntas Ponente</span>
                    <span class="badge badge-sm bg-gradient-danger">Preguntas Ponente Borrar</span>
                  </div>
                </div>

              </div>
            </div>
          </div>



                 <div class="modal-footer">
                   <!--  <button type="submit" class="btn bg-gradient-primary" id="btnActionForm"  ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button> -->
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>