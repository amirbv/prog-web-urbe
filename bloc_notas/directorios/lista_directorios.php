<?php
    $listar = null;
    $directorio = opendir("../directorios/");
    
    while($elemento = readdir($directorio)){
        if($elemento != "." && $elemento != ".."){
            if(is_dir("../directorios/".$elemento)){
                $listar .= "
                <tr>
                    <td><center><strong>$elemento</strong></center></td>
                    <td><center><a class='btn btn-primary' href='../archivosBloc/index.php?directorio=$elemento'>Abrir</a></center></td>
                </tr>";
            }
        }
    }
            
?>