<?php 
include_once 'BaseDatos.php';
class Persona {

    private $documento ; 
    private $nombre;
    private $apellido ; 
    private $telefono ;
    private $mensajeoperacion ; 

    public function __construct()
    {
        $this->documento = ""; 
        $this->nombre = ""; 
        $this->apellido = ""; 
        $this->telefono = "" ; 
    }

    public function getDocumento(){
        return $this->documento ; 
    }
    public function getNombre(){
        return $this->nombre; 
    }
    public function getApellido(){
        return $this->apellido; 
    }
    public function getTelefono(){
        return $this->telefono; 
    }
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    public function setDocumento($pdocumento){
        $this->documento = $pdocumento;
    }
    public function setNombre($pnombre){
        $this->nombre = $pnombre; 
    }
    public function setApellido($papellido){
        $this->apellido = $papellido;
    }
    public function setTelefono($ptelefono){
        $this->telefono = $ptelefono;
    }
    public function setMensajeOperacion($mensajeoperacion){
        $this-> mensajeoperacion = $mensajeoperacion;
    }

    public function cargar($nroDni,$nombre,$apellido,$telefono){
        $this->setDocumento($nroDni);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setTelefono($telefono);
    }

    /**
	 * Recupera los datos de una persona por dni
	 * @param int $documento
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($documento){
        $base = new BaseDatos(); 
        $consultaPersona ="Select * from persona where documento=".$documento ;
        $resp = false; 
        if ($base->Iniciar()){
            if($base->Ejecutar($consultaPersona)){
                if($row2=$base->Registro()){
                    //$this->setIdPersona(); 
                    $this->setDocumento($documento);
                    $this->setNombre($row2['nombre']);
                    $this->setApellido($row2['apellido']);
                    $this->setTelefono($row2['telefono']);
                    $resp = true; 
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public  function listar ($condicion=""){
        $base = new BaseDatos();
        $arregloPersona = null;
        $consultaPersonas = "Select * from persona";
        if ($condicion!=""){
            $consultaPersonas=$consultaPersonas. ' where '.$condicion; 
        }
        $consultaPersonas.=" order by apellido ";
        if($base->Iniciar()){
            if ($base->Ejecutar($consultaPersonas)){
                $arregloPersona = array();  
                while($row2=$base->Registro()){
                    $documento = $row2['documento'];
                    $nombre = $row2['nombre'];
                    $apellido = $row2['apellido'];
                    $telefono = $row2['telefono'];

                    $persona = new Persona();
                    $persona->cargar($documento,$nombre,$apellido,$telefono);
                    array_push($arregloPersona,$persona);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
            
        }else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloPersona;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false ; 
        $consultaInsertar = "INSERT INTO persona(documento, nombre, apellido, telefono) 
        VALUES (".$this->getDocumento().",'".$this->getNombre()."','".$this->getApellido()."','".$this->getTelefono()."')";
        if ($base->Iniciar()){
            if ($base->Ejecutar($consultaInsertar)){
                $resp = true; 
            }else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError()); 
        }
        return $resp; 
    }

    public function modificar(){
        $base = new BaseDatos();
        $resp = false; 
        $consultaModificar="UPDATE persona SET nombre='".$this->getNombre()."',apellido='".$this->getApellido()."'
                           ,telefono='".$this->getTelefono()."', documento='" . $this->getDocumento()."' WHERE documento=". $this->getDocumento();
        if ($base->Iniciar()){
            if($base->Ejecutar($consultaModificar)){
                $resp = true; 
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $base =new BaseDatos(); 
        $resp = false; 
        if ($base->Iniciar()){
            $consultaBorrar = "DELETE FROM persona WHERE documento=".$this->getDocumento();
            if($base->Ejecutar($consultaBorrar)){
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function __toString()
    {
        return "Numero de documento: " . $this->getDocumento() . "\n" . 
        "Nombre: " . $this->getNombre() . "\n" . 
        "Apellido: " . $this->getApellido() . "\n" . 
        "Numero de telefono: " . $this->getTelefono() . "\n";
    }
}