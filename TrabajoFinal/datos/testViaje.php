<?php 

//PROBELMAS CON '../datos/BaseDatos.php 
//Si el test se encuentra en la carpeta test no me toma ningunca clase de la carpeta datos
//Mofiqui el php.ini, probe de todo pero no me tomaba nada por esa razon el test se encuentra 
// en datos 
include_once 'BaseDatos.php';
include_once 'Persona.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';
include_once 'Empresa.php';

//FUNCIONES DE MENU 
function menuPrincipal(){
    echo "*****************************************\n";
    echo "***         Que desea hacer?          ***\n";
    echo "*****************************************\n";
    echo "*** 1- Agregar                        ***\n";
    echo "*** 2- Modificar                      ***\n";
    echo "*** 3- Eliminar                       ***\n";
    echo "*** 4- Listar                         ***\n";                                                                                                                               //ELIMINAR 
    echo "*** 5- Salir                          ***\n";
    echo "*****************************************\n";
}

function menuAgregar(){
    echo "*****************************************\n";
    echo "***         Que desea agregar?        ***\n";
    echo "*****************************************\n";
    echo "*** 1- Agregar Empresa                ***\n";
    echo "*** 2- Agregar Viaje                  ***\n";
    echo "*** 3- Agregar Responsables           ***\n";
    echo "*** 4- Agregar Pasajeros              ***\n";
    echo "*** 5- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuModificar(){
    echo "*****************************************\n";
    echo "***        Que desea modificar?       ***\n";
    echo "*****************************************\n";
    echo "*** 1- Modificar Empresa              ***\n";
    echo "*** 2- Modificar un Viaje             ***\n";
    echo "*** 3- Modificar un Responsable       ***\n";
    echo "*** 4- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuModificarEmpresa(){
    echo "*****************************************\n";
    echo "***  Que desea modificar de Empresa?  ***\n";
    echo "*****************************************\n";
    echo "*** 1- Modificar Nombre               ***\n";
    echo "*** 2- Modificar Direccion            ***\n";
    echo "*** 3- Atras                          ***\n"; 
    echo "*****************************************\n";
}

function menuModificarResponsable(){
    echo "*****************************************\n";
    echo "***Que desea modificar de Responsable?***\n";
    echo "*****************************************\n";
    echo "*** 1- Modificar Nombre               ***\n";
    echo "*** 2- Modificar Apellido             ***\n";
    echo "*** 3- Modificar Telefono             ***\n";
    echo "*** 4- Modificar Numero de licencia   ***\n";
    echo "*** 5- Salir                          ***\n";
    echo "*****************************************\n";
}

function menuModificarViaje(){
    echo "*****************************************\n";
    echo "***   Que desea modificar de viaje?   ***\n";
    echo "*****************************************\n";
    echo "*** 1- Modificar destino              ***\n";
    echo "*** 2- Modificar cant de pasajeros    ***\n";
    echo "*** 3- Modificar importe              ***\n";
    echo "*** 4- Modificar a un pasajero        ***\n";
    echo "*** 5- Cambiar al Responsable         ***\n";
    echo "*** 6- Cambiar de Empresa             ***\n";
    echo "*** 7- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuModificarPasajero(){
    echo "*****************************************\n";
    echo "**  Que desea modificar del pasajero?  **\n";
    echo "*****************************************\n";
    echo "*** 1- Modificar Nombre               ***\n";
    echo "*** 2- Modificar Apellido             ***\n";
    echo "*** 3- Modificar Telefono             ***\n";
    echo "*** 4- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuEliminar(){
    echo "*****************************************\n";
    echo "***        Que desea eliminar?        ***\n";
    echo "*****************************************\n";
    echo "*** 1- Eliminar Empresa               ***\n";
    echo "*** 2- Eliminar un Viaje              ***\n";
    echo "*** 3- Eliminar un Responsable        ***\n";
    echo "*** 4- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuEliminarViaje(){
    echo "*****************************************\n";
    echo "***   Que desea eliminar del Viaje?   ***\n";
    echo "*****************************************\n";
    echo "*** 1- Eliminar a un pasajero         ***\n";
    echo "*** 2- Eliminar todo el viaje         ***\n";
    echo "*** 3- Atras                          ***\n";
    echo "*****************************************\n";
}

function menuListar(){
    echo "*****************************************\n";
    echo "***         Que desea listar?         ***\n";
    echo "*****************************************\n";
    echo "*** 1- Listar Empresa                 ***\n";
    echo "*** 2- Listar Viaje                   ***\n";
    echo "*** 3- Listar Responsables            ***\n";
    echo "*** 4- Listar Pasajeros               ***\n";
    echo "*** 5- Atras                          ***\n";
    echo "*****************************************\n";
}



//FUNCIONES DE AGREGAR 
// entra por parametro el objViaje asi accedemos al id 
function agregarPasajero($idViaje){
    echo "*****************************************\n";
    echo "***        Agregue a un Pasajero      ***\n";
    echo "*****************************************\n";
    echo "Ingrese el nombre: " ; 
    $nombrePas = trim(fgets(STDIN));
    echo "Ingrese el apellido: "; 
    $apellidoPas = trim(fgets(STDIN));
    echo "Ingrese el numero de documento: ";
    $docPas = trim(fgets(STDIN));
    echo "Ingrese el numero de telefono: " ; 
    $telefonoPas = trim(fgets(STDIN));
    
    $pasajeroNuevo = new Pasajero();
    $pasajeroNuevo->cargar($docPas,$nombrePas,$apellidoPas,$telefonoPas,0,$idViaje);
    return $pasajeroNuevo;
}

