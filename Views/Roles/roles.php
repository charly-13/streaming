<?php  
headerAdmin($data); 
getModal('modalRoles',$data);
?>
 <div id="contentAjax"></div>
<div class="container-fluid py-4" >
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
            <div class="card-body px-0 pb-0 "  >
              <div class="table-responsive" >
              <table class="table align-items-center mb-0 table table-striped table-bordered" id="tableRoles">
                  <thead class="thead-light">
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
         
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


      <?php  footerAdmin($data); ?>
    