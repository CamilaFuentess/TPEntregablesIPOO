<?php 

class Pasajero {

    //ATRIBUTOS 
    private $nombre; 
    private $apellido; 
    private $numeroDocumento; 
    private $telefono;
    private $nroAsiento; 
    private $nroTicket ; 

    //CONSTRUCTOR 
    public function __construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket)
    {
        $this-> nombre = $nombre_Pasajero ; 
        $this-> apellido = $apellido_Pasajero ; 
        $this-> numeroDocumento = $dni; 
        $this-> telefono = $numero_tel  ; 
        $this-> nroAsiento = $asiento ; 
        $this->nroTicket = $ticket; 
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
    public function getNroAsiento(){
        return $this->nroAsiento; 
    }
    public function getNroTicket(){
        return $this->nroTicket ;
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
    public function setNroAsiento($nroAsiento){
        $this->nroAsiento = $nroAsiento ; 
    }
    public function setNroTicket($ticket){
        $this->nroTicket = $ticket ;
    }

    //__toString
    public function __toString()
    {
        return "Nombre: " . $this->getNombre() . "\n" . 
        "Apellido: " . $this->getApellido() . "\n" . 
        "Numero de documento: " . $this->getNumeroDocumento() . "\n" . 
        "Telefono: " . $this->getTelefono() . "\n" . 
        "Numero asiento: " . $this->getNroAsiento(). "\n" . 
        "Numero ticket: " . $this->getNroTicket() . "\n" ;
    }

    //retorna el porcentaje que debe aplicarse segun el incremento que depende
    //de las caracteristicas del pasajero 
    public function darPorcentajeIncremento(){
        return 0 ;
    }
}