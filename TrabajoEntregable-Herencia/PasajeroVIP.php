<?php 

class PasajeroVIP extends Pasajero{

    //Atributos 
    private $nroViajeroFrecuente ; 
    private $cantMillas ; 

    //Constructor 
    public function __construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket, $nroDeFrecuente, $millas)
    {
        parent::__construct($nombre_Pasajero, $apellido_Pasajero, $dni , $numero_tel , $asiento , $ticket);
        $this->nroViajeroFrecuente = $nroDeFrecuente ; 
        $this->cantMillas = $millas;
    }

    //Get
    public function getNroViajeroFrecuente(){
        return $this->nroViajeroFrecuente;
    }
    public function getCantMillas() {
        return $this->cantMillas ; 
    }

    //Set 
    public function setNroViajeroFrecuente($nroDeFrecuente){
        $this->nroViajeroFrecuente = $nroDeFrecuente ;
    }
    public function setCantMillas($millas){
        $this->cantMillas = $millas; 
    }

    //ToString 
    public function __toString()
    {
        $cadena = parent::__toString() ; 
        return $cadena . "Numero de viajero frecuente: " . $this->getNroViajeroFrecuente() . "\n" . 
        "Cantidad de millas: " . $this->getCantMillas() . "\n" ; 
    }

    // se incrementa el importe un 35% y si la cantidad de millas acumuladas supera
    //a las 300 millas se realiza un incremento del 30%.
    public function darPorcentajeIncremento()
    {
        $millas = $this->getCantMillas() ; 
        if ($millas<300){
            $porcentajeIncremento = 35;
        } else {
            $porcentajeIncremento  =30 ;
        }
        return $porcentajeIncremento;
    }


}