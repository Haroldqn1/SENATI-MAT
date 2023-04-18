<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!--ICONOS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <!--Lighbox CSS-->
  <!--<link rel="stylesheet" href="../dist/lightbox2/src/css/lightbox.css">-->



</head>

<body>
  <!-- Modal trigger button -->
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-colaborador">Ver Colaborador</button>

  <div class="container">
    <table id="tabla-colaboradores" class="table table striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Cargo Ocupado</th>
          <th>Sede</th>
          <th>Contrato</th>
          <th>Telefono</th>
          <th>Direccion</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  
  <!-- Modal Body -->
  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
  <div class="modal fade" id="modal-colaborador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro Del Colaborador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="formulario-colaborador" enctype="multipart/form-data">
            <!------------------------------------------------------------->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <!------------------------------------------------------------->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label">Elija el Cargo:</label>
                <select id="cargo" class="form-select form-select-sm">
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Elija la Sede:</label>
                <select id="sede" class="form-select form-select-sm">
                </select>
              </div>
            </div>
            <!------------------------------------------------------------->
            <div class="row">
            <div class="mb-3 col-md-3">
                <label for="tipocontrato" class="form-label">Tipo de Contrato</label>
                <select name="tipocontrato" id="tipocontrato" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="P">Parcial</option>
                  <option value="C">Completo</option>
                </select>
              </div>
              <div class="mb-3 col-md-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono">
              </div>
              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>
            </div>
            <!------------------------------------------------------------->
            <div class="row">
              <div class="mb-3">
                <label for="cv" class="form-label">Curriculum Vidae:</label>
                <input type="file" class="form-control form-control-sm" id="cv" accept=".pdf" />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="guardar-colaborador" >Guardar</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- Optional: Place to the bottom of scripts -->
  <script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
  
  </script>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!--SweetAlert2-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!--LightBox JS-->
  <!--<script src="../dist/lightbox2/src/js/lightbox.js"></script>-->

  <script>
    $(document).ready(function(){

      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data:{operacion: 'listar'},
          dataType:'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }

      function obtenerCargo(){
        $.ajax({
          url: '../controllers/cargo.controller.php',
          type: 'POST',
          data:{operacion: 'listar'},
          dataType:'text',
          success: function(result){
            $("#cargo").html(result);
          }
        });
      }

      function mostrarColaboradores(){
        $.ajax({
          url:'../controllers/colaboradores.controller.php',
          type:'POST',
          data:{operacion : 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaboradores tbody").html(result);
          }
        });
      }

      
      function registrarColaborador(){

        //Enviamos datos dentro de un objeto
        var formData = new FormData();

        formData.append("operacion"     ,"registrar");
        formData.append("apellidos"     , $("#apellidos").val());
        formData.append("nombres"       , $("#nombres").val());
        formData.append("cargo"         , $("#cargo").val());
        formData.append("sede"          , $("#sede").val());
        formData.append("tipocontrato"  , $("#tipocontrato").val());
        formData.append("telefono"      , $("#telefono").val());
        formData.append("direccion"     , $("#direccion").val());
        formData.append("cv"            , $("#cv")[0].files[0]);

        $.ajax({
          url: '../controllers/colaboradores.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData:false,
          cache:false,
          success: function(){
            $("#formulario-colaborador")[0].reset();
            $("#modal-colaborador").modal("hide");
            alert("Guardado correctamente");
            mostrarColaboradores();
          }
        });
      }

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Registro',
          text:'¿Seguro de registrar al Colaborador?',
          footer: 'Desarrolado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#2874A6',
          showCancelButton:true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando la accion del usuario
          if(result.isConfirmed){
            registrarColaborador();
          }
        });
      }

      function eliminarColaborador(){
        console.log("Eliminando..."); 
      }
      //---------------------------------
      $("#tabla-colaboradores tbody").on("click",".eliminar",function(){
        const idcolaboradorEliminar = $(this).data("idcolaborador");
        if(confirm("¿Estas Seguro de proceder?")){
          $.ajax({
            url:'../controllers/colaboradores.controller.php',
            type:'POST',
            data:{
              operacion : 'eliminar',
              idcolaborador : idcolaboradorEliminar
            },
            success: function(result){
              if(result == ""){
                mostrarColaboradores();
              }
            }
          })
        }
      });

      //Evento-------------------------
      $("#guardar-colaborador").click(preguntarRegistro);



      $("#modal-colaborador").on("shown.bs.modal",event =>{
        $("#apellidos").focus();

        obtenerCargo();
        obtenerSedes();
      });

      mostrarColaboradores();
    });
  </script>

</body>

</html>