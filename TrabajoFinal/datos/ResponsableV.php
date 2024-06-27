<?php 
include_once 'BaseDatos.php';
class ResponsableV extends Persona{

    private $rnroEmpleado ; 
    private $rnroLicencia ; 

    public function __construct()
    {
        parent::__construct();
        $this->rnroEmpleado = "";
        $this->rnroLicencia = ""; 
    }

    public function getNroEmpleado(){
        return $this->rnroEmpleado;
    }
    public function getNroLicencia(){
        return $this->rnroLicencia;
    }
    

    public function setNroEmpleado($rnroEmpleado){
        $this->rnroEmpleado = $rnroEmpleado; 
    }
    public function setNroLicencia($rnroLicencia){
        $this->rnroLicencia = $rnroLicencia; 
    }

    public function cargar ($nroDni,$nombre,$apellido,$telefono,$rnroEmpleado=null,$rnroLicencia=null){
        parent::cargar($nroDni,$nombre,$apellido,$telefono) ; 
        $this->setNroEmpleado($rnroEmpleado);
        $this->setNroLicencia($rnroLicencia);
    }

    //busca y recupera los datos de una persona por su numero de empleado
    //No se hace uso del metodo padre debido a que entra por parametro el nro empleado 
    // no el dni como lo busca el padre 
    public function Buscar($nroEmpleado){
        $base = new BaseDatos();
        $consultaResponsable = "Select r.*, p.* 
         from responsable r 
         JOIN persona p ON r.documento = p.documento
         where rnumeroempleado=".$nroEmpleado ; 
        $resp = false; 
        if ($base->Iniciar()){
            if ($base->Ejecutar($consultaResponsable)){
                if ($row2=$base->Registro()){
                    $this->setNroEmpleado($nroEmpleado);
                    $this->setNroLicencia($row2['rnumerolicencia']); 

                    //setea datos de persona 
                    $this->setDocumento($row2['documento']);
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

    public function listar($condicion=""){
        $arragloResponsable = null; 
        $base = new BaseDatos();
        $consultaResponsable = "Select * from responsable "; 
        if ($condicion!=""){
            $consultaResponsable = $consultaResponsable. ' where '. $condicion;
        }
        $consultaResponsable .= " order by rnumeroempleado "; 
        if ($base->Iniciar()){
            if($base->Ejecutar($consultaResponsable)){
                $arragloResponsable = array();
                while($row2=$base->Registro()){
                    $objRes = new ResponsableV(); 
                    $objRes->Buscar($row2['rnumeroempleado']);
                    array_push($arragloResponsable,$objRes);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arragloResponsable;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false; 

        if(parent::insertar()){
            $consultaInsertar = "INSERT INTO responsable(rnumeroempleado,rnumerolicencia,documento)
            VALUES (".$this->getNroEmpleado().",'".$this->getNroLicencia()."','".$this->getDocumento()."')";
            if ($base->Iniciar()){
                if ($id=$base->devuelveIDInsercion($consultaInsertar)){
                    $this->setNroEmpleado($id);
                    $resp = true; 
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
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
        if (parent::modificar()){
            $consultaModificar = "UPDATE responsable SET rnumeroempleado='".$this->getNroEmpleado()."',rnumerolicencia='".$this->getNroLicencia().
            "' WHERE rnumeroempleado=".$this->getNroEmpleado();
            if ($base->Iniciar()){
                if($base->Ejecutar($consultaModificar)){
                    $resp = true; 
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
        $base = new BaseDatos; 
        $resp = false; 
        if($base->Iniciar()){
            $consultaBorrar = "DELETE FROM responsable WHERE rnumeroempleado=".$this->getNroEmpleado();
            if ($base->Ejecutar($consultaBorrar)){
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
        return "Nro de empleado: " . $this->getNroEmpleado(). "\n" .  
        $cadenaPadre .
        "Nro de licencia: " . $this->getNroLicencia() . "\n" ;
    }
}
