<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programa de Arreglos Asociativos</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
  <?php
  if (isset($_POST['submit']) && $_POST['submit'] == 'Agregar') :
    if(
      is_numeric($_POST['salary1']) && 
      is_numeric($_POST['salary2']) &&
      is_numeric($_POST['salary3']) &&
      is_numeric($_POST['id1']) && 
      is_numeric($_POST['id2']) &&
      is_numeric($_POST['id3'])
      ):
    $trabajadores = array(
      array(
        "Nombre" => $_POST['name1'],
        "Apellido" => $_POST['lastName1'],
        "Cédula" => $_POST['id1'],
        "Lugar" => $_POST['place1'],
        "Departamento" => $_POST['department1'],
        "Salario" => $_POST['salary1']
      ),
      array(
        "Nombre" => $_POST['name2'],
        "Apellido" => $_POST['lastName2'],
        "Cédula" => $_POST['id2'],
        "Lugar" => $_POST['place2'],
        "Departamento" => $_POST['department2'],
        "Salario" => $_POST['salary2']
      ),
      array(
        "Nombre" => $_POST['name3'],
        "Apellido" => $_POST['lastName3'],
        "Cédula" => $_POST['id3'],
        "Lugar" => $_POST['place3'],
        "Departamento" => $_POST['department3'],
        "Salario" => $_POST['salary3']
      )
    );
  ?>
  <div class="container">
    <div class="row">
      <h1 class="mb-4">Lista de trabajadores</h1>
      <?php
        for($i = 0; $i <3; ++$i){
          echo '<div class="col card mx-1">';
          echo "<h4>Trabajador " . ($i + 1) . "</h4>";
          foreach ($trabajadores[$i] as $key => $value) { 
            
            echo "<div class='mb-1'><h5 class='text-capitalize mb-0'>$key:</h5> <p>$value</p></div>";
          }
          echo '</div>';
        }
      ?>
      <a href='./'>Regresar</a>
    </div>
  </div>
  <?php
    else:
      echo "<div class='container'>
      <h2>Ingreso datos no numericos en algún salario o cédula.</h2>
      <br />
      <a href='./'>Regresar</a>
      </div>
      ";
    endif;
  endif;
  ?>


  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>