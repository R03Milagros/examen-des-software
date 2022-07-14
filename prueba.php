<?php
$a = 10;
echo "Hola mundo";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hola mundo</title>
  </head>
  <body>
    <script>
      var mi_arreglo = array(<?php echo $a; ?>);
      console.log(mi_arreglo);
    </script>
  </body>
</html>