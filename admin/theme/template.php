<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/main/app.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/main/style.css" />

  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/main/app-dark.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/pages/datatables.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/pages/dripicons.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/pages/fontawesome.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/widgets/todo.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/pages/simple-datatables.css" />
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/pages/form-element-select.css" />

  <!-- Summer note de editor de tipo de contrato -->
  <link rel="stylesheet" href="<?= web_root ?>admin/assets/extensions/summernote/summernote.css" />

  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= web_root ?>admin/assets/css/shared/iconly.css">

  <link rel="icon" type="image/png" href="../assets/images/logo/logo-gandules.png" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.6.172/web/pdf_viewer.min.css">
  <script src="<?php echo web_root ?>admin/assets/js/pdfjs/build/pdf.js"></script>

  <script src="<?= web_root; ?>admin/assets/js/bootstrap.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

</head>

<body>

  <?php require "modal.php" ?>
  <?php require "offcanvas.php" ?>

  <div id="app">
    <?php require "nav.php" ?>
    <div id="main" class="layout-navbar">
      <header class="mb-3">
        <nav class="navbar navbar-expand navbar-light navbar-top">
          <div class="container-fluid white">
            <a href="#" class="burger-btn d-block">
              <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="sidebar-header position-relative"> -->

            <!-- </div> -->


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class=" ms-auto mb-lg-0">
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                  <div class="user-menu d-flex">
                    <div class="user-name text-end me-3">
                      <h6 class="mb-0 text-gray-600"><b><?= $_SESSION['ADMIN_USERNAME'] ?></b></h6>
                      <p class="mb-0 text-sm text-gray-600"><?= $_SESSION['ADMIN_ROLE'] ?></p>
                    </div>
                    <div class="user-img d-flex align-items-center">
                      <div class="avatar avatar-md">
                        <img src="<?= web_root ?>admin/user/photos/<?php echo $_SESSION['ADMIN_FOTO'] ?>" />
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </nav>
      </header>


      <div id="main-content">
        <?php require $content ?>



        <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2023 &copy; Gandules</p>
            </div>
            <div class="float-end">

            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>



  <!-- Dependencia de jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Archivos CSS y JavaScript de Summernote -->
  <script src="<?php echo web_root; ?>admin/assets/extensions/summernote/summernote.js"></script>

  <!-- Otros scripts -->
  <script src="<?= web_root; ?>admin/assets/js/app.js"></script>
  <!-- <script src="<?php echo web_root; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
  <script src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
  <script src="<?php echo web_root; ?>plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="<?php echo web_root; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        "dom": '<"top"i>rt<"bottom"lp><"clear">B',


        "fnInitComplete": function(oSettings, json) {
          // creando el campo de búsqueda personalizado
          var searchInput = '<div class="form-floating mb-3"><input type="text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí..."><label for="tableSearch">Buscar registros</label></div>';

          // agregando el campo de búsqueda personalizado al DOM
          $(searchInput).appendTo($(".dataTables_filter"));

          // agregando evento de búsqueda
          $('#tableSearch').keyup(function() {
            $('#myTable').DataTable().search($(this).val()).draw();
          });
        },
        "language": {
          "searchPlaceholder": "Buscar",
          "search": "",
          "sEmptyTable": "No se encontraron datos",
          "sInfo": "Mostrando _START_ al _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 al 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
          "sInfoPostFix": "",
          "sInfoThousands": ",",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sLoadingRecords": "Cargando...",
          "sProcessing": "Procesando...",
          "sSearch": "Buscar:",
          "sZeroRecords": "No se encontraron registros coincidentes",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    });

    $('input[data-mask]').each(function() {
      var input = $(this);
      input.setMask(input.data('mask'));
    });


    $('#BIRTHDATE').inputmask({
      mask: "2/1/y",
      placeholder: "mm/dd/yyyy",
      alias: "date",
      hourFormat: "24"
    });
    $('#HIREDDATE').inputmask({
      mask: "2/1/y",
      placeholder: "mm/dd/yyyy",
      alias: "date",
      hourFormat: "24"
    });

    $('.date_picker').datetimepicker({
      format: 'mm/dd/yyyy',
      startDate: '01/01/1950',
      language: 'en',
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0
    });
  </script>
</body>

</html>