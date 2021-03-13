<?php
$dir = $_POST['nombre-dir'];
$ruta = "./".$dir;
    function EliminarDir($ruta){
        foreach(glob($ruta . "/*") as $elemento){
            if (is_dir($elemento)) {
                EliminarDir($elemento);
            }else{
                unlink($elemento);
            }
        }
        rmdir($ruta);
    }

    $msg = null;
    if(!empty($dir)){
        if(is_dir($ruta)){
            EliminarDir($ruta);
            $msg = "Ha eliminado el directorio correctamente";
        }else{
            $msg = "Ha ocurrido un problema con la eliminacion del directorio";
        }
    }

    echo $msg;

?>