<?php

if(isset($_POST['nombre-archivo']) && !empty($_POST['nombre-archivo']) ){
    $dir = $_GET['directorio'];
    $archivo = $_POST['nombre-archivo'] .".txt";
    $archivo = strtolower($archivo);
    $contenido = $_POST['texto-archivo'];

    if(file_exists("../directorios/".$dir."/". $archivo)){
        $open = fopen("../directorios/".$dir."/".  $archivo,"w+");
        fwrite($open, $contenido);
        fclose($open);
    }else{
        echo "Archivo no existe...";
        exit;
    }


}
?>