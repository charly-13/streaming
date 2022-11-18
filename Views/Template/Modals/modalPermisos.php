<div class="modal fade bd-example-modal-lg modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">PERMISOS ROLES REPORTERIA</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        //dep($data);
        ?>
        <div class="col-md-12">
          <div class="tile">
            <form action="" id="formPermisos" name="formPermisos">
              <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Módulo</th>
                      <th>Ver</th>
                      <th>Crear</th>
                      <th>Actualizar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $modulos = $data['modulos'];
                    for ($i = 0; $i < count($modulos); $i++) {

                      $permisos = $modulos[$i]['permisos'];
                      $rCheck = $permisos['r'] == 1 ? " checked " : "";
                      $wCheck = $permisos['w'] == 1 ? " checked " : "";
                      $uCheck = $permisos['u'] == 1 ? " checked " : "";
                      $dCheck = $permisos['d'] == 1 ? " checked " : "";

                      $idmod = $modulos[$i]['idmodulo'];
                    ?>
                      <tr>
                        <td>
                          <?= $no; ?>
                          <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                        </td>
                        <td>
                          <?= $modulos[$i]['titulo']; ?>
                        </td>
                        <td>


                          <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                            <input class="form-check-input" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> type="checkbox" id="flexSwitchCheckDefault11">
                          </div>
                          <div class="toggle-flip">
                        </td>
                        <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                            <input class="form-check-input" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> type="checkbox" id="flexSwitchCheckDefault11">
                          </div>
                        </td>
                        <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                            <input class="form-check-input" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> type="checkbox" id="flexSwitchCheckDefault11">
                          </div>
                        </td>
                        <td>
                        <div class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                            <input class="form-check-input" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> type="checkbox" id="flexSwitchCheckDefault11">
                          </div>
                        </td>
                      </tr>
                    <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-success"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i>Guardar</button>
                <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">SALIR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>