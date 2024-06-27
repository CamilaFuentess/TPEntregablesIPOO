<?php 
include_once "BaseDatos.php";
class Empresa {

    //atributos 
    private $idempresa; 
    private $enombre; 
    private $edireccion ; 
    //private $colViajes ; 
    private $mensajeoperacion ; 

    //constructor 
    public function __construct()
    {
        $this->idempresa = ""; 
        $this->enombre = ""; 
        $this->edireccion = ""; 
        //$this->colViajes="";
    }

    //get
    public function getIdEmpresa(){
        return $this->idempresa;
    }
    public function getNombre(){
        return $this->enombre;
    }
    public function getDireccion(){
        return $this->edireccion;
    }
    /**public function getColViajes(){
        return $this->colViajes;
    }*/
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    //set 
    public function setIdEmpresa($idempresa){
        $this->idempresa = $idempresa; 
    }
    public function setNombre($enombre){
        $this->enombre = $enombre;
    }
    public function setDireccion($edireccion){
        $this->edireccion = $edireccion;
    }
    /**public function setColViajes($colViajes){
        $this->colViajes = $colViajes; 
    }*/
    public function setMensajeOperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    //cargar los datos al objeto 
    public function cargar($idempresa,$enombre,$edireccion){
        $this->setIdEmpresa($idempresa);
        $this->setNombre($enombre);
        $this->setDireccion($edireccion);
    }

    /**
     * Recupera los datos de una empresa por su id
     * @param int $idempresa
     * @return boolean en caso de encontrar los datos true
     */
    public function Buscar($idempresa){
        $base = new BaseDatos(); 
        $consultaEmpresa = "Select * from empresa where idempresa=".$idempresa;
        $resp= false; 
        if ($base->Iniciar()){
            if ($base->Ejecutar($consultaEmpresa)){
                if($row2=$base->Registro()){
                    $this->setIdEmpresa($idempresa);
                    $this->setNombre($row2['enombre']);
                    $this->setDireccion($row2['edireccion']);
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

    public static function listar($condicion=""){
        $base = new BaseDatos();
        $arregloEmpresa = null; 
        $consultaEmpresa = "Select * from empresa"; 
        if($condicion!=""){
            $consultaEmpresa = $consultaEmpresa. ' where ' . $condicion ; 
        }
        $consultaEmpresa.= " order by idempresa"; 
        if($base->Iniciar()){
            if($base->Ejecutar($consultaEmpresa)){
                $arregloEmpresa=array();
                while($row2=$base->Registro()){
                    $idempresa=$row2['idempresa'];
                    $nombre=$row2['enombre'];
                    $direccion=$row2['edireccion'];

                    $empresa = new Empresa();
                    $empresa->cargar($idempresa,$nombre,$direccion);
                    array_push($arregloEmpresa,$empresa);
                }
            } else {
                self::setMensajeOperacion($base->getError());
            }
        } else {
            self::setMensajeOperacion($base->getError());
        }
        return $arregloEmpresa;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false ; 
        $consultaInsertar ="INSERT INTO empresa(idempresa,enombre,edireccion) 
            VALUES (".$this->getIdEmpresa().",'".$this->getNombre()."','".$this->getDireccion()."')";
        if ($base->Iniciar()){
            if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdEmpresa($id);
                $resp=true;
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
        $consultaModificar = "UPDATE empresa SET enombre='".$this->getNombre().
            "',edireccion='".$this->getDireccion()."' WHERE idempresa=".$this->getIdEmpresa();
        if($base->Iniciar()){
            if ($this->Buscar($this->getIdEmpresa())){
                if($base->Ejecutar($consultaModificar)){
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

    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        if($base->Iniciar()){
            $consultaBorrar="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
            if ($this->Buscar($this->getIdEmpresa())){
                if($base->Ejecutar($consultaBorrar)){
                    $resp = true; 
                }else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
           
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp ;
    }

    public function __toString()
    {
        return "Id empresa: " . $this->getIdEmpresa() . "\n" . 
        "Nombre: " . $this->getNombre() . "\n" . 
        "Direccion: " . $this->getDireccion() . "\n";
    }
}