<html>

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

  <title>Calculo del area de un octagono regular con valores dinamicos</title>
</head>

<body>
  <?php

  if (isset($_POST['submit']) && $_POST['submit'] == 'Calcular') {
    $longitud = $_POST['longitud'];
    $apotema = $_POST['apotema'];
    $area = null;
    if (
      (!empty($longitud) || !empty($apotema)) && 
      (is_numeric($longitud) && is_numeric($apotema))
    ) {
      echo "<h2 align='center'>CALCULO DEL AREA DEL OCTAGONO REGULAR</h2>";
      $area = ((8 * $longitud) * $apotema) / 2;

      echo "<br>Longitud de los lados: $longitud cm";
      echo "<br>Longitud de la apotema: $apotema cm";
      echo "<br/>";
      echo "<br>Area del Octágono: $area cm²" ;
      echo "<br/><br/>";
    }
    else {
      echo "Hay datos incompletos o erróneos<br/><br/>";
    }
    echo "<a href='./'>Regresar</a>";

  }
  ?>
</body>

</html>