//FUNCIONES QUE MUESTRAN EL LISTAR
//creadas debido a que es utilizada en muchas partes del test y para no andar repitiendo el codigo
function mostrarEmpresas(){
    $colEmpresas = Empresa::listar();
    $aux = null;
    if (count($colEmpresas)>0){
        foreach($colEmpresas as $unaEmp){
            echo "*****************************************\n";
            echo $unaEmp ; 
            echo "*****************************************\n";
        }
        $aux = new Empresa;
    } else {
        echo "NO HAY EMPRESAS EN LA BD. AGREGUE PARA VERLAS\n";
    }
    return $aux;
}

function mostrarResponsables(){
    $responsables= new ResponsableV(); 
    $colResponsables = $responsables->listar();
    $aux = null; 
    if(count($colResponsables)>0){
        foreach($colResponsables as $unRes){
            echo "*****************************************\n";
            echo $unRes ; 
            echo "*****************************************\n";
        }
        $aux = $responsables;
    } else {
        echo "NO HAY RESPONSABLES EN LA BD. AGREGUE PARA VERLOS.\n";
    }
    return $aux;
}

function mostrarViajes(){
    $viajes = new Viaje();
    $colViajes = $viajes->listar(); 
    $aux = null; 
    if(count($colViajes)>0){
        foreach($colViajes as $unViaje){
            echo "*****************************************\n";
            echo $unViaje ; 
            echo "*****************************************\n";
        }
        $aux = $viajes;
    } else {
        echo "NO HAY VIAJES CARGADOS. AGREGUE PARA VERLOS.\n";
    }
    return $aux;
}

function mostrarPasajeros($idViaje){
    $pasajero = new Pasajero(); //creo un pas para usar el listar
    $colPasajeros = $pasajero->listar('idviaje='.$idViaje);
    $aux=null;
    if (count($colPasajeros)>0){
        foreach($colPasajeros as $unPas){
            echo "*****************************************\n";
            echo $unPas ; 
            echo "*****************************************\n"; 
            $aux = $pasajero; 
        }
    } else {
        echo "NO HAY PASAJEROS\n";
    }
    return $aux;
}
//TEST VIAJE 
echo "*****************************************\n";
echo "***            BIENVENIDOS            ***\n";
echo "*****************************************\n";


