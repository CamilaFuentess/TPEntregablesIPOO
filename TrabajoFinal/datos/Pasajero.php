<?php 

include_once 'BaseDatos.php';
class Pasajero extends Persona{

    private $idpasajero ; 
    private $idviaje ;

    public function __construct()
    {
        parent::__construct();
        $this->idpasajero = "";
        $this->idviaje = "";
    }

    public function getIdViaje(){
        return $this->idviaje ; 
    }
    public function getIdPasajero(){
        return $this->idpasajero ;
    }
    
    public function setIdViaje($idviaje){
        $this->idviaje = $idviaje;
    }
    public function setIdPasajero($idPasajero){
        $this->idpasajero = $idPasajero;
    }
    
    //carga al pasajero 
    public function cargar($pdocumento,$pnombre,$papellido,$ptelefono,$idPasajero = null,$idviaje=null){
        parent::cargar($pdocumento,$pnombre,$papellido,$ptelefono);
        $this->setIdPasajero($idPasajero);
        $this->setIdViaje($idviaje);
    }

    //recupera los datos de una persona por el dni 
    public function Buscar($dni){
        $base = new BaseDatos();
        $consultaPasajero = "Select * from pasajero where documento=".$dni; 
        $resp =false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaPasajero)){
                if($row2=$base->Registro()){
                    parent::Buscar($dni);
                    $this->setIdPasajero($row2['idpasajero']);
                    $this->setIdViaje($row2['idviaje']);
                    $resp = true; 
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else{
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion=""){
        $base = new BaseDatos();
        $arreglo = null;
        $consultaListar = "Select * from pasajero ";
        if ($condicion!=""){
            $consultaListar = $consultaListar. ' where '. $condicion;
        }
        $consultaListar.=" order by documento ";
        if($base->Iniciar()){
            if($base->Ejecutar($consultaListar)){
                $arreglo = array();
                while($row2=$base->Registro()){
                    $obj = new Pasajero();
                    $obj->Buscar($row2['documento']);
                    array_push($arreglo,$obj);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arreglo;
    }

    //inserta registro en la tabla 
    public function insertar(){
        $base = new BaseDatos;
        $resp = false; 
        if(parent::insertar()){
            $consultaInsertar = "INSERT INTO pasajero (idpasajero,documento,idviaje) 
                VALUES (".$this->getIdPasajero(). ",'".$this->getDocumento()."','".$this->getIdViaje()."')" ;
            if($base->Iniciar()){
                //ejecuta la consulta de insertar y obtiene el id del nuevo registro 
                if($id = $base->devuelveIDInsercion($consultaInsertar)){
                    $this->setIdPasajero($id);
                    $resp =true; 
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        }
        return $resp;
    }
    
    public function modificar(){
        $base = new BaseDatos();
        $resp = false; 
        if(parent:: modificar()){
            $consultaModificar = "UPDATE pasajero SET idpasajero='".$this->getIdPasajero()."',idviaje='".$this->getIdViaje()."' WHERE documento=".$this->getDocumento();
            if($base->Iniciar()){
                if($base->Ejecutar($consultaModificar)){
                    $resp =true;
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } 
        return $resp;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $resp = false; 
        if($base->Iniciar()){
            $consultaBorra = "DELETE FROM pasajero WHERE documento=".$this->getDocumento();
            if($base->Ejecutar($consultaBorra)){
                if(parent::eliminar()){
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

    public function __toString()
    {
        $cadenaPadre = parent::__toString();
        return $cadenaPadre . 
        "ID Pasajero: " . $this->getIdPasajero() . "\n" . 
        "ID viaje: " . $this->getIdViaje() . "\n" ; 
    }
}