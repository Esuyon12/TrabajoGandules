<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
  redirect(web_root . "admin/index.php");
}
if (!$_SESSION['ADMIN_ROLE'] == 'Administrator') {
  redirect(web_root . "admin/index.php");
}
@$USERID = $_SESSION['ADMIN_USERID'];
if ($USERID == '') {
  redirect("index.php");
}
$user = new User();
$singleuser = $user->single_user($USERID);


?>

<section class="section">
  <div class="section-body">
    <div class="row mt-sm-4">
      <div class="col-12 col-md-12 col-lg-4">

        <div class="card author-box">
          <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
            <div class="author-box-center" style="text-align: center;">
              <input type="hidden" id="foto_actual">
              <span id="icon-cerrar"></span>
              <a data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image.">
                <img alt="" style="width:150px; height:85px;" title="" class="img-circle img-thumbnail isTooltip" src="<?php echo web_root . 'admin/user/' . $singleuser->PICLOCATION; ?>" data-original-title="Usuario">
              </a>
              <div class="clearfix"></div>
              </br>

              <div class="author-box-name">
                <h4 style="color: green;"><?php echo strtoupper($singleuser->ROLE); ?></h4>
              </div>

              <div class="author-box-job">
                <p><?php echo $singleuser->CORREO; ?></p>
              </div>
            </div>
          </div>
        </div>




        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;; ">
          <div class="card-header">
            <h4>Cambiar Contraseña</h4>
          </div>

          <div class="card-body">
            <form id="frmCambiarPass" action="controller.php?action=edit&view=" method="POST" onsubmit="frmCambiarPass(event);">
              <div class="form-floating mb-4">
                <input type="password" name="U_PASS" id="U_PASS" class="form-control" placeholder="..." required="">
                <label for="U_PASS"><i class="fas fa-list"></i> Contraseña Actual <span class="text-danger"> * </span> </label>
              </div>
              <div class="form-floating mb-4">
                <input type="password" name="clave_nueva" id="clave_nueva" class="form-control" placeholder="..." required="">
                <label for="clave_nueva"><i class="fas fa-list"></i> Contraseña Nueva <span class="text-danger"> * </span> </label>
              </div>
              <div class="form-floating mb-4">
                <input type="password" name="confirmar_clave" id="confirmar_clave" class="form-control" placeholder="..." required="">
                <label for="confirmar_clave"><i class="fas fa-list"></i> Confirmar Contraseña <span class="text-danger"> * </span> </label>
              </div>

              <div class="d-grid gap-2 mt-3">
                <button class="btn btn-outline-success" type="submit">Modificar</button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-12 col-lg-8">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;;">
          <div class=" padding-20">
            <form action="controller.php?action=edit&view=" method="POST">
              <div class="card-header">
                <h4>Editar perfil</h4>
              </div>
              <div class="card-body">
                <div class="form-floating mb-4">
                  <input type="text" name="U_NAME" id="U_NAME" class="form-control" value="<?php echo $singleuser->FULLNAME; ?>">
                  <label for="U_NAME"> Nombre completo</label>
                </div>

                <div class="form-floating mb-4">
                  <input type="text" name="USERNAME" id="USERNAME" class="form-control" value="<?php echo $singleuser->USERNAME; ?>">
                  <label for="USERNAME"> Nombre de usuario</label>
                </div>

                <div class="form-floating mb-4">
                  <input type="email" name="U_CORREO" id="U_CORREO" class="form-control" value="<?php echo $singleuser->CORREO; ?>">
                  <label for="U_CORREO">Correo electronico</label>
                </div>

                <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mb-4">
                      <input type="number" name="U_DNI" id="U_DNI" class="form-control" value="<?php echo $singleuser->DNI; ?>">
                      <label for="U_DNI">Dni</label>
                    </div>
                  </div>

                  <div class="col-md">
                    <div class="form-floating mb-4">
                      <input type="number" name="U_TELEFONO" id="U_TELEFONO" class="form-control" value="<?php echo $singleuser->TELEFONO; ?>">
                      <label for="U_TELEFONO"> Telefono</label>
                    </div>
                  </div>
                </div>

                <div class="form-floating mb-5">
                  <select class="form-control input-sm" name="U_ROLE" id="U_ROLE">
                    <option value="Administrator" <?php echo ($singleuser->ROLE == 'Administrator') ? 'selected="true"' : ''; ?>>Administrator</option>
                    <option value="Recursos humanos" <?php echo ($singleuser->ROLE == 'Recursos humanos') ? 'selected="true"' : ''; ?>>usuario</option>
                  </select>
                  <label for="U_ROLE"><i class="bi bi-people-fill"></i> Rol *</label>
                </div>

                <div class="form-group mb-0 col-12">
                  <label for="imagen" class="btn btn-outline-success" id="icon-image">
                    <i class="bi bi-camera"></i> <input id="imagen" class="d-none" type="file" onchange="preview(event)" name="imagen">
                    <input type="hidden" name="foto_actual" value="avatar.svg">
                  </label>
                  <span id="icon-cerrar"></span>
                </div>

              </div>

              <div class="card-footer text-end">
                <button class="btn btn-success" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Guardar Cambios </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script>
  function frmCambiarPass(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    // Validar los campos del formulario
    var passActual = document.getElementById('U_PASS').value;
    var nuevaPass = document.getElementById('clave_nueva').value;
    var confirmarPass = document.getElementById('confirmar_clave').value;

    if (passActual == '' || nuevaPass == '' || confirmarPass == '') {
      alert('Por favor, complete todos los campos');
      return false;
    }

    if (nuevaPass != confirmarPass) {
      alert('Las contraseñas no coinciden');
      return false;
    }

    // Enviar los datos del formulario a través de AJAX
    var formData = new FormData(document.getElementById('frmCambiarPass'));

    $.ajax({
      url: 'controller.php?action=edit&view=',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        alert(response);
      },
      error: function(xhr, status, error) {
        alert('Ha ocurrido un error al intentar cambiar la contraseña');
      }
    });
  }
</script>