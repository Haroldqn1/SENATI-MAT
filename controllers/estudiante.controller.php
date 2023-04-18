<?php

require_once '../models/Estudiante.php';

if (isset($_POST['operacion'])){

  $estudiante = new Estudiante();

  if ($_POST['operacion'] == 'registrar'){

    //PASO 1: Recolectar todos los valores enviados
    //por la vusta y almacenarlos en un array asociativo
    $datosGuardar = [
      "apellidos"       => $_POST['apellidos'],
      "nombres"         => $_POST['nombres'],
      "tipodocumento"   => $_POST['tipodocumento'],
      "nrodocumento"    => $_POST['nrodocumento'],
      "fechanacimiento" => $_POST['fechanacimiento'],
      "idcarrera"       => $_POST['idcarrera'],
      "idsede"          => $_POST['idsede'],
      "fotografia"      => ''
    ];

    //Vamos a verificar si la visa nos envio una FOTOGRAFIA
    if (isset($_FILES['fotografia'])){

      $rutaDestino = '../views/img/fotografias/';
      $fechaactual = date('c'); //C= complete , AÑO/MES/DIA/HORA/MINUTO/SEGUNDO 
      $nombreArchivo = sha1($fechaactual). ".jpg";
      $rutaDestino .=$nombreArchivo;

      //Guardamos la fotografia en el servidor
      if(move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
        $datosGuardar['fotografia'] = $nombreArchivo;
      }
    }

    //PASO 2: Enviar el array
    $estudiante->registrarEstudiante($datosGuardar);

  }

  if($_POST['operacion'] == 'listar'){
    $data = $estudiante->listarEstudiante();

    if($data){
      $numeroFila = 1;
      $datosEstudiante = '';
      $botonNulo = "<a href='#' class='btn btn-sm btn-warning' title='No tiene fotografía'><i class='bi bi-eye-slash-fill'></i></a>";

      foreach($data as $registro){
        $datosEstudiante = $registro['apellidos']. ' ' . $registro['nombres'];
        


        //La primera parte a renderizar, es lo standar (siempre se muestra)

        echo"
          <tr>
            <td>{$numeroFila}</td>
            <td>{$registro['apellidos']}</td>
            <td>{$registro['nombres']}</td>
            <td>{$registro['tipodocumento']}</td>
            <td>{$registro['nrodocumento']}</td>
            <td>{$registro['fechanacimiento']}</td>
            <td>{$registro['carrera']}</td>
            <td>
              <a href='#' data-idestudiante='{$registro['idestudiante']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash-fill'></i></a>
              <a href='#' data-idestudiante='{$registro['idestudiante']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil'></i></a>";
        //La seunda parte a renderizar es el boton  ver FOTOGRAFIA
        if($registro['fotografia'] == ''){
          echo $botonNulo;
        }else{
          echo " <a href='../views/img/fotografias/{$registro['fotografia']}' data-lightbox='{$registro['idestudiante']}' data-title='{$datosEstudiante}' class='btn btn-sm btn-warning'><i class='bi bi-eye-fill'></i></a>";
        }
        echo "
            </td>
          </tr>
        ";
        $numeroFila++;
      } //FIN DEL FOREACH  
    }
  }
}
