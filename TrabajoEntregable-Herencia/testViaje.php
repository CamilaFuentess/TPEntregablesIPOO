<?php 

include_once 'Pasajero.php' ; 
include_once 'PasajeroVIP.php';
include_once 'PasajeroEspecial.php' ; 
include_once 'PasajeroEstandar.php' ; 
include_once 'ResponsableV.php' ; 
include_once 'Viaje.php';

//FUNCIONES PARA EL MENU 
function menuEntrada (){
    echo "\n------------------------------\n"; 
    echo "   Bienvenido a Viaje Feliz    " ;
    echo "\n------------------------------\n"; 
}

function menuPrincipal(){
    echo "-----------------------------------\n";
    echo "          Que desea hacer?           ";
    echo "\n-----------------------------------\n";
    echo "1 - Cargar los datos del viaje  \n" ; 
    echo "2 - Ver los datos del viaje  \n"; 
    echo "3 - Modificar los datos \n";
    echo "4 - Vender un pasaje \n"; 
    echo "5- Salir\n";
    echo "-----------------------------------\n"; 
}


//Cargar datos del viaje2 
function menuPrincipalOpcion1() {
    echo "-----------------------------------\n";
    echo "          Que desea cargar?           ";
    echo "\n-----------------------------------\n";
    echo "1 - Datos del viaje \n";
    echo "2 - Pasajeros \n" ; 
    echo "3 - Atras \n";
    echo "-----------------------------------\n";
}

//Muestra el tipo de pasajero a cargar cuando se esta cargando el viaje 
function verTipoPasajeroACargar(){
    echo "-----------------------------------\n";
    echo "  Que tipo de pasajero es?           ";
    echo "\n-----------------------------------\n";
    echo "1 - Pasajero VIP \n";
    echo "2 - Pasajero Especial \n" ; 
    echo "3 - Pasajero Estandar \n";
    echo "4 - Atras\n";
    echo "-----------------------------------\n";
}

/**
 * Carga a un pasajero VIP 
 * @param Viaje $objViaje
 */
function cargarPasajeroVIP($objViaje){
    $exito = null; 
    echo "----------------------------\n"; 
    echo "  Pasajero VIP :\n";
    echo "----------------------------\n"; 
    echo "\nIngrese el nombre del pasajero:";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido: " ;
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el numero de documento: " ;
    $numeroDocumento = trim(fgets(STDIN));
    $pasajeroEnLista = $objViaje->pasajeroEnLaLista($numeroDocumento); 
    if ($pasajeroEnLista==null){
        echo "Ingrese numero de telefono: " ; 
        $numeroTelefono = trim(fgets(STDIN));
        echo "Ingrese el numero de asiento: " ; 
        $nroAsiento = trim(fgets(STDIN));
        echo "Ingrese el numero de ticket: " ; 
        $nroTicket = trim(fgets(STDIN));
        echo "Numero de viajero frecuente: " ; 
        $nroViajeroFrecuente = trim(fgets(STDIN));
        echo "Cantidad de millas: " ; 
        $cantMillas = trim(fgets(STDIN));
        $nuevoPasajero = new PasajeroVIP($nombrePasajero,$apellidoPasajero,$numeroDocumento,$numeroTelefono,$nroAsiento,$nroTicket,$nroViajeroFrecuente,$cantMillas);
        //$objViaje->agregarPasajero($nuevoPasajero);
        echo "Pasajero subido con exito\n";
        $exito = $nuevoPasajero;
    }else {          
        echo "Este pasajero ya estaba cargado. Intente nuevamente. \n";   
    }
    return $exito;
}

