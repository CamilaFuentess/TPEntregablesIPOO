<?php 

class PasajeroEstandar extends Pasajero {

    //Atributos 
    //No tiene atributos propios

    //Constructor 
    public function __construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket)
    {
        parent::__construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket);
    }

    //Get


    //Set 


    //ToString 
    public function __toString()
    {
        $cadenaPadre = parent::__toString();
        return $cadenaPadre; 
    }

    //
    public function darPorcentajeIncremento()
    {
        $porcentajeIncremento = 10 ;
        return $porcentajeIncremento; 
    }

}