<?php

require_once 'Conexion.php';

class Colaboradores extends Conexion{
    private $accesoBD;

    public function __CONSTRUCT(){
        $this->accesoBD = parent::getConexion();
    }

    public function registrarColaborador($datos = []){
        try{
            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['apellidos'],
                    $datos['nombres'],
                    $datos['cargo'],
                    $datos['sede'],
                    $datos['tipocontrato'],
                    $datos['telefono'],
                    $datos['direccion'],
                    $datos['cv']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function listarColaboradores(){
        try{
            $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);      
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