// Carga a un pasajero con necesidades 
function cargarPasajeroEspecial($objViaje){
    $exito = null;
    echo "-------------------------------------\n"; 
    echo "  Pasajero con necesidades especiales:\n";
    echo "-------------------------------------\n";
    echo "\nIngrese el nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido: " ;
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el numero de documento: " ;
    $numeroDocumento = trim(fgets(STDIN));
    $pasajeroEnLista = $objViaje->pasajeroEnLaLista($numeroDocumento) ; 
    if ($pasajeroEnLista==null){
        echo "Ingrese numero de telefono: " ; 
        $numeroTelefono = trim(fgets(STDIN));
        echo "Ingrese el numero de asiento: " ; 
        $nroAsiento = trim(fgets(STDIN));
        echo "Ingrese el numero de ticket: " ; 
        $nroTicket = trim(fgets(STDIN));
        $necesidadesPasajero = [];
        $nuevoPasajero = new PasajeroEspecial($nombrePasajero,$apellidoPasajero,$numeroDocumento,$numeroTelefono,$nroAsiento,$nroTicket,$necesidadesPasajero);
        $contador = 0; //aux para que no se ingresen mas de tres necesidades 
        do {
            echo "Ingrese una necesidad del pasajero (o fin para terminar): " ; 
            $necesidad = trim(fgets(STDIN));
            $contador++; 
            if ($necesidad != "fin" && $contador<4) {
                $necesidadesPasajero[] = $necesidad ; 
                $nuevoPasajero->setTipoNecesidad($necesidadesPasajero);                                                
            }
        } while($necesidad!="fin");
        //$objViaje->agregarPasajero($nuevoPasajero);
        echo "Pasajero subido con exito\n";
        $exito = $nuevoPasajero; 
    } else {          
        echo "Este pasajero ya estaba cargado. Intente nuevamente. \n";  
    }
    return $exito ;
}

//Carga a un pasajero Estandar 
function cargarPasajeroEstandar($objViaje){
    $exito = null;
    echo "----------------------------\n"; 
    echo "  Pasajero estandar:\n";
    echo "----------------------------\n"; 
    echo "\nIngrese el nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido: " ;
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el numero de documento: " ;
    $numeroDocumento = trim(fgets(STDIN));
    $pasajeroEnLista = $objViaje->pasajeroEnLaLista($numeroDocumento) ;
    if ($pasajeroEnLista==null){
        echo "Ingrese numero de telefono: " ; 
        $numeroTelefono = trim(fgets(STDIN));
        echo "Ingrese el numero de asiento: " ; 
        $nroAsiento = trim(fgets(STDIN));
        echo "Ingrese el numero de ticket: " ; 
        $nroTicket = trim(fgets(STDIN)); 
        $nuevoPasajero = new PasajeroEstandar($nombrePasajero,$apellidoPasajero,$numeroDocumento,$numeroTelefono,$nroAsiento,$nroTicket);
        //$objViaje->agregarPasajero($nuevoPasajero);
        echo "Pasajero subido con exito\n";
        $exito = $nuevoPasajero;
    } else {          
        echo "Este pasajero ya estaba cargado. Intente nuevamente. \n";
    }
    return $exito;
}
//Ver los datos del viaje2 
function menuPrincipalOpcion2(){
    echo "-----------------------------------\n";
    echo "          Que desea ver?           ";
    echo "\n-----------------------------------\n";
    echo "1 - Datos del vuelo \n";
    echo "2 - Pasajeros del vuelo \n" ; 
    echo "3 - Responsable del vuelo \n";
    echo "4 - Todos los datos del viaje \n";
    echo "5 - Atras\n" ;
    echo "-----------------------------------\n";
}

