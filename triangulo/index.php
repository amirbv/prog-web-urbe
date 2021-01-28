<html>

<head>
  <title>Calculo de la hipotenusa de un triangulo rectangulo</title>
</head>

<body>
  <?php
/*
$hipotenusa = raiz2(b^2 + c^2)
*/
  $cat1 = 3;
  $cat2 = 4;
  $hipotenusa = sqrt($cat1**2 + $cat2**2);

  echo "<h2 align='center'>CALCULO DE LA HIPOTENUSA DE UN TRIANGULO RECTANGULO</h2>";
  echo "<br>Cateto 1: $cat1 cm";
  echo "<br>Cateto 2: $cat2 cm";
  echo "<br> Siguiendo la formula: hipotenusa = √(cateto1² + cateto2²)";
  echo "<br>Hipotenusa: $hipotenusa cm";

  
  ?>
</body>

</html>