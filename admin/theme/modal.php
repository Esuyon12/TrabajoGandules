<!-- Modal -->
<div class="modal fade text-left modal-borderless" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" id="MHead">
                <h5 class="card-title" id="headTitle"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body" id="content">

            </div>
            <div class="modal-footer" id="footer">
                <button type="button" class="btn btn-success ml-1">
                    <span class="d-none d-sm-block">Aceptar</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast <?php echo !empty($messageVac) ? "show" : "" ?>" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <!-- <img src="..." class="rounded me-2" alt="..."> -->
      <strong class="me-auto">Notificacion</strong>
      <!-- <small>11 mins ago</small> -->
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <?php echo $messageVac ?>
    </div>
  </div>
</div> 