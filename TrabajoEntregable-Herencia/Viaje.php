<?php 

class Viaje {

    //ATRIBUTOS
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros; //coleccion de pasajeros 
    private $responsableV ; //objeto ResponsableV
    private $costoViaje ; 
    private $sumaCostos ;

    //CONSTRUCTOR 
    public function __construct($codigo_viaje,$lugar_viaje,$maximo_pasajeros,$coleccion_pasajeros, $responsable, $costo)
    {
        $this->codigoViaje  = $codigo_viaje  ; 
        $this-> destino = $lugar_viaje  ; 
        $this-> cantMaxPasajeros = $maximo_pasajeros  ; 
        $this-> colPasajeros = $coleccion_pasajeros ; 
        $this-> responsableV = $responsable;
        $this->costoViaje = $costo; 
    }

    //GET 
    public function getCodigoViaje(){
        return $this-> codigoViaje ;
    }
    public function getDestino(){
        return $this-> destino ;
    }
    public function getCantMaxPasajeros(){
        return $this-> cantMaxPasajeros ;
    }
    public function getColPasajeros(){
        return $this-> colPasajeros ;
    }
    public function getResponsableV(){
        return $this-> responsableV ; 
    }
    public function getCostoViaje(){
        return $this->costoViaje ;
    }
    public function getSumaCostos(){
        return $this->sumaCostos;
    }

    //SET 
    public function setCodigoViaje ($codigo_viaje){
        $this-> codigoViaje = $codigo_viaje  ;
    }
    public function setDestino ($lugar_viaje){
        $this-> destino = $lugar_viaje ;
    }
    public function setCantMaxPasajeros ($maximo_pasajeros){
        $this-> cantMaxPasajeros = $maximo_pasajeros ;
    }
    public function setColPasajeros ($coleccion_pasajeros){
        $this-> colPasajeros = $coleccion_pasajeros ;
    }
    public function setResponsableV($responsable){
        $this-> responsableV = $responsable;
    }
    public function setCostoViaje($costo){
        $this->costoViaje = $costo ;
    }
    public function setSumaCostos($sumaDeCostos){
        $this->sumaCostos = $sumaDeCostos;
    }

    //__toString 
    public function __toString()
    {
        return "Codigo de viaje: " . $this->getCodigoViaje() ."\n" . 
        "Destino: " . $this->getDestino() . "\n" .
        "Datos del responsable del viaje: \n" . $this->getResponsableV(). "\n" .  
        "Cantidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n" . 
        "Lista de pasajeros: \n" . $this->mostrarListaPasajeros() . "\n" . 
        "Costo del viaje: " . $this->getCostoViaje() . "\n";
    }

    //Metodo para mostrar toda la lista de paajeros 
    public function mostrarListaPasajeros(){
        $listaPasajeros = $this->getColPasajeros();
        $lista = "\n";
        foreach ($listaPasajeros as $pasajero) {
            //Operador . de concatenacion para loragr una salida en cada interacion del foreach
            $lista = $lista . $pasajero->__toString()."\n"; 
        }
        return $lista;
    }

    /**
     * METODO MODIFICADO PARA EL TP3.
     * Metodo que verifica si un pasajero se encuentra en la lista, en caso
     * de que si retorna el objeto pasajero, sino, devuelve null 
     * @param int $verificaDocumento;
     */
    public function pasajeroEnLaLista($verificaDocumento){
        $lista = $this->getColPasajeros();
        $i = 0 ; 
        $count = count($lista);
        $encontrado = false;
        $objADevolver = null;
        if ($count>0){         //sin este if, la consola me tira error a la hora de usar la funcion en verder pasaje 
            while($i<$count && !$encontrado) {
                $dni = $lista[$i]->getNumeroDocumento(); //asigno el dni del pasajero actual a la variable dni
                if( $verificaDocumento == $dni) {
                    $objADevolver = $lista[$i];
                    $encontrado = true;    //devuelve el pasajero al que le corresponde el dni 
                }
            $i++;
            }
        }
        
        return $objADevolver; 
    }

   
    //METODO MODIFICADO, AHORA EL PASEJRO SE CREA EN EL TEST Y ME ENTRA COMO OBJ 
    //EL TEST YA VERIFICA SI EL PASAJERO SE ENCUENTRA EN LA LISTA 
    //METODO QUE AGREGA UN OBJ PASAJERO A MI LISTA DE PASAJEROS 
    public function agregarPasajero($objPasajero){
        $listaDePasajeros = $this->getColPasajeros() ; 
        $listaDePasajeros[] = $objPasajero; 
        $this->setColPasajeros($listaDePasajeros) ;
    }

