<?php
//Esta clase, le permitira a los modelos acceder y consumir los datos
class Conexion{
  
  //Atributos 
  private $host     = "localhost";  // EL SERVIDO 
  private $port     = "3306";       // Puerto de comunicaciona a la base de datos
  private $database = "senatimat";     //Nombre De la base de datos
  private $charset  = "UTF8";       //Codificacion(idioma)
  private $user     = "root";       //Usuario(raiz)
  private $password = "";           //Contraseña

  //Atributo (instacia PDO) que almacena la conexion
  private $pdo;

  //Metodo 1: Aceder a la BD
  private function conectarServidor(){
    //Constructor:
    //new PDO("CADENA_CONEXION","USER","PASSWORD")
    //OBJETO            SOBRECARGAS
    $conexion = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}",
                                    $this->user,$this->password);
    return $conexion;
  }

  //Metodo 2: Retorna el acceso
  public function getConexion(){
    try{
      //Pasaremos la conexion al atributo/objeto pdo
      $this->pdo = $this->conectarServidor();

      //Controlar los errores
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Retornamos la conexion al modelo que lo necesite
      return $this->pdo;
    }
    catch(Exception $e){
      die($e->getMessage());
    }

  }
}