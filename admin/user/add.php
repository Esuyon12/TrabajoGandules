                      <?php
                      require_once("../../include/initialize.php");

                      if (!isset($_SESSION['ADMIN_USERID'])) {
                        redirect(web_root . "admin/index.php");
                      }


                      ?>

                      <div class="col-lg-12">
                        <h1 class="page-header">AGREGAR NUEVO USUARIO</h1>
                      </div>
                      <!-- /.col-lg-12 -->

                      <form action="controller.php?action=add" method="POST">


                        <div class="form-floating mb-3">
                          <input type="text" name="U_NAME" id="U_NAME" class="form-control" placeholder="..." required>
                          <label for="U_NAME">Nombre</label>
                        </div>

                        <div class="form-floating mb-3">
                          <input type="text" name="U_USERNAME" id="U_USERNAME" class="form-control" placeholder="..." required>
                          <label for="U_USERNAME">Nombre de usuario</label>
                        </div>

                        <div class="form-floating mb-3">
                          <input type="password" name="U_PASS" id="U_PASS" min="3" class="form-control" placeholder="..." required>
                          <label for="U_PASS">Contraseña</label>
                        </div>

                        <div class="form-floating mb-3">
                          <select class="form-select" name="U_ROLE" id="U_ROLE">
                            <option selected disabled></option>
                            <option value="Administrator">Administrator</option>
                            <option value="Usuario">Usuario</option>
                          </select>
                          <label for="U_ROLE">Rol</label>
                        </div>
                      </form>