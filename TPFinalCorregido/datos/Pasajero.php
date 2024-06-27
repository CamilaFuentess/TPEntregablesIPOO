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
    public function cargar($idPersona,$pdocumento,$pnombre,$papellido,$ptelefono,$idPasajero = null,$idviaje=null){
        parent::cargar($idPersona,$pdocumento,$pnombre,$papellido,$ptelefono);
        $this->setIdPasajero($idPasajero);
        $this->setIdViaje($idviaje);
    }

    //recupera los datos de una persona por el dni 
    public function Buscar($idpasajero){
        $base = new BaseDatos();
        $consultaPasajero = "Select p.*, pa.* 
        from pasajero pa 
        JOIN persona p ON pa.idpersona= p.idpersona
        WHERE idpasajero=" . $idpasajero; 
        $resp =false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaPasajero)){
                if($row2=$base->Registro()){
                    //datos pasajero 
                    $this->setIdViaje($row2['idviaje']);
                    $this->setIdPasajero($idpasajero);

                    //datos persona 
                    $this->setDocumento($row2['documento']); 
                    $this->setIdPersona($row2['idpersona']);
                    $this->setNombre($row2['nombre']);
                    $this->setApellido($row2['apellido']);
                    $this->setTelefono($row2['telefono']);
                    
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
        $consultaListar.=" order by idpersona ";
        if($base->Iniciar()){
            if($base->Ejecutar($consultaListar)){
                $arreglo = array();
                while($row2=$base->Registro()){
                    $obj = new Pasajero();
                    $obj->Buscar($row2['idpasajero']);
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
            $consultaInsertar = "INSERT INTO pasajero (idpasajero,idpersona,idviaje) 
                VALUES (".$this->getIdPasajero().",'". $this->getIdPersona() . "','". $this->getIdViaje()."')" ;
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
        if ($this->Buscar($this->getIdPasajero())){
            if(parent::modificar()){
                $consultaModificar = "UPDATE pasajero SET idviaje='".$this->getIdViaje().
                "' WHERE idpasajero=".$this->getIdPasajero();
                if($base->Iniciar()){
                    if($base->Ejecutar($consultaModificar)){
                        $resp =true;
                    } else {
                        $this->setMensajeOperacion($base->getError());
                    }
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion(parent::getMensajeOperacion()); 
            }
        } 
        
        return $resp;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $resp = false; 
        if($base->Iniciar()){
            if ($this->Buscar($this->getIdPasajero())){
                $consultaBorra = "DELETE FROM pasajero WHERE idpersona=".$this->getIdPersona();
                if($base->Ejecutar($consultaBorra)){
                    if(parent::eliminar()){
                        $resp = true; 
                    }
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } 
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

   public function __toString()
   {
    $cadena = parent::__toString() ;
    return $cadena . "ID del pasajero: " . $this->getIdPasajero() . "\n" . 
    "Id Viaje: " . $this->getIdViaje() . "\n";
   }
}