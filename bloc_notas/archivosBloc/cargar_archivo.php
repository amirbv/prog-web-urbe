<?php

if(isset($_POST['nombre-archivo']) && !empty($_POST['nombre-archivo']) ){
    $directorio = $_GET['directorio'];
    $nombre = $_POST["nombre-archivo"];
    $nombre = strtolower($nombre);
    $contenido = "";
    try{
        $myfile = @fopen("../directorios/$directorio/$nombre". ".txt", "r") or die("No se encontró el archivo");
        // Output one line until end-of-file
        while (!feof($myfile)) {
                 $contenido .= fgets($myfile);
        }
        fclose($myfile);
        echo $contenido;
        
        }catch(Throwable $e){
                
        } 
        
}
?>