    //METODO QUE ELIMINA A UN PASAJERO 
    public function eliminarPasajero($nroDoc){
        $encontrado = $this->pasajeroEnLaLista($nroDoc);
        $listaPasajeros = $this->getColPasajeros(); 
        $logrado = false; 
        $i = 0; 
        if ($encontrado!=null){
            while ($i<count($listaPasajeros) && !$logrado){
                $dniActual = $listaPasajeros[$i]->getNumeroDocumento(); 
                if ($dniActual == $nroDoc){
                    unset($listaPasajeros[$i]);
                    $this->setColPasajeros($listaPasajeros);
                    $logrado = true;
                }
                $i++;
            }
        }
        return $logrado; 
    }

    //cambia al responsable del viaje 
    public function cambiarResponsableV($nuevoNroEmpleado, $nuevoNroLicencia, $nuevoNombreRV, $nuevoApellidoRV){
        $objResponsable = $this->getResponsableV(); 
        $noSeEncuentra = $this->responsableEsta($nuevoNroEmpleado);
        if (!$noSeEncuentra) { //verifico que no se trate del mismo empleado
            $objResponsable->setNroEmpleado($nuevoNroEmpleado);
            $objResponsable->setNroLicencia($nuevoNroLicencia);
            $objResponsable->setNombreResponsable($nuevoNombreRV);
            $objResponsable->setApellidoResponsable($nuevoApellidoRV);
        }
    }

    //cambia los datos del responsable 
    public function cambiarDatosResponsable($nroEmpleado, $cambiarNroLicencia, $cambiarNombre, $cambiarApellido){
        $obtengoResponsable = $this->getResponsableV();
        $esta = $this->responsableEsta($nroEmpleado); 
        if ($esta){
            $obtengoResponsable->setNroLicencia($cambiarNroLicencia);
            $obtengoResponsable->setNombreResponsable($cambiarNombre);
            $obtengoResponsable->setApellidoResponsable($cambiarApellido);
        }
    }

    //Verifico si el nroEmpleado ingresado es igual al que tengo guardado 
    public function responsableEsta($numeroEmpleado){
        $elResponsable = $this-> getResponsableV();
        $existeResponsable = false; 
        $elResponsableNro = $elResponsable->getNroEmpleado();
        if ($elResponsableNro == $numeroEmpleado){
            $existeResponsable = true;
        }
        return $existeResponsable; 
    }

    ///////////////////////////////////METODOS AGREGADOS PARA EL TP DE HERENCIA 

    /**
     * Calcula el costo del pasaje, con el incremento dado por los pasajeros
     * sumo el % de incremento al costo de viaje y lo devuelvo. Al mismo tiempo
     * sumo el costo de viaje con el incrmeento a otra variable que me acumula el
     * costo recaudado
     */
    public function calcularCosto($objPasajero){
        $porcentajeIncremento = $objPasajero->darPorcentajeIncremento();  //obtengo el %
        $costoDelViaje = $this->getCostoViaje() ;
        $costoAPagar = $costoDelViaje + ($costoDelViaje*$porcentajeIncremento/100);
        $recaudacion = $this->getSumaCostos() + $costoAPagar ;
        $this->setSumaCostos($recaudacion);
        return $costoAPagar;
    }

    /**
     * incorpora el pasajero a la colección de pasajeros ( solo si hay espacio disponible),
     * actualizar los costos abonados y retornar el costo final que deberá ser abonado por
     *  el pasajero.
     */
    //agregar que no se pueda  vender el mismo nr de asiento 
    public function venderPasaje($objPasajero){
        $disponible = $this->hayPasajesDisponibles();
        //me falto asignarlw un asiento 
        if ($disponible){
            $costoFinal = $this->calcularCosto($objPasajero);
            $this->agregarPasajero($objPasajero);
            //La funcion cargarPasajero ya me agrega al pasajero en la lista 
        } else {
            $costoFinal = 0;
        }
        return $costoFinal;
    }
  
    /**
     * Retorna verdadero si la cantidad de pasajeros es menor a la cantidad a 
     * la cant maxima de pasajeros, falso en caso contrario 
     */
    public function hayPasajesDisponibles(){
        $colcPasajeros = $this->getColPasajeros(); 
        $cantMaxima = $this->getCantMaxPasajeros() ;
        $countPasajeros = count($colcPasajeros) ; 
        $disponibilidad = false;
        if ($countPasajeros<$cantMaxima){
            $disponibilidad = true ; 
        }
        return $disponibilidad ;
    }
}