<?php

$dir = $_GET['directorio'];
$archivo = $_POST['nombre-archivo'] . ".txt";
$contenido=$_POST['texto-archivo'];

if(file_exists("../$dir/". $archivo)){
    echo "Archivo ya existente...";
    exit;
}

if( $archivo == false ){
    echo "Error al crear el archivo";
}else{

    $myfile = @fopen("../directorios/$dir/" . $archivo . "", "w+") or die("Unable to open file!");
    if(file_exists("../directorios/$dir/" . $archivo)){
        fwrite($myfile, $contenido);
    }else{
        die("No se ha podido crear el archivo."); 
    }
    fclose($myfile);
}

?>