//Modificar los datos del viaje2 
function menuPrincipalOpcion3(){
    echo "-----------------------------------\n";
    echo "         Que desea modificar?           ";
    echo "\n-----------------------------------\n";
    echo "1 - Codigo de vuelo \n";
    echo "2 - Destino del vuelo\n";
    echo "3 - Cantidad maxima de pasajeros\n";
    echo "4 - Costo del vuelo\n";
    echo "5 - Datos del responsable del vuelo\n";
    echo "6 - Datos de los pasajeros \n";
    echo "7 - Atras\n" ;
    echo "-----------------------------------\n";
}
function pasajerosMenu () {
    echo "-----------------------------------\n";
    echo " Que desea modificar de los pasajeros? ";
    echo "\n-----------------------------------\n";
    echo "1 - Cambiar los datos de un pasajero\n"  ;
    echo "2 - Agregar un pasajero\n" ; 
    echo "3 - Eliminar un pasajero\n";
    echo "4 - Atras\n";
    echo "-----------------------------------\n";
}
function responsableVMenu(){
    echo "------------------------------------------------\n";
    echo " Que desea modificar del responsable del vuelo? ";
    echo "\n------------------------------------------------\n";
    echo "1 - Cambiar los datos del responsable\n"  ;
    echo "2 - Cambiar al responsable\n" ; 
    echo "3 - Atras\n";
    echo "-----------------------------------\n";
}

//PROGRAMA PRINCIPAL 

//CREO LAS INSTANCIAS DE LOS OBJETOS EN CASO DE QUE YA HAYA UN VIAJE CARGADO
$coleccionPasajeros = [
    $pasajero1 = new PasajeroVIP("Pepe","Argento",123,123,123,123,123,123),
    $pasajero2 = new PasajeroEspecial("Marcos","Antonio",234,234,234,234,["silla de ruedas","alergia"]),
    $pasajero3 = new PasajeroEstandar("Maria","Carla",345,345,345,345),
    $pasajero4 = new PasajeroEstandar("Flor","Gimenez",456,456,456,456),
] ;
$responsable = new ResponsableV (8920,667711,"Pedro","Gonzales" );
$cantMaxima = 40;
$viaje2 = new Viaje (1234,"Misiones", $cantMaxima, $coleccionPasajeros, $responsable,1230);