do {
    menuPrincipal(); 
    $opMenuPrincipal = trim(fgets(STDIN));
    switch($opMenuPrincipal){
        case 1:          //AGREGAR
            do {
                menuAgregar();
                $opMenuAgregar = trim(fgets(STDIN));
                switch($opMenuAgregar){
                    case 1: //agrega empresa
                        echo "*****************************************\n";
                        echo "***        Agregue una Empresa        ***\n";
                        echo "*****************************************\n";
                        echo "Ingrese el nombre: " ; 
                        $nombreEmpresa = trim(fgets(STDIN));
                        echo "Ingrese la direccion: "; 
                        $direccionEmpresa = trim(fgets(STDIN));
                        $empresaNueva = new Empresa();
                        $empresaNueva->cargar(0,$nombreEmpresa,$direccionEmpresa);
                        
                        $resp = $empresaNueva->insertar(); 
                        if($resp){
                            echo "*****************************************\n";
                            echo "***      Empresa agregada a la BD     ***\n";
                            echo "*****************************************\n";
                        } else {
                            echo $empresaNueva->getMensajeOperacion();
                        }
                        break; 
                    case 2:  //agrega un viaje a la bd de la empresa 
                        echo "*****************************************\n";
                        echo "***          Agregue un Viaje         ***\n";
                        echo "*****************************************\n";
                        $viajeNuevo =null;
                        echo "Ingrese el destino: "; 
                        $destinoV = trim(fgets(STDIN));
                        echo "Ingrese la cant max de pasajeros: " ; 
                        $maxPasajerosV = trim(fgets(STDIN));
                        echo "Ingrese el importe: " ; 
                        $importeV = trim(fgets(STDIN));

                        echo "Conoce el ID de la empresa a la cual agregar el viaje?: ";
                        $idEmpresa = trim(fgets(STDIN));
                        if ($idEmpresa=="n" || $idEmpresa=="N" || $idEmpresa=="no" || $idEmpresa=="NO"){
                            echo "*****************************************\n";
                            echo "***   MIRE LAS EMPRESAS DISPONIBLES:  ***\n";
                            $funEmpresa = mostrarEmpresas(); 
                        }else {
                            $funEmpresa = new Empresa();
                        }
                        echo "Ingrese el id de la empresa a la que pertenece el viaje: "; 
                        $idEmpresa = trim(fgets(STDIN));
                        if ($funEmpresa!=null && $funEmpresa->Buscar($idEmpresa)){
                            $colEmpresas = $funEmpresa->listar();
                            foreach($colEmpresas as $unEM){
                                if ($unEM->getIdEmpresa() == $idEmpresa){
                                    $funEmpresaId = $unEM->getIdEmpresa();
                                }
                            }
                            echo "Conoce el Nro del empleado a cargo?: ";
                            $nroEmplead = trim(fgets(STDIN));
                            if ($nroEmplead =="n"|| $nroEmplead=="N" || $nroEmplead=="no" || $nroEmplead=="NO"){
                                echo "*****************************************\n";
                                echo "*** MIRE LOS RESPONSABLES DISPONIBLES:***\n"; 
                                $funResponsables = mostrarResponsables();
                            } else {
                                $funResponsables = new ResponsableV();
                            }
                            
                            if ($funResponsables!=null){
                                echo "Ingrese el Nro de Empleado: "; 
                                $nroEmplead = trim(fgets(STDIN));
                                if ( $funResponsables->Buscar($nroEmplead)){
                                    $viajeNuevo = new Viaje();
                                    $viajeNuevo->cargar(0,$destinoV,$maxPasajerosV,$funEmpresaId,$nroEmplead,/*[]*/$importeV);
                                    //$viajeNuevo->setObjResponsable($nroEmplead);
                                } else {
                                    echo "*****************************************\n";
                                    echo "***     Responsable NO encontrado     ***\n";
                                    echo "*****************************************\n";
                                }
                                
                            } 
                        }
                        if ($viajeNuevo!=null){
                            $resp = $viajeNuevo->insertar();
                            if ($resp){
                                echo "*****************************************\n";
                                echo "***       Viaje agregado a la BD      ***\n";
                                echo "*****************************************\n";
                            } else {
                                echo $viajeNuevo->getMensajeOperacion(); 
                            }
                        } else {
                            echo "*****************************************\n"; 
                            echo "***  FALTAN DATOS IMPRECINDIBLES PARA ***\n";
                            echo "***   CREAR UN VIAJE REVISE DE TENER  ***\n";
                            echo "***  RESPONSABLES Y EMPRESAS EN LA BD ***\n";
                            echo "*****************************************\n"; 
                        }
                        break;
                    case 3:    //agrega responsables
                        echo "*****************************************\n";
                        echo "***      Agregue a un Responsable     ***\n";
                        echo "*****************************************\n";
                        echo "Ingrese el nombre: " ; 
                        $nombreRV = trim(fgets(STDIN));
                        echo "Ingrese el apellido: "; 
                        $apellidoRV = trim(fgets(STDIN));
                        echo "Ingrese el numero de documento: ";
                        $docRV = trim(fgets(STDIN));
                        $auxPersona = new Persona();
                        if (!$auxPersona->Buscar($docRV)){
                            echo "Ingrese el numero de telefono: " ; 
                            $telefonoRV = trim(fgets(STDIN));
                            echo "Ingrese el numero de licencia: " ; 
                            $nroLicecia = trim(fgets(STDIN));
                            $responsableNuevo = new ResponsableV();
                            $responsableNuevo->cargar($docRV,$nombreRV,$apellidoRV,$telefonoRV,0,$nroLicecia);
                            $resp = $responsableNuevo->insertar();
                            if ($resp){
                                echo "*****************************************\n";
                                echo "***    Responsable agregado a la BD   ***\n";
                                echo "*****************************************\n";
                            } else {
                                echo $responsableNuevo->getMensajeOperacion(); 
                            }
                        } else {
                            echo "*****************************************\n";
                            echo "***ESTE DNI LE PERTENECE A ALGUIEN MAS***\n";
                            echo "*****************************************\n";
                        }
                        
                        break;
                    case 4:  //agrega pasajeros 
                        echo "Conoce el ID del viaje a agregar pasajeros?: ";
                        $op = trim(fgets(STDIN));
                        if ($op == "n" || $op=="N" || $op=="NO" || $op=="no"){
                            echo "*****************************************\n";
                            echo "REVISE LA LISTA DE VIAJES Y ELIJA EN CUAL AGREGAR PASAJEROS\n";
                            $aviaje = mostrarViajes(); 
                        } else {
                            $aviaje = new Viaje();
                        }
                        if ($aviaje!=null){
                            echo "Ingrese el id del viaje para agregar pasajeros: ";
                            $op = trim(fgets(STDIN));
                            $estaV = $aviaje->Buscar($op);
                            if ($estaV){
                                //controlo que la cantidad a agregar no sea mayor a la max del viaje 
                                $cantMaxima = $aviaje->getCantMaxPasajeros();
                                $auxPasajero = new Pasajero();
                                $auxColPasajeros = $auxPasajero->listar("idviaje=".$aviaje->getIdViaje());
                                $disponibles = $cantMaxima - (count($auxColPasajeros));
                                if (count($auxColPasajeros)==$cantMaxima){
                                    echo "NO SE PUEDEN AGREGAR MAS PASAJEROS A ESTE VIAJE\n";
                                } else {
                                    echo "Cuantos pasajeros desea agregar al viaje?: " ;
                                    $cantAgregar = trim(fgets(STDIN));
                                    if ($cantAgregar<=$disponibles){
                                        for ($i=0;$i<$cantAgregar;$i++){
                                            $pasajeroNuevo = agregarPasajero($op); 
                                            $resp = $pasajeroNuevo->insertar(); 
                                            if ($resp){
                                                $colPasajeros = $aviaje->getColPasajeros();
                                                if (!is_array($colPasajeros)){
                                                    $colPasajeros = [];
                                                }
                                                $colPasajeros[] = $pasajeroNuevo;
                                                $aviaje->setColPasajeros($colPasajeros);
                                                echo "*****************************************\n";
                                                echo "***     Pasajero agregado a la BD     ***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $pasajeroNuevo->getMensajeOperacion(); 
                                            }
                                        }
                                    } else {
                                        echo "*****************************************\n"; 
                                        echo "***     CAPACIDAD MAXIMA SUPERADA     ***\n";
                                        echo "*****************************************\n"; 
                                    }
                                }
                            } else {
                                echo "*****************************************\n"; 
                                echo "***  NO SE PUEDEN AGREGAR PASAJERO A  ***\n";
                                echo "***       UN VIAJE QUE NO EXISTE      ***\n";
                                echo "*****************************************\n"; 
                            }
                        }
                        break;
                }
            } while ($opMenuAgregar!=5);
            break;
        case 2:         //MODIFICAR
            do {
                menuModificar(); 
                $opMenuModificar = trim(fgets(STDIN));
                switch($opMenuModificar){
                    case 1: //modifica a la empresa 
                        echo "Conoce el ID de la Empresa a modificar(si/no): " ; 
                        $opME = trim(fgets(STDIN));
                        if ($opME=="no" || $opME=="NO" || $opME=="N" || $opME=="n"){
                            echo "VEA EL LISTADO DE LAS EMPRESAS";
                            $empresaModificar = mostrarEmpresas();
                        } else {
                            $empresaModificar = new Empresa();
                        }
                        echo "Ingrese el ID de la Empresa a modificar?: "; 
                        $idEmpModificar = trim(fgets(STDIN));
                        if($empresaModificar->Buscar($idEmpModificar)){
                            do {
                                menuModificarEmpresa(); 
                                $opMMEmpresa = trim(fgets(STDIN));
                                switch($opMMEmpresa){
                                    case 1:
                                        echo "Ingrese el nuevo nombre de la empresa: "; 
                                        $nuevoNombreEmp = trim(fgets(STDIN));
                                        $empresaModificar->setNombre($nuevoNombreEmp);
                                        if($empresaModificar->modificar()){
                                            echo "*****************************************\n";
                                            echo "***           CAMBIO EXITOSO          ***\n";
                                            echo "*****************************************\n";
                                        } else {
                                            echo $empresaModificar->getMensajeOperacion();
                                        }
                                        break;
                                    case 2:
                                        echo "Ingrese la nueva direccion de la empresa: " ; 
                                        $nuevaDireccion = trim(fgets(STDIN));
                                        $empresaModificar->setDireccion($nuevaDireccion);
                                        if($empresaModificar->modificar()){
                                            echo "***CAMBIO EXITOSO***";
                                        } else {
                                            echo $empresaModificar->getMensajeOperacion();
                                        }
                                        break; 
                                }
                            } while($opMMEmpresa!=3);
                        }
                        //muestro las empresas y solicito el id de la empresa a amodificar
                        break; 
                    case 2:   //modifica un viaje de la empresa 
                        echo "CONOCE EL ID DEL VIAJE A MODIFICAR?: "; 
                        $opId = trim(fgets(STDIN));
                        if ($opId=="n" || $opId=="N" || $opId=="NO" || $opId=="no"){
                            echo "AQUI ESTA LA LISTA DE VIAJES\n";
                           $viajeModi =  mostrarViajes();
                        } else {
                            $viajeModi = new Viaje();
                        }
                        if ($viajeModi!=null ){
                            echo "Ingrese el ID del viaje a modificar: "; 
                            $idViajeM = trim(fgets(STDIN));
                            
                            if ($viajeModi->Buscar($idViajeM)){
                                do {
                                    
                            
                            //echo $viajeModi;
                                    menuModificarViaje(); 
                                    $opModificarViaje = trim(fgets(STDIN));
                                    switch($opModificarViaje){
                                        case 1: //destino
                                            echo "Ingrese el nuevo destino: "; 
                                            $nuevoDestino = trim(fgets(STDIN));
                                            $viajeModi->setDestino($nuevoDestino);
                                            if($viajeModi->modificar()){
                                                echo "*****************************************\n";
                                                echo "***     DESTINO CAMBIADO CON EXITO    ***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $viajeModi->getMensajeOperacion();
                                            }
                                            break; 
                                        case 2: //cant pasajeros
                                            echo "Ingrese la nueva capacidad de pasajeros: "; 
                                            $nuevaCapacidad = trim(fgets(STDIN));
                                            $viajeModi->setCantMaxasajeros($nuevaCapacidad);
                                            if($viajeModi->modificar()){
                                                echo "*****************************************\n";
                                                echo "***CAPACIDAD MAXIMA CAMBIADA CON EXITO***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $viajeModi->getMensajeOperacion();
                                            }
                                            break; 
                                        case 3: //importe
                                            echo "Ingrese el nuevo importe: "; 
                                            $nuevoImporte = trim(fgets(STDIN));
                                            $viajeModi->setImporte($nuevoImporte);
                                            if($viajeModi->modificar()){
                                                echo "*****************************************\n";
                                                echo "***     IMPORTE CAMBIADO CON EXITO    ***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $viajeModi->getMensajeOperacion();
                                            }
                                            break;
                                        case 4:  //un pasajero 
                                            echo "Conoce el DNI del pasajero a modificar?: ";
                                            $dniMod = trim(fgets(STDIN));
                                            if ($dniMod=="NO" || $dniMod=="no" || $dniMod=="n" || $dniMod=="N"){
                                                echo "*****************************************\n";
                                                echo "VEA LA LISTA DE PASAJEROS DEL VIAJE\n";
                                                $lisPas = mostrarPasajeros($idViajeM);
                                            } else {
                                                $listPas = new Pasajero();
                                            }
                                            echo "Ingrese el DNI del pasajero: "; 
                                            $dniMod = trim(fgets(STDIN));
                                            if ($lisPas->Buscar($dniMod)){
                                                do {
                                                    menuModificarPasajero();
                                                    $opModPas = trim(fgets(STDIN));
                                                    switch($opModPas){
                                                        case 1:
                                                            echo "Ingrese el nuevo nombre: "; 
                                                            $nuevoNombrePas = trim(fgets(STDIN));
                                                            $lisPas->setNombre($nuevoNombrePas);
                                                            if($lisPas->modificar()){
                                                                echo "*****************************************\n";
                                                                echo "***           CAMBIO EXITOSO          ***\n";
                                                                echo "*****************************************\n";
                                                            } else {
                                                                echo $lisPas->getMensajeOperacion();
                                                            }
                                                            break; 
                                                        case 2: 
                                                            echo "Ingrese el nuevo apellido: " ; 
                                                            $nuevoApellidoPas = trim(fgets(STDIN));
                                                            $lisPas->setApellido($nuevoApellidoPas);
                                                            if($lisPas->modificar()){
                                                                echo "*****************************************\n";
                                                                echo "***           CAMBIO EXITOSO          ***\n";
                                                                echo "*****************************************\n";
                                                            } else {
                                                                echo $lisPas->getMensajeOperacion();
                                                            }
                                                            break; 
                                                        case 3:
                                                            echo "Ingrese el nuevo numero de telefono: "; 
                                                            $nuevoTelefonoPas = trim(fgets(STDIN));
                                                            $lisPas->setTelefono($nuevoTelefonoPas); 
                                                            if($lisPas->modificar()){
                                                                echo "*****************************************\n";
                                                                echo "***           CAMBIO EXITOSO          ***\n";
                                                                echo "*****************************************\n";
                                                            } else {
                                                                echo $lisPas->getMensajeOperacion(); 
                                                            }
                                                            break; 
                                                    }
                                                } while($opModPas!=4);
                                            } else {
                                                echo "PASAJERO NO ENCONTRADO";
                                                //$lisPas->getMensajeOperacion();
                                            }
                                            break;
                                        case 5:    //responsable 
                                            
                                            echo "Conoce el Numero de empleado del nuevo responsable?: ";
                                            $dniRes = trim(fgets(STDIN));
                                            if ($dniRes=="n" || $dniRes=="N" || $dniRes=="no" || $dniRes=="NO"){
                                                echo "MIRE EL LISTADO DE RESPONSABLES DISPONIBLES: \n";
                                                $resEta = mostrarResponsables();
                                            } else{
                                                $resEta = new ResponsableV();
                                            }
                                            //busco si existe el res 
                                                echo "Ingrese el nuevo numero de empleado: ";
                                                $dniRes = trim(fgets(STDIN));
                                            if (($resEta->Buscar($dniRes))){
                                                $viajeModi->setObjResponsable($resEta);
                                                $viajeModi->modificar(); 
                                                echo "*****************************************\n";
                                                echo "***  RESPONSABLE MODIFICADO CON EXITO ***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $viajeModi->getMensajeOperacion();
                                            }
                                            break; 
                                        case 6:     //rempresa
                                            echo "Ingrese el ID de la nueva empresa: "; 
                                            $nuevaIdEM = trim(fgets(STDIN));
                                            $objEMpresa = $viajeModi->getEmpresa();
                                            $empresaM = new Empresa();
                                            if($objEMpresa!=$nuevaIdEM && ($empresaM->Buscar($nuevaIdEM))){
                                                $viajeModi->setEmpresa($empresaM);
                                                if ($viajeModi->modificar()){
                                                    echo "*****************************************\n";
                                                    echo "***    EMPRESA DEL VIAJE MODIFICADA   ***\n";
                                                    echo "*****************************************\n";
                                                } else {
                                                    echo $viajeModi->getMensajeOperacion();
                                                }
                                            } else {
                                                echo $viajeModi->getMensajeOperacion();
                                            }
                                            break; 
                                    }
                                } while($opModificarViaje!=7);
                            }
                        }
                        break; 
                    case 3:   //modifica al responsable 
                        echo "Conoce el Nro de empleado del Responsable a modificar?(si/no): "; 
                        $conoce = trim(fgets(STDIN));
                        if ($conoce == "no" || $conoce=="NO" || $conoce=="n" || $conoce=="N"){
                            echo "*****************************************\n";
                            echo "Elija a que Responsable Modificar.\n"; 
                            $objResponsable = mostrarResponsables();
                        } else {
                            $objResponsable = new ResponsableV();
                        }
                        echo "Tenga en cuenta que NO puede cambiar el documento y el numero de empleado\n";
                        echo "Ingrese el Nro de empleado del responsable a modificar: ";
                        $nrDni = trim(fgets(STDIN));              //nro empleado no dni 
                        if($objResponsable->Buscar($nrDni)){
                            do {
                                menuModificarResponsable(); 
                                $opModificarRes = trim(fgets(STDIN)); 
                                switch($opModificarRes){
                                    case 1: 
                                        echo "Ingrese el nuevo nombre: ";
                                        $nuevoNombreRes = trim(fgets(STDIN));
                                        $objResponsable->setNombre($nuevoNombreRes);
                                        if($objResponsable->modificar()){
                                            echo "*****************************************\n";
                                            echo "***           CAMBIO EXITOSO          ***\n";
                                            echo "*****************************************\n";
                                        } else {
                                            echo $objResponsable->getMensajeOperacion();
                                        }
                                        break; 
                                    case 2: 
                                        echo "Ingrese el nuevo apellido: "; 
                                        $nuevoApellidoRes = trim(fgets(STDIN));
                                        $objResponsable->setApellido($nuevoApellidoRes);
                                        if($objResponsable->modificar()){
                                            echo "*****************************************\n";
                                            echo "***           CAMBIO EXITOSO          ***\n";
                                            echo "*****************************************\n";
                                        } else {
                                            echo $objResponsable->getMensajeOperacion();
                                        }
                                        break; 
                                    case 3: 
                                        echo "Ingrese el nuevo telefono: "; 
                                        $nuevoTelefono = trim(fgets(STDIN));
                                        $objResponsable->setTelefono($nuevoTelefono);
                                        if($objResponsable->modificar()){
                                            echo "*****************************************\n";
                                            echo "***           CAMBIO EXITOSO          ***\n";
                                            echo "*****************************************\n";
                                        } else {
                                            echo $objResponsable->getMensajeOperacion();
                                        }
                                        break; 
                                    case 4:
                                        echo "Ingrese el nuevo numero de licencia: "; 
                                        $nuevoNrLicencia = trim(fgets(STDIN));
                                        if ($objResponsable->getNroLicencia()!=$nuevoNrLicencia){
                                            $objResponsable->setNroLicencia($nuevoNrLicencia);
                                            if($objResponsable->modificar()){
                                                echo "*****************************************\n";
                                                echo "***           CAMBIO EXITOSO          ***\n";
                                                echo "*****************************************\n";
                                            } else {
                                                echo $objResponsable->getMensajeOperacion();
                                            }
                                        } else {
                                            echo "*****************************************\n";
                                            echo "NO SE PUDO CAMBIAR. YA TIENE ESE NRO DE LICENCIA\n";
                                        }
                                        
                                        break; 
                                }
                            } while($opModificarRes!=5);
                        } else {
                            echo "*****************************************\n";
                            echo "***     Responsable NO encontrado     ***\n";
                            echo "*****************************************\n";
                        }
                        break;
                }
            } while ($opMenuModificar!=4);
            break;
        case 3:         //ELIMINAR 
            do {
                menuEliminar(); 
                $opMenuEliminar = trim(fgets(STDIN));
                switch($opMenuEliminar){
                    case 1: //elimina empresa 
                        echo "Conoce el ID de la empresa a eliminar? (si/no): " ;
                        $opSN = trim(fgets(STDIN)); 
                        if ($opSN=="no" || $opSN=="n" || $opSN=="NO" || $opSN=="N"){
                            echo "*****************************************\n";
                            echo "***    Vea las Empresas Disponibles   ***\n";
                            echo "***           para Eliminar           ***\n";
                            echo "*****************************************\n";
                            $empresa= mostrarEmpresas();
                        } else {
                            $empresa = new Empresa();
                        }
                        if ($empresa!=null){
                            echo "Ingrese el ID de la empresa a eliminar: "; 
                            $idEmpEliminar = trim(fgets(STDIN));
                            if ($empresa->Buscar($idEmpEliminar)){
                               
                                //verifico si tiene viajes 
                                $eliminarViajes = new Viaje();
                                $listaViajes = $eliminarViajes->listar("idempresa=" . $idEmpEliminar);
                                
                                if (count($listaViajes)>0){
                                    echo "LA EMPRESA TIENE VIAJES. DESEA ELIMINARLOS?(si/no): ";
                                    $opS = trim(fgets(STDIN));
                                    if ($opS=="si" || $opS=="SI" || $opS=="s" || $opS=="S"){
                                        foreach($listaViajes as $unVE ){
                                            //$listaPas = $unVE->getColPasajeros();;
                                            $auxResp = new ResponsableV ; 
                                            $auxPas = new Pasajero();
                                            $listaPasajeros = $auxPas->listar("idviaje=".$unVE->getIdViaje());
                                            if (count($listaPasajeros)>0){
                                                echo "ESTE VIAJE TIENE PASAJEROS. DESEA ELIMINARLOS? (si/no): ";
                                                $seguro = trim(fgets(STDIN));
                                                if ($seguro=="si" || $seguro=="SI" || $seguro=="s" || $seguro=="S"){
                                                    foreach($listaPasajeros as $unP){
                                                        $res = $unP->eliminar();
                                                        if (!$res){
                                                            echo $unP->getMensajeOperacion();
                                                        }
                                                    }  
                                                    $auxRes = $unVE->getObjResponsable(); 
                                                    $auxRes->eliminar();
                                                    $res2 = $unVE->eliminar();
                                                    if (!$res2){
                                                        echo $unVE->getMensajeOperacion();
                                                    }
                                                }
                                            } elseif(count($listaPasajeros)==0){
                                                $auxRes = $unVE->getObjResponsable(); 
                                                $auxRes->eliminar();
                                                $res2 = $unVE->eliminar();
                                                if(!$res2){
                                                    echo $unVE->getMensajeOperacion();
                                                }
                                            } else {
                                                echo $unVE->getMensajeOperacion();
                                            }
                                        }
                                        $res3 = $empresa->eliminar(); 
                                        if ($res3){
                                            echo "*****************************************\n";
                                            echo "***    Empresa Eliminada con Exito    ***\n";
                                            echo "*****************************************\n";
                                        } else {
                                            echo "*****************************************\n";
                                            echo "NO SE PUDO ELIMINAR LA EMPRESA"; 
                                            echo $empresa->getMensajeOperacion();
                                        }
                                    }
                                   
                                } else {
                                    $log = $empresa->eliminar();
                                    if ($log){
                                        echo "*****************************************\n";
                                        echo "***    Empresa Eliminada con Exito    ***\n";
                                        echo "*****************************************\n";
                                    } else {
                                        echo $empresa->getMensajeOperacion();
                                    }
                                }
                            } else  {
                                
                                echo "*****************************************\n";
                                echo "***       Empresa NO encontrada       ***\n";
                                echo "*****************************************\n";
                            }
                        }
                        break; 
                    case 2: //elimina viaje 
                        do {
                            menuEliminarViaje(); 
                            $opEliminarViaje = trim(fgets(STDIN));
                            switch($opEliminarViaje){
                                case 1: //elimina a un pasajero
                                    echo "Conoce el ID del viaje al que desea eliminar un pasajero? (si/no): " ;
                                    $opSN = trim(fgets(STDIN)); 
                                    if ($opSN=="no" || $opSN=="n" || $opSN=="NO" || $opSN=="N"){
                                        echo "*****************************************\n";
                                        echo "***     Vea los Viajes Disponibles    ***\n";
                                        echo "***      para Buscar al Pasajero      ***\n";
                                        echo "*****************************************\n";
                                        $objViajeEP = mostrarViajes();
                                    } else {
                                        $objViajeEP = new Viaje();
                                    }
                                     
                                    if ($objViajeEP!=null){
                                        echo "Ingrese el ID del viaje de donde se quiere eliminar al pasajero: "; 
                                        $idViajePEl = trim(fgets(STDIN));
                                        if ($objViajeEP->Buscar($idViajePEl)){
                                            echo "Conoce el dni del pasajero a eliminar? (si/no): ";
                                            $opE = trim(fgets(STDIN));
                                            if ($opE=="no" || $opE=="n" || $opE=="N" || $opE=="NO"){
                                                echo "VEA LA LISTA DE PASAJEROS DEL VIAJE   \n";
                                                $pas = mostrarPasajeros($idViajePEl);
                                            }else {
                                                $pas = new Pasajero();
                                            }
                                            echo "Ingrese el documento del pasajero a eliminar: "; 
                                            $docPasEliminar = trim(fgets(STDIN));
                                                //OPCION 1 
                                            if($pas->Buscar($docPasEliminar)){
                                                $res = $pas->eliminar();
                                                if ($res){
                                                    echo "*****************************************\n";
                                                    echo "***    Pasajero Eliminado con Exito   ***\n";
                                                    echo "*****************************************\n";
                                                } else {
                                                    
                                                    echo "*****************************************\n";
                                                    echo "EL PASAJERO NO PUDO SER ELIMINADO";
                                                }
                                            }
                                        }
                                    }
                                    break;
                                case 2:  //elimina a todo el viaje
                                    echo "Conoce el ID del viaje a eliminar? (si/no): " ;
                                    $opSN = trim(fgets(STDIN)); 
                                    if ($opSN=="no" || $opSN=="n" || $opSN=="NO" || $opSN=="N"){
                                        echo "*****************************************\n";
                                        echo "***     Vea los Viajes Disponibles    ***\n";
                                        echo "***           para Eliminar           ***\n";
                                        echo "*****************************************\n";
                                        $viaje = mostrarViajes();
                                    } else {
                                        $viaje = new Viaje();
                                    }
                                    if ($viaje!=null){
                                        echo "Ingrese el ID del viaje a eliminar: ";
                                        $id = trim(fgets(STDIN));
                                        if ($viaje->Buscar($id)){
                                            $auxPasajero = new Pasajero();
                                            $pasajeros = $auxPasajero->listar("idviaje=".$id); 
                                            if (count($pasajeros)>0){
                                                echo "El viaje contiene pasajeros. Esta seguro de eliminar el viaje?(si/no): ";
                                                $opEliminar = trim(fgets(STDIN));
                                                if ($opEliminar=="si" || $opEliminar=="s" || $opEliminar=="S" || $opEliminar=="SI"){
                                                    foreach($pasajeros as $unPasajero){
                                                        $unPasajero->eliminar();
                                                    }
                                                    $rep = $viaje->eliminar(); 
                                                    if ($rep){
                                                        echo "*****************************************\n";
                                                        echo "***     Viaje Eliminado con Exito     ***\n";
                                                        echo "*****************************************\n";
                                                    } else{ 
                                                        echo $viaje->getMensajeOperacion();
                                                    }
                                                } 
                                            } else {
                                                $rep = $viaje->eliminar(); 
                                                if ($rep){
                                                    echo "*****************************************\n";
                                                    echo "***     Viaje Eliminado con Exito     ***\n";
                                                    echo "*****************************************\n";
                                                } else{ 
                                                    echo $viaje->getMensajeOperacion();
                                                }
                                            }
                                        }
                                    } 
                                    break; 
                            }
                        } while ($opEliminarViaje!=3);
                        break; 
                    case 3:  //elimina responsables 
                        echo "Conoce el DNI del responsable a eliminar?(si/no): ";
                        $opSN = trim(fgets(STDIN));
                        if($opSN=="no" || $opSN=="NO" || $opSN=="N" || $opSN=="n"){
                            echo "*****************************************\n";
                            echo "***  Vea los Responsables disponibles ***\n";
                            echo "***           para Eliminar           ***\n";
                            echo "*****************************************\n";
                            $responsable = mostrarResponsables(); 
                        }else{
                            $responsable = new ResponsableV();
                        }  
                        if ($responsable!=null){
                            echo "Ingrese el Nro de empleado a eliminar: "; 
                            $docEliminarRes = trim(fgets(STDIN));
                            if ($responsable->Buscar($docEliminarRes)){           //busco q exista 
                                $aCargo = new Viaje();
                                $siCargo = $aCargo->listar("rnumeroempleado=".$docEliminarRes);
                                if (count($siCargo)==0){
                                    $logrado = $responsable->eliminar();
                                    if ($logrado){
                                        echo "*****************************************\n";
                                        echo "***  Responsable Eliminado con Exito  ***\n";
                                        echo "*****************************************\n";
                                    } else {
                                        echo "*****************************************\n";
                                        echo "***       El Responsable NO pudo      ***\n";
                                        echo "***            ser eliminado          ***\n";
                                        echo "*****************************************\n";
                                        //echo $responsable->getMensajeOperacion();
                                    }
                                } else {
                                    echo "*****************************************\n";
                                    echo "***   El Responsable tiene viajes a   ***\n";
                                    echo "***    cargo. Modificarlos primero    ***\n";
                                    echo "*****************************************\n";
                                }
                            } else {
                                echo "*****************************************\n";
                                echo "***     Responsable NO encontrado     ***\n";
                                echo "*****************************************\n";
                                //echo $responsable->getMensajeOperacion();
                            }
                        }
                        break;
                }
            } while($opMenuEliminar!=4);
            break;
        case 4: 
            do {
                menuListar();
                $opMenuListar = trim(fgets(STDIN));
                switch($opMenuListar){
                    // ya hay funciones que listan, solo las llamo ya que muestran los datos
                    case 1:
                        echo "*****************************************\n";
                        echo "***        Listado de Empresa         ***\n";
                        echo "*****************************************\n";
                        mostrarEmpresas();
                        break;
                    case 2:
                        echo "*****************************************\n";
                        echo "***         Listado de Viajes         ***\n";
                        echo "*****************************************\n";
                        mostrarViajes();
                        break;
                    case 3:
                        echo "*****************************************\n";
                        echo "***      Listado de Responsables      ***\n";
                        echo "*****************************************\n";
                        mostrarResponsables(); 
                        break;
                    case 4:
                        echo "Conoce el ID del viaje al cual desea ver los pasajeros?: "; 
                        $idViaje= trim(fgets(STDIN));
                        if ($idViaje=="n" || $idViaje=="N" || $idViaje=="no" || $idViaje=="NO"){
                            echo "VEA LOS VIAJES Y ELIJA DE CUAL VER LOS PASAJEROS.\n";
                            $aux = mostrarViajes();
                        } else {
                            $aux = new Viaje();
                        }
                        if ($aux!=null){
                            echo "Ingrese el ID del viaje: "; 
                            $idViaje = trim(fgets(STDIN));
                            if ($aux->Buscar($idViaje)){
                                echo "*****************************************\n";
                                echo "***        Listado de Pasajeros       ***\n";
                                echo "*****************************************\n";
                                mostrarPasajeros($idViaje);
                            }
                        }
                        break;
                }
            } while($opMenuListar!=5);
    }
} while($opMenuPrincipal!=5);

