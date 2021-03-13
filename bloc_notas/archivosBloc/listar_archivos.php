<?php

function lista_archivos($folder){
    $direccionamiento = explode("/", $folder); 
    if (is_dir($folder)) { 
        if ($dir = opendir($folder)) { 

            while (($archivo = readdir($dir)) !== false) { 
                if ($archivo != '.' && $archivo != '..') {
                    $nuevaRuta = $folder . $archivo . '/';
                    echo '<tr><td>'; 
                    if (is_dir($nuevaRuta)) { 
                        echo '<b>' . $nuevaRuta . '</b>'; 
                        lista_archivos($nuevaRuta); 
                    } else { 
                        echo $archivo; 
                    }
                    echo '</td><td><center><a class="btn btn-primary" role="button" href="descargar_archivo.php?directorio=' . $direccionamiento[2] . '&file=' . $archivo . '">Descargar</a></center></td></tr>'; 
                }
            } 
            closedir($dir); 
        }
    } else { 
        echo 'No Existe la carpeta';
    }
}
lista_archivos("../directorios/$fileDirectory/");