//PROGRAMA A MOSTRAR
menuEntrada();
do {
    menuPrincipal(); 
    $opcionPrincipal = trim(fgets(STDIN));
    switch($opcionPrincipal){
        case 1:
            do {
                $coleccionPasajeros = [] ;   // coleccion de objetos pasajero 
                menuPrincipalOpcion1();
                $cargar = trim(fgets(STDIN));
                switch($cargar) {
                    case 1:
                        echo "-----------------------------------\n";
                        echo "          Cargue un viaje \n"; 
                        echo "-----------------------------------\n";
                        echo "Ingrese el codigo de vuelo: ";
                        $codigoViaje = trim(fgets(STDIN)) ; 
                        echo "Ingrese el destino del vuelo: " ; 
                        $destinoVuelo = trim(fgets(STDIN));
                        echo "Cantidad maxima de pasajeros: "; 
                        $cantMaxima = trim(fgets(STDIN));
                        echo "Costo del vuelo: "; 
                        $costo = trim(fgets(STDIN));
                        echo "\n------------------------------------------\n";
                        echo "Cargue los datos del responsable del vuelo\n" ;
                        echo "------------------------------------------\n";
                        echo "Numero de empleado: " ; 
                        $numeroEmpleado = trim(fgets(STDIN));
                        echo "Numero de licencia: " ; 
                        $numeroLicencia = trim(fgets(STDIN)); 
                        echo "Nombre del responsable: " ;
                        $nombreResponsable = trim(fgets(STDIN));
                        echo "Apellido del responsable: " ;
                        $apellidoResponsable = trim(fgets(STDIN));
                        $responsable = new ResponsableV($numeroEmpleado,$numeroLicencia,$nombreResponsable,$apellidoResponsable);
                        echo "-----------------------------------\n";
                        echo "Los datos del viaje ya se cargaron\n";
                        echo "-----------------------------------\n";
                        $viaje2 = new Viaje($codigoViaje,$destinoVuelo,$cantMaxima,$coleccionPasajeros, $responsable,$costo);   //creo el objeto principal viaje 
                        break; 
                    case 2:
                        echo "-----------------------------------\n"; 
                        echo "    Cargue la lista de pasajeros\n";
                        echo "-----------------------------------\n";
                        echo "Cuantos pasajeros va a tener el vuelo? "; 
                        $cantActual = trim(fgets(STDIN));
                        
                        //si el viaje no esta cargado, no me dejara cargar nuevos pasajeros debido a que no hay un maximo inicializado
                        if ($cantActual<=$cantMaxima ){
                            for($i=1;$i<=$cantActual;$i++){
                                verTipoPasajeroACargar() ; 
                                $opPasajeroACargar = trim(fgets(STDIN));
                                switch($opPasajeroACargar) {
                                    case 1: //PASAJERO VIP 
                                        $cargado = cargarPasajeroVIP($viaje2); 
                                        if ($cargado==null){
                                            $i = $i - 1; 
                                        } else {
                                            $viaje2->agregarPasajero($cargado);
                                        }
                                        break;
                                    case 2: //PASAJERO ESPECIAL
                                        $cargado = cargarPasajeroEspecial($viaje2); 
                                        if ($cargado ==null){   
                                            $i = $i - 1 ; 
                                        } else {
                                            $viaje2->agregarPasajero($cargado);
                                        }
                                        break;
                                    case 3: //PASAJERO ESTANDAR
                                        $cargado = cargarPasajeroEstandar($viaje2);
                                        if ($cargado == null){ 
                                            $i = $i - 1; 
                                        }  else {
                                            $viaje2->agregarPasajero($cargado);
                                        }
                                    break;
                                } 
                            }
                        } else {
                            echo "La cantidad de pasajeros excede la cantidad maxima permitida para el vuelo\n";
                        }
                        echo "-----------------------------------\n";
                        break;
                }
            } while($cargar!=3);
            break; 
        case 2:
            do{
                menuPrincipalOpcion2();
                $op2 = trim(fgets(STDIN));
                switch($op2){
                    case 1:
                        //Muestro el codigo, destino y maxPasajeros
                        echo "\n-----------------------------------\n";
                        echo "   Estos son los datos del vuelo: \n";
                        echo "-----------------------------------\n";
                        echo "Codigo del vuelo: ". $viaje2->getCodigoViaje() ."\n" ; 
                        echo "Destino: " . $viaje2->getDestino() . "\n";
                        echo "Cantidad maxima de pasajeros: " . $viaje2->getCantMaxPasajeros() ."\n" ;
                        echo "Costo: " . $viaje2->getCostoViaje() . "\n" ; 
                        echo "-----------------------------------\n";
                        break;
                    case 2:
                        echo "\n-----------------------------------\n";
                        echo "  Lista de los pasajeros del vuelo: \n";
                        echo $viaje2->mostrarListaPasajeros();
                        echo "-----------------------------------\n";
                        break;
                    case 3:
                        echo "\n-----------------------------------\n";
                        echo "   Datos del reponsable del vuelo: \n";
                        echo "\n" .$viaje2->getResponsableV();
                        echo "-----------------------------------\n";
                        break;
                    case 4:
                        echo "\n-----------------------------------\n";
                        echo "   Vea todos los datos del vuelo: \n";
                        echo "\n" . $viaje2->__toString();
                        echo "-----------------------------------\n";
                        break;
                }
            } while($op2 !=5);

            break;
        case 3:
            do {
                menuPrincipalOpcion3();
                $op3 = trim(fgets(STDIN));
                switch($op3){
                    case 1:
                        //modifica codigo de vuelo
                        echo "Modifique el codigo de vuelo \n";
                        echo "Ingrese el nuevo codigo de vuelo: "; 
                        $nuevoCodigo = trim(fgets(STDIN));
                        if ($nuevoCodigo!= $viaje2->getCodigoViaje()){
                            $viaje2->setCodigoViaje($nuevoCodigo);
                            echo "\nDatos cambiados con exito. El nuevo codigo de vuelo es: " . $viaje2->getCodigoViaje() . "\n";
                        }else {
                            echo "El codigo ingresado es el mismo que el anterior.\nInserte un nuevo codigo.\n";
                        }
                        break; 
                    case 2:
                        //modifica destino del vuelo
                        echo "Modifique el destino del vuelo " .$viaje2->getCodigoViaje() ."\n";
                        echo "Ingrese el nuevo destino: " ;
                        $nuevoDestino = trim(fgets(STDIN));
                        if ($nuevoDestino != $viaje2->getDestino()){
                            $viaje2->setDestino($nuevoDestino);
                            echo "\nDatos cambiados con exito. El nuevo destino es: " . $viaje2->getDestino() . "\n";
                        } else {
                            echo "El destino ingresado es igual al anterior.\nInserte un nuevo destino.\n" ;
                        }
                       
                        break;
                    case 3:
                        //modifca cantidad maxima de pasajeros
                        echo "Modifique la cantidad maxima de pasajeros en el vuelo: ".$viaje2->getCodigoViaje() ."\n";
                        echo "Ingrese la nueva cantidad maxima: " ;
                        $nuevoMaximo = trim(fgets(STDIN));
                        if ($nuevoMaximo != $viaje2->getCantMaxPasajeros()) {
                            $viaje2->setCantMaxPasajeros($nuevoMaximo);
                            echo "Cantidad maxima cambiada con exito\n";
                        } else {
                            echo "La cantidad ingresada es igual a la anterior.\nIngrese una nueva cantidad\n";
                        }
                        break;
                    case 4:
                        //modifica el costo del vuelo  
                        echo "Modifique el costo del viaje " . $viaje2->getCodigoViaje() . "\n" ; 
                        echo "Ingrese el nuevo costo: " ;
                        $nuevoCosto =  trim(fgets(STDIN)); 
                        if ($nuevoCosto != $viaje2->getCostoViaje()){
                            $viaje2->setCostoViaje($nuevoCosto) ; 
                            echo "El costo del viaje fue cambiado con exito\n" ;
                        } else {
                            echo "El costo del viaje no pudo ser cambiado.\nRevise nuevamente.\n";
                        }
                        break;
                    case 5:
                        do {
                            responsableVMenu();
                            $opResponsableV = trim(fgets(STDIN));
                            switch($opResponsableV){
                                case 1:
                                    echo "Modifique los datos del responsable del vuelo: " . $viaje2->getCodigoViaje() . "\n";
                                    echo "Tenga en cuenta que solo puede cambiar el nombre, apellido y nro de licencia\n";
                                    echo "Ingrese el numero de empleado: " ;
                                    $comprobarNroE = trim(fgets(STDIN));
                                    $encontrado = $viaje2->responsableEsta($comprobarNroE);
                                    if ($encontrado) {
                                        echo "Cambie el nro de licencia: ";
                                        $cambiarNroLicencia = trim(fgets(STDIN));
                                        echo "Cambie el nombre: ";
                                        $cambiarNombre = trim(fgets(STDIN));
                                        echo "Cambie el apellido: ";
                                        $cambiarApellido = trim(fgets(STDIN));
                                        $viaje2->cambiarDatosResponsable($comprobarNroE,$cambiarNroLicencia,$cambiarNombre,$cambiarApellido);
                                        echo "\n-------------------------------------\n";
                                        echo "  Datos del responsable cambiados \n";
                                        echo "---------------------------------------\n";
                                    } else {
                                        echo "Este empleado no existe o no esta a cargo de este vuelo\n";
                                    }
                                    break;
                                case 2:
                                    echo "Modifique al responsable del vuelo: " . $viaje2->getCodigoViaje() . "\n";
                                    echo "Ingrese el numero de empleado: " ; 
                                    $nroEmpleado = trim(fgets(STDIN));
                                    $noEstaResponsable = $viaje2->responsableEsta($nroEmpleado);
                                    if (!$noEstaResponsable) {
                                        echo "Ingrese el numero de licencia: " ; 
                                        $nroLicencia = trim(fgets(STDIN));
                                        echo "Ingrese el nombre: ";
                                        $nameResponsable = trim(fgets(STDIN));
                                        echo "Ingrese el apellido: " ; 
                                        $lastResponsable = trim(fgets(STDIN));
                                        $viaje2->cambiarResponsableV($nroEmpleado,$nroLicencia,$nameResponsable,$lastResponsable);
                                        echo "\n-------------------------------------\n";
                                        echo "   Responsable cambiado con exito\n";
                                        echo "---------------------------------------\n";
                                        //echo $viaje2->getResponsableV();
                                        echo "\n";
                                    }
                                     else {
                                        echo "\nEl responsable del vuelo no se pudo cambiar.\nEs el mismo nro empleado.\n";
                                    }
                                    break;
                            }
                        } while ($opResponsableV != 3);
                        break;
                    case 6:
                        do {
                            pasajerosMenu();
                            $opPasajero = trim(fgets(STDIN));
                            switch($opPasajero) {
                                case 1: //Modifica los dato de un pasajero en especifico
                                    echo "-----------------------------------\n";
                                    echo "Modifique los datos de un pasajero: \n";
                                    echo "-----------------------------------\n";
                                    echo "Ingrese el Nro de documento del pasajero al que se desea cambiar los datos: " ;
                                    $dni = trim(fgets(STDIN));
                                    $objetoPasajero = $viaje2->pasajeroEnLaLista($dni);       //me devuelve el obj pasajero
                                    if ($objetoPasajero!=null) {
                                        echo "Pasajero encontrado\nIngrese los nuevos datos\n";
                                        echo "-----------------------------------\n";
                                        echo "Ingrese el nombre del pasajero: " ;
                                        $nuevoNombre = trim(fgets(STDIN));
                                        $objetoPasajero->setNombre($nuevoNombre); 
                                        echo "Ingrese el apellido del pasajero: ";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        $objetoPasajero->setApellido($nuevoApellido);  
                                        echo "Ingrese el telefono: " ;
                                        $nuevoTelefono = trim(fgets(STDIN));
                                        $objetoPasajero->setTelefono($nuevoTelefono); 
                                        echo "Ingrese el numero de asiento: " ; 
                                        $numeroAsiento = trim(fgets(STDIN)); 
                                        $objetoPasajero->setNroAsiento($numeroAsiento) ;
                                        echo "Ingrese el numero de ticket: " ;
                                        $numeroTicket = trim(fgets(STDIN)); 
                                        $objetoPasajero->setNroTicket($numeroTicket); 
                                        if ($objetoPasajero instanceof PasajeroVIP) {
                                            echo "Ingrese el numero de viajero frecuente: " ; 
                                            $numeroViajeroFrecuente = trim(fgets(STDIN));
                                            $objetoPasajero->setNroViajeroFrecuente($numeroViajeroFrecuente); 
                                            echo "Ingrese el numero de millas: " ; 
                                            $cantDeMillas = trim(fgets(STDIN));
                                            $objetoPasajero->setCantMillas($cantDeMillas);
                                        } 
                                        if ($objetoPasajero instanceof PasajeroEspecial) {
                                            $contador = 0;
                                            do {
                                                echo "Ingrese las necesidad especiales para el pasajero (n en caso de terminar): " ; 
                                                $necesidadesEsp = trim(fgets(STDIN));
                                                $contador++; 
                                                if ($necesidadesEsp!="n" && $contador<4){
                                                    $nuevoNecesidad[] = $necesidadesEsp;
                                                    $objetoPasajero->setTipoNecesidad($nuevoNecesidad);
                                                }
                                            } while ($necesidadesEsp=="n") ;
                                        } 
                                        echo "\n-------------------------------------\n";
                                        echo "      Datos cambiados con exito\n";
                                        echo "---------------------------------------\n";
                                    } else {
                                        echo "\n------------------------------------------\n";
                                        echo "Este pasajero no se encuentra en la lista\n";
                                        echo "--------------------------------------------\n";
                                    }
                                    break;
                                case 2: 
                                    echo "-----------------------------------\n";
                                    echo "      Agregue a un pasajero \n";
                                    echo "-----------------------------------\n";
                                    $p=0;
                                    do {
                                        verTipoPasajeroACargar() ; 
                                        $eleccion = trim(fgets(STDIN)); 
                                        switch($eleccion){
                                            case 1: //PASAJERO VIP
                                                $objPasajero = cargarPasajeroVIP($viaje2);
                                                if ($objetoPasajero !=null){
                                                    $viaje2->agregarPasajero($objetoPasajero);
                                                }
                                                $p = 1; 
                                                break;
                                            case 2: //PASAJERO ESPECIAL
                                                $objPasajero =  cargarPasajeroEspecial($viaje2);
                                                if ($objetoPasajero !=null){
                                                    $viaje2->agregarPasajero($objetoPasajero);
                                                }
                                                $p=1;
                                                break;
                                            case 3: //PASAJERO ESTANDAR
                                                $objPasajero = cargarPasajeroEstandar($viaje2);
                                                if ($objetoPasajero !=null){
                                                    $viaje2->agregarPasajero($objetoPasajero);
                                                }
                                                $p=1;
                                            break;
                                        }
                                    } while ($p!=1);
                                    break;
                                case 3: 
                                    echo "-----------------------------------\n";
                                    echo "      Elimine a un pasajero \n";
                                    echo "-----------------------------------\n";
                                    echo "Ingrese el numero de documento: "; 
                                    $nroDocEliminar = trim(fgets(STDIN)); 
                                    $sePudo = $viaje2->eliminarPasajero($nroDocEliminar);
                                    if ($sePudo){
                                        echo "\nPasajero eliminado\n" ; 
                                    } else {
                                        echo "\nEl pasajero NO pudo ser eliminado.\nRevise el numero de documento.\n";
                                    }
                                    break;
                            }
                        } while($opPasajero!=4);
                        break;
                }
            } while($op3!=7);
            break;
        case 4: 
            if ($viaje2==null){
                echo "---------------------------------\n";
                echo "     Primero cargue un viaje \n";
                echo "---------------------------------\n";
            } else {
                echo "---------------------------------\n";
                echo "     Vender un pasaje \n";
                echo "---------------------------------\n";
                echo "Ingrese los datos del nuevo pasajero\n"; 
                verTipoPasajeroACargar(); 
                $opcion = trim(fgets(STDIN)); 
                switch ($opcion){
                    case 1:  //PASAJERO VIP
                        $pasajeroNuevo = cargarPasajeroVIP($viaje2);
                        break;
                    case 2: //PASAJERO ESPECIAL
                        $pasajeroNuevo =cargarPasajeroEspecial($viaje2);
                        break;
                    case 3: //PASAJERO ESTANDAR
                        $pasajeroNuevo= cargarPasajeroEstandar($viaje2);
                    break;
                }
                if ($pasajeroNuevo!=null){   //compruebo que se haya creado el obj pasajero
                    $costoAPagar = $viaje2->venderPasaje($pasajeroNuevo); 
                    if ($costoAPagar>1){
                        echo "El total a pagar es: " . $costoAPagar ."\n";
                        //echo $viaje2->getSumaCostos() ;
                    } 
                }else {
                    echo "No se pudo realizar la venta\n";
                }
                
            }
            break;
            
    }
} while ($opcionPrincipal !=5) ;
    echo "--------------------------------\n"; 
    echo "Gracias por verificar el viaje   " ;
    echo "\n--------------------------------\n"; 