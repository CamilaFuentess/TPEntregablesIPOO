<?php 
//RESPONSABLE V ES EL PILOTO
class ResponsableV {

    //ATRIBUTOS
    private $nroEmpleado; 
    private $nroLicencia; 
    private $nombreResponsable; 
    private $apellidoResponsable; 

    //CONSTRUCTOR 
    public function __construct($numero_Empleado, $numero_licencia, $nombre_Responsable, $apellido_Responsable)
    {
        $this-> nroEmpleado = $numero_Empleado ; 
        $this-> nroLicencia = $numero_licencia ; 
        $this-> nombreResponsable = $nombre_Responsable ; 
        $this-> apellidoResponsable = $apellido_Responsable ; 
    }

    //GET 
    public function getNroEmpleado (){
        return $this-> nroEmpleado ;
    }
    public function getNroLicencia (){
        return $this-> nroLicencia ;
    }
    public function getNombreResponsable (){
        return $this-> nombreResponsable ;
    }
    public function getApellidoResponsable (){
        return $this-> apellidoResponsable ;
    }

    //SET 
    public function setNroEmpleado ($numero_Empleado) {
        $this-> nroEmpleado  = $numero_Empleado ;
    }
    public function setNroLicencia ($numero_licencia) {
        $this-> nroLicencia = $numero_licencia ;
    }
    public function setNombreResponsable ($nombre_Responsable) {
        $this-> nombreResponsable = $nombre_Responsable  ;
    }
    public function setApellidoResponsable ($apellido_Responsable) {
        $this-> apellidoResponsable = $apellido_Responsable  ;
    }

    //__toString 
    public function __toString()
    {
        return "Numero de empleado: " . $this->getNroEmpleado() . "\n" . 
        "Numero de licencia: " . $this->getNroLicencia() . "\n". 
        "Nombre del responsable: " . $this->getNombreResponsable() . "\n" . 
        "Apellido del responsable: " . $this->getApellidoResponsable() . "\n";
    }

}