<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de notas - Directorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        body {
            background: url(../shenlong.png) repeat rgb(173, 181, 189);
            background-blend-mode: multiply;
        }
        body > div.container {
            background: rgba(170, 173, 196, 0.7);
            border-radius: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <div class="container">
        <header>
            <h1 class="text-center">Bloc de notas - Directorios</h1>
        </header>
        <main>
            <div class="container">
                <form enctype="multipart/form-data" id="formulario" method="POST">
                    <label class="form-label">Nombre del directorio:</label>
                    <div class="row g-3">
                        <div class="col-auto">
                            <input class="form-control" id="nombre-dir" type="text" name="nombre-dir">
                        </div>
                        <div class="col-auto">
                            <input class="btn btn-success" value="Crear" type="button" onclick="crear();">
                        </div>
                        <div class="col-auto">
                            <input class="btn btn-danger" value="Eliminar" type="button" onclick="eliminar();">
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="container py-3">
                <table class="table caption-top">
                    <caption class="text-dark">Lista de directorios dentro del servidor</caption>
                    <tr>
                        <th scope="col"><center>Carpeta</center></th>
                        <th scope="col"><center>Enlace de acceso</center></th>
                    </tr>
                <?php
                    require "./lista_directorios.php";
                    echo $listar;
                ?>
                </table>
                
            </div>
        </main>
        
    </div>
    <footer class='footer mt-auto py-3 bg-dark'>
        <div class="container">
            <center><span class="text-light">Amir Bastidas</span><center><br>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        function crear(){
            $.ajax({
                type: 'POST',
                url: './crear_directorio.php',
                data: $('#formulario').serialize(),
                success: function(respuesta) {
                    if (respuesta == "Directorio creado correctamente") {
                        alert("Directorio creado. La pagina se actualizará automaticamente");
                        location.reload();
                    } else {
                        alert('Error en la creacion del directorio.');
                    }
                }
            });

        }

        function eliminar(){
            $.ajax({
                type: 'POST',
                url: './eliminar_directorio.php',
                data: $('#formulario').serialize(),
                success: function(respuesta) {
                    if (respuesta == "Ha eliminado el directorio correctamente") {
                        alert("Directorio eliminado. La pagina se actualizará automaticamente");
                        location.reload();
                    } else {
                        alert(respuesta);
                    }
                }
            });
        }
    </script>
