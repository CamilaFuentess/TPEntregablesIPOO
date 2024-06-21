<?php 

class Pasajero {

    //ATRIBUTOS 
    private $nombre; 
    private $apellido; 
    private $numeroDocumento; 
    private $telefono;

    //CONSTRUCTOR 
    public function __construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel )
    {
        $this-> nombre = $nombre_Pasajero ; 
        $this-> apellido = $apellido_Pasajero ; 
        $this-> numeroDocumento = $dni; 
        $this-> telefono = $numero_tel  ; 
    }

    //GET 
    public function getNombre(){
        return $this-> nombre ; 
    }
    public function getApellido(){
        return $this->  apellido; 
    }
    public function getNumeroDocumento(){
        return $this-> numeroDocumento; 
    }
    public function getTelefono(){
        return $this-> telefono ; 
    }

    //SET 
    public function setNombre($nombre_Pasajero){
        $this-> nombre = $nombre_Pasajero; 
    }
    public function setApellido($apellido_Pasajero){
        $this-> apellido = $apellido_Pasajero ; 
    }
    public function setNumeroDocumento($dni){
        $this-> numeroDocumento = $dni ; 
    }
    public function setTelefono($numero_tel){
        $this-> telefono = $numero_tel ; 
    }

    //__toString
    public function __toString()
    {
        return "Nombre: " . $this->getNombre() . "\n" . 
        "Apellido: " . $this->getApellido() . "\n" . 
        "Numero de documento: " . $this->getNumeroDocumento() . "\n" . 
        "Telefono: " . $this->getTelefono() . "\n" ;
    }
}