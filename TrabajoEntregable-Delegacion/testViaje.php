<?php 

include 'Viaje.php';
include 'Pasajero.php';
include 'ResponsableV.php';

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
    echo "4 - Salir\n";
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
    echo "4 - Datos del responsable del vuelo\n";
    echo "5 - Datos de los pasajeros \n";
    echo "6 - Atras\n" ;
    echo "-----------------------------------\n";
}
function pasajerosMenu () {
    echo "-----------------------------------\n";
    echo " Que desea modificar de los pasajeros? ";
    echo "\n-----------------------------------\n";
    echo "1 - Cambiar los datos de un pasajero\n"  ;
    echo "2 - Agregar un pasajero\n" ; 
    echo "3 - Atras\n";
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
/**$pasajero1 = new Pasajero ("Carlos","Sainz",2345,12335535); 
$pasajero2 = new Pasajero ("Daina","Perez",3452,12323333) ;
$pasajero3 = new Pasajero ("Florencia","Ahumada",43536,97777);
$pasajero4 = new Pasajero ("Yuki","Tsunoda",27829,192228393);
$pasajero5 = new Pasajero ("Alejandra","Zuliani",456392,90027125);
$pasajero6 = new Pasajero ("Fernando","Alonso",342579,778801928);
$coleccionPasajeros = [$pasajero1,$pasajero2,$pasajero3,$pasajero4,$pasajero5,$pasajero6] ;
$responsable = new ResponsableV (8920,667711,"Pedro","Gonzales" );

$viaje2 = new Viaje (1234,"Misiones", 20, $coleccionPasajeros, $responsable );*/


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
                        $viaje2 = new Viaje($codigoViaje,$destinoVuelo,$cantMaxima,$coleccionPasajeros, $responsable);   //creo el objeto principal viaje 
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
                                echo "\nIngrese el nombre del pasajero nro " .$i . " :";
                                $nombrePasajero = trim(fgets(STDIN));
                                echo "Ingrese el apellido: " ;
                                $apellidoPasajero = trim(fgets(STDIN));
                                echo "Ingrese el numero de documento: " ;
                                $numeroDocumento = trim(fgets(STDIN));
                                echo "Ingrese numero de telefono: " ; 
                                $numeroTelefono = trim(fgets(STDIN));
                                $verifica = $viaje2->agregarPasajero($nombrePasajero,$apellidoPasajero,$numeroDocumento,$numeroTelefono);
                                if ($verifica){
                                    echo "Pasajero subido con exito\n"; //la funcion agregarPasajero ya agrega al pasajero, no hace falta repetirlo aca 
                                } else {
                                    echo "Este pasajero ya estaba cargado. Intente nuevamente. \n";      //no incrmeenta i  y asi pido que vuelva a insertar otro pasajero en 
                                    $i = $i - 1 ;                                                       //caso de que se ponga el mismo dni de alguna que ya esta en la lista 
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
                        $valor = $viaje2->cambiarCodigoViaje($nuevoCodigo);
                        if ($valor) {
                            echo "\nDatos cambiados con exito. El nuevo codigo de vuelo es: " . $viaje2->getCodigoViaje() . "\n";
                        } else {
                            echo "El codigo ingresado es el mismo que el anterior.\nInserte un nuevo codigo.\n";
                        }
                        break; 
                    case 2:
                        //modifica destino del vuelo
                        echo "Modifique el destino del vuelo " .$viaje2->getCodigoViaje() ."\n";
                        echo "Ingrese el nuevo destino: " ;
                        $nuevoDestino = trim(fgets(STDIN));
                        $lugar = $viaje2->cambiarDestino($nuevoDestino);
                        if ($lugar){
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
                        $reemplazado = $viaje2->cambiarCantMaxPasajeros($nuevoMaximo);
                        if ($reemplazado) {
                            echo "Cantidad maxima cambiada con exito\n";
                        } else {
                            echo "La cantidad ingresada es igual a la anterior.\nIngrese una nueva cantidad\n";
                        }
                        break;
                    case 4:
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
                    case 5:
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
                                    $esta = $viaje2-> pasajeroEnLaLista($dni); 
                                    if ($esta) {
                                        echo "Pasajero encontrado\nIngrese los nuevos datos\n";
                                        echo "-----------------------------------\n";
                                        echo "Ingrese el nombre del pasajero: " ;
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el apellido del pasajero: ";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el telefono: " ;
                                        $nuevoTelefono = trim(fgets(STDIN));
                                        $pasajeroACambiar = $viaje2->cambiarDatosPasajeros($dni,$nuevoNombre,$nuevoApellido,$nuevoTelefono);
                                        echo "\n-------------------------------------\n";
                                        echo "      Datos cambiados con exito\n";
                                        echo "---------------------------------------\n";
                                        //echo $pasajeroACambiar->__toString();                  Muestra los datos cambiados 
                                    } else {
                                        echo "\n------------------------------------------\n";
                                        echo "Este pasajero no se encuentra en la lista\n";
                                        echo "--------------------------------------------\n";
                                    }
                                    break;
                                case 2: //agrega a un pasajero, verificar si ya se encuentra en la lista
                                    echo "-----------------------------------\n";
                                    echo "      Agregue a un pasajero \n";
                                    echo "-----------------------------------\n";
                                    echo "Ingrese el nombre del pasajero: " ;
                                    $agregarNombre = trim(fgets(STDIN));
                                    echo "Ingrese el apellido del pasajero: ";
                                    $agregarApellido = trim(fgets(STDIN));
                                    echo "Ingrese el Nro de documento: " ;
                                    $agregarDni = trim(fgets(STDIN));
                                    echo "Ingrese el telefono: " ;
                                    $agregarTelefono = trim(fgets(STDIN));
                                    $verPasajero = $viaje2->agregarPasajero($agregarNombre,$agregarApellido,$agregarDni,$agregarTelefono);
                                    if ($verPasajero){
                                        echo "\n-----------------------------------\n";
                                        echo "        Pasajero agregado  \n";
                                        echo "-----------------------------------\n";
                                    } else {
                                        echo "\n------------------------------------------\n";
                                        echo " Este pasajero ya se encontraba en la lista   \n";
                                        echo "--------------------------------------------\n";
                                    }
                                break;    
                            }
                        } while($opPasajero!=3);
                        break;
                }
            } while($op3!=6);
            break;
    }
} while ($opcionPrincipal !=4) ;
    echo "--------------------------------\n"; 
    echo "Gracias por verificar el viaje   " ;
    echo "\n--------------------------------\n"; 