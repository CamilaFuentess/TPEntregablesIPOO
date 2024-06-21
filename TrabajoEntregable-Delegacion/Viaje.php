<?php 

class Viaje {

    //ATRIBUTOS
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros; //coleccion de pasajeros 
    private $responsableV ; //objeto ResponsableV

    //CONSTRUCTOR 
    public function __construct($codigo_viaje,$lugar_viaje,$maximo_pasajeros,$coleccion_pasajeros, $responsable)
    {
        $this->codigoViaje  = $codigo_viaje  ; 
        $this-> destino = $lugar_viaje  ; 
        $this-> cantMaxPasajeros = $maximo_pasajeros  ; 
        $this-> colPasajeros = $coleccion_pasajeros ; 
        $this-> responsableV = $responsable;
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

    //__toString 
    public function __toString()
    {
        return "Codigo de viaje: " . $this->getCodigoViaje() ."\n" . 
        "Destino: " . $this->getDestino() . "\n" .
        "Datos del responsable del viaje: \n" . $this->getResponsableV(). "\n" .  
        "Cantidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n" . 
        "Lista de pasajeros: \n" . $this->mostrarListaPasajeros() . "\n" ;
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

    //METODOS PARA MODIFICAR DATOS DEL VIAJE 
    //MODIFICA EL CODIGO DEL VIAJE 
    public function cambiarCodigoViaje($nuevoCodigo){
        $cambiado = false ;
        if ($nuevoCodigo != $this->getCodigoViaje()) {
            $this->setCodigoViaje($nuevoCodigo);
            $cambiado = true;
        }
        return $cambiado;
    }

    //MODIFICA EL DESTINO
    public function cambiarDestino($nuevoDestino) {
        $logrado = false;
        if ($nuevoDestino != $this->getDestino()){
            $this->setDestino($nuevoDestino);
            $logrado = true;
        }
        return $logrado;
    }

    //MODIFICA LA CANTIDAD MAXIMA DE PASAJEROS
    public function cambiarCantMaxPasajeros($nuevoMaximo){
        $hayNuevoMax = false;
        if ($nuevoMaximo != $this->getCantMaxPasajeros()){
            $this->setCantMaxPasajeros($nuevoMaximo);
            $hayNuevoMax = true;
        }
        return $hayNuevoMax;   
    }

    /**
     * Metodo que verifica si un pasajero se encuentra en la lista, en caso de que no, retorna false 
     * @param int $verificaDocumento;
     * @return boolean 
     */
    public function pasajeroEnLaLista($verificaDocumento){
        $lista = $this->getColPasajeros();
        $i = 0 ; 
        $count = count($lista);
        $encontrado = false;
        while($i<$count && !$encontrado) {
            $pasajeroLista = $lista[$i]; //obtengo al pasajero actual
            $dni = $pasajeroLista->getNumeroDocumento(); //asigno el dni del pasajero actual a la variable dni
            if( $verificaDocumento == $dni) {
                $encontrado = true;
            }
            $i = $i + 1;
        }
        return $encontrado; 
    }

    //MODIFICA NOMBRE, APELLIDO Y TELEFONO DE UN PASAJERO
    public function cambiarDatosPasajeros($obtengoDni, $nuevoNombre,$nuevoApellido,$nuevoTelefono){
        $colPasajeros = $this->getColPasajeros();
        $i = 0 ;
        $count = count($colPasajeros);
            while($i < $count) {
                $pasajeroActual = $colPasajeros[$i]; //obtengo al pasajero actual del array
                //$dniPasajeroActual = $pasajeroActual->getNumeroDocumento();
                if($obtengoDni == $pasajeroActual->getNumeroDocumento()) {
                    $pasajeroActual->setNombre($nuevoNombre);
                    $pasajeroActual->setApellido($nuevoApellido);
                    $pasajeroActual->setTelefono($nuevoTelefono);
                }
                $i = $i +1;
            }
            return $pasajeroActual;
    }

    //METODO QUE AGREGA A UN PASAJERO 
    public function agregarPasajero($agregarNombre, $agregarApellido,$agregarDni, $agregarTelefono){
        $noEncontrado = $this->pasajeroEnLaLista($agregarDni);  //verifico que el pasajero no se encuentre en la lista 
        $listaDePasajeros = $this->getColPasajeros();
        $maximo = $this->getCantMaxPasajeros();                //obtengo el maximo de pasajeros, para ver si se pueden agregar mas 
        $actualPasajeros = count($listaDePasajeros);
        $agregado = false ;
        if ($actualPasajeros < $maximo && !$noEncontrado) {
            $nuevoPasajero = new Pasajero ($agregarNombre,$agregarApellido,$agregarDni,$agregarTelefono);
            $listaDePasajeros[] = $nuevoPasajero;
            $this->setColPasajeros($listaDePasajeros);
            $agregado = true;                                    //para que en el test el pasajero sepa que fue agregado con exito  o no 
        }
        return $agregado; 
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
}