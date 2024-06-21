<?php 

//necesitan de servicios especiales como silla de ruedas, asiestencia, tipo comida,etc
class PasajeroEspecial extends Pasajero {

    //Atributos 
    private $tipoNecesidad ;  //puede ser una o mas 
 
    //Constructor 
    public function __construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket,$necesidad)
    {
        parent::__construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket);
        $this->tipoNecesidad = $necesidad;
    }

    //Get
    public function getTipoNecesidad(){
        return $this->tipoNecesidad ;
    }

    //Set 
    public function setTipoNecesidad($necesidad){
        $this->tipoNecesidad = $necesidad;
    }

    //ToString 
    public function __toString()
    {
        $cadena = parent::__toString() ; 
        return $cadena . "Tipo de necesidad: \n" . $this->mostrarTipoNecesidad() . "\n" ; 
    }

    //Si el pasajero tiene muchas necesidades, las alista y la muestra 
    public function mostrarTipoNecesidad(){
        $necesidades = $this->getTipoNecesidad() ; 
        $lista = "" ;
        foreach($necesidades as $unaNecesidad){
            $lista = $lista . $unaNecesidad . "\n";
        }
        return $lista;
    }

    /**
     * Si el pasajero tiene necesidades especiales y requiere silla de ruedas,
     * asistencia y comida especial entonces el pasaje tiene un incremento del 30%;
     * si solo requiere uno de los servicios prestados entonces el incremento es del 15%
     */
    public function darPorcentajeIncremento()
    {
        $porcentajeIncremento = 0 ;
        $necesidades = $this->getTipoNecesidad() ; 
        $countNecesidades = count($necesidades);
        if ($countNecesidades == 3){
            $porcentajeIncremento = 30 ; 
        } else {
            $porcentajeIncremento = 15 ;
        }
        return $porcentajeIncremento;
    }
}