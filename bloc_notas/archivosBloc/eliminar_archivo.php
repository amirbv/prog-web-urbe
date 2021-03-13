<?php
$dir = $_GET['directorio'];

    if(isset($_POST['nombre-archivo']) && !empty($_POST['nombre-archivo']) ){
        $archivo = $_POST['nombre-archivo'];
        unlink("../directorios/$dir/".$archivo. ".txt");
        echo "ok";

    }
?>