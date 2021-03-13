<?php
if(!empty($_GET['file'])){
    $directorio = $_GET['directorio'];
    $fileName = basename($_GET['file']);
    $filePath = '../directorios/'.$directorio.'/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
?>