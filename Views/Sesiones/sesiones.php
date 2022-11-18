<?php
headerAdmin($data);
getModal('modalSesiones', $data);
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0"><?= $data['page_tag'] ?></h5>
                            <!-- <p class="text-sm mb-0">
                    A lightweight, extendable, dependency-free javascript HTML table plugin.
                </p> -->
            </div> 
            <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                    <?php if($_SESSION['permisosMod']['w']){ ?>
                        <button type="button" class="btn bg-gradient-primary btn-sm mb-0" onclick="openModal();">+&nbsp;Nuevo</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pb-0 ">
        <div class="table-responsive">
            <table class="table align-items-center mb-0 table table-striped table-bordered" id="tableSesiones">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tema de la sesión</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha y Hora</th>                
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acceso Activo</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sesión Actual</th>                            
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>

                    </tr>
                </thead>
                <tbody>
    <!--                 <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">#</p>
                        </td>
                        <td>
                            <p class="text-xs text-secondary mb-0">Fracturas periprotesicas de fémur en el paciente senil</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Manager</p>
                            <p class="text-xs text-secondary mb-0">lunes, 07 de noviembre del 2022,20:00:00hrs  </p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0"> Acceso Activado</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Sesión Desactivada</p>
                        </td>

                        <td class="text-sm">
                            <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                              <i class="fas fa-eye text-secondary fa-2x text-red" aria-hidden="true" style="color:green !important"></i>
                          </a>
                          <a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                              <i class="fas fa-user-edit text-secondary fa-2x" aria-hidden="true" style="color:orange !important"></i>
                          </a>
                          <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                              <i class="fas fa-trash text-secondary fa-2x" aria-hidden="true" style="color:red !important"></i>
                          </a>
                      </td>
                  </tr> -->
              </tbody>
          </table>
      </div>
  </div>
</div>
</div>
</div>


</div>


<?php footerAdmin($data); ?>