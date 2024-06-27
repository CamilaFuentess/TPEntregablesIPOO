<?php 
include_once 'BaseDatos.php';
class Viaje {

    //atributos 
    private $idviaje; 
    private $vdestino; 
    private $vcantmaxpasajeros ; 
    private $idempresa;                //objeto empresa
    private $objresponsable ;             //objeto respnsable 
    private $colPasajeros;             //col de obj pasajeros 
    private $vimporte; 
    private $mensajeoperacion; 

    //constructor 
    public function __construct()
    {
        $this->idviaje = ""; 
        $this->vdestino = ""; 
        $this->vcantmaxpasajeros = ""; 
        $this->idempresa = ""; 
        $this->objresponsable = "";
        $this->colPasajeros =[];
        $this->vimporte = "";
    }

    //get
    public function getIdViaje(){
        return $this->idviaje;
    }
    public function getDestino(){
        return $this->vdestino;
    }
    public function getCantMaxPasajeros(){
        return $this->vcantmaxpasajeros;
    }
    public function getEmpresa(){
        return $this->idempresa;
    }
    public function getObjResponsable(){
        return $this->objresponsable; 
    }
    public function getColPasajeros(){
        return $this->colPasajeros; 
    }
    public function getImporte(){
        return $this->vimporte;
    }
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    //set 
    public function setIdViaje($idViaje){
        $this->idviaje = $idViaje;
    }
    public function setDestino($destino){
        $this->vdestino = $destino; 
    }
    public function setCantMaxasajeros($maxPasajeros){
        $this->vcantmaxpasajeros = $maxPasajeros;
    }
    public function setEmpresa($idEmpresa){
        $this->idempresa = $idEmpresa;
    }
    public function setObjResponsable($objResponsable){
        $this->objresponsable = $objResponsable;
    }
    public function setColPasajeros($colPasajeros){
        $this->colPasajeros = $colPasajeros; 
    }
    public function setImporte($importe){
        $this->vimporte = $importe;
    }
    public function setMensajeOperacion($mensajeoperacion){
        $this->mensajeoperacion =$mensajeoperacion;
    }

    //cargar los datos al objeto 
    public function cargar($idviaje,$vdestino,$vcantmaxpasajeros,$empresa,$responsable,/*$colPasajeros,*/$vimporte){
        $this->setIdViaje($idviaje);
        $this->setDestino($vdestino);
        $this->setCantMaxasajeros($vcantmaxpasajeros);
        $this->setEmpresa($empresa);
        $this->setObjResponsable($responsable);
        //$this->setColPasajeros($colPasajeros);
        $this->setImporte($vimporte);
    }

    /**
     * Recupera los datos de un viaje por su id 
     * @param int $idviaje 
     * @return boolean 
     */
    public function Buscar($idviaje){
        $base = new BaseDatos();
        $consultaViaje="Select * from viaje where idviaje=".$idviaje;
        $resp=false; 
        if($base->Iniciar()){
            if($base->Ejecutar($consultaViaje)){
                if($row2=$base->Registro()){
                    $this->setIdViaje($idviaje);
                    $this->setDestino($row2['vdestino']);
                    //$objPasajero = new Pasajero();
                    //obtiene el array de pasajeros que estan almacenados con el id del viaje 
                    //$colPasajeros = $objPasajero->listar("idviaje=" . $idviaje);
                    //$this->setColPasajeros($colPasajeros);
                    $empresa = new Empresa();
                    $empresa->Buscar($row2['idempresa']);
                    $this->setEmpresa($empresa);
                    $this->setCantMaxasajeros($row2['vcantmaxpasajeros']);
                    $responsable = new ResponsableV(); 
                    $responsable->Buscar($row2['rnumeroempleado']);
                    $this->setObjResponsable($responsable); 
                    $this->setImporte($row2['vimporte']);
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
        $base = new BaseDatos; 
        $arreglo = false; 
        $consulta = "Select * from viaje "; 
        if ($condicion!=""){
            $consulta = $consulta . ' where ' .$condicion;
        }
        $consulta.=" order by vdestino ";
        if ($base->Iniciar()){
            if ($base->Ejecutar($consulta)){
                $arreglo = array();
                while($row2=$base->Registro()){
                    $idviaje=$row2['idviaje'];
                    $destino = $row2['vdestino'];
                    $maximo = $row2['vcantmaxpasajeros'];
                    $empresa = new Empresa(); 
                    $empresa->Buscar($row2['idempresa']);
                    $responsable = new ResponsableV(); 
                    $responsable->Buscar($row2['rnumeroempleado']);
                    //$pasajeroAux = new Pasajero();
                    //$colecPasajeros = $pasajeroAux->listar("idviaje=" . $idviaje);
                    $importe = $row2['vimporte'];
                    $viaje = new Viaje();
                    $viaje->cargar($idviaje,$destino,$maximo,$empresa,$responsable,/*$colecPasajeros,*/$importe);
                    array_push($arreglo,$viaje);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arreglo;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false; 
        //$responsable = $this->getObjResponsable(); 
        //$empresa = $this->getEmpresa() ; 
        $consultaInsertar = "INSERT INTO viaje(idviaje,vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte)
        VALUES (".$this->getIdViaje().",'".$this->getDestino()."','".$this->getCantMaxPasajeros()."','"
        .$this->getEmpresa()."','".$this->getObjResponsable()."','".$this->getImporte()."')";
        //ya tiene el idempresa    //ya tiene el nroempleado
        if ($base->Iniciar()){
            if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdViaje($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}
        }
        return $resp;
    }

    public function modificar(){
        $base = new BaseDatos();
        $resp = false; 
        //si hago un echo de $this->getEmpresa() me coloca todo el obj al igual que el del responsable 
        echo $this->getObjResponsable();
        $consultaModificar = "UPDATE viaje SET idviaje='".$this->getIdViaje()."',vdestino='".$this->getDestino()."'
            ,vcantmaxpasajeros='".$this->getCantMaxPasajeros()."',idempresa='". $this->getEmpresa()->getIdEmpresa().
            "',rnumeroempleado='".$this->getObjResponsable()->getNroEmpleado()."',vimporte='".$this->getImporte().
            "' WHERE idviaje=".$this->getIdViaje();
        if ($base->Iniciar()){
            if ($base->Ejecutar($consultaModificar)){
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
        $base = new BaseDatos();
        $resp = false; 
        if ($base->Iniciar()){
            $consultaBorra ="DELETE FROM viaje WHERE idviaje=".$this->getIdViaje();
            if($base->Ejecutar($consultaBorra)){
                $resp = true; 
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    //muestra col pasajeros 
    /**public function mostrarColPasajeros(){
        $colPasajeros = $this->getColPasajeros(); 
        $lista = "";
        foreach($colPasajeros as $uno){
            $lista = $lista . $uno ;
        }
        return $colPasajeros;
    }*/
    public function __toString()
    {
        return "ID Viaje: " . $this->getIdViaje() . "\n" . 
        "Destino: ". $this->getDestino() . "\n" . 
        "Cantidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n" . 
        "ID Empresa: " . $this->getEmpresa()->getIdEmpresa() . "\n" . //SI ME LO TOMA COMO OBJETO
        "Datos del Responsable: \n" . $this->getObjResponsable() . 
        //"Pasajeros: \n" . $this->mostrarColPasajeros() . "\n" . 
        "Importe del viaje: " . $this->getImporte() . "\n";
    }
}