<?php

require_once '../models/Cargo.php';

if (isset($_POST['operacion'])){
  $cargo = new Cargo();

  //Decimos la operacion que queremos 
  if ($_POST['operacion'] == 'listar'){
    $data = $cargo->listarCargos();

    //Enviar los datos a la vista
    //Si contiene informacion, si no esta vacio...
    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idcargo']}'>{$registro['cargo']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos datos</option>";
    }
  }
}