<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="caracter" content="">
	<link rel="stylesheet" type="text/css" href="estilo-index.css">
</head>
<body>
	<header>
		<h1><center>TUTORÍAS</center></h1>
	</header>
<?php
require("conexion.php");

# elemento 0 : # No reciben tutoria
# elemento 1 : # Recibiran tutoria
$consultas = ["SELECT m1.codAlumno, m1.nombre_apellido FROM (matriculados2021completo m1 LEFT JOIN matriculados2022completo m2 ON m1.codAlumno=m2.codAlumno) WHERE M2.codAlumno is null",
              "SELECT m2.codAlumno, m2.nombre_apellido FROM (matriculados2022completo m2 LEFT JOIN matriculados2021completo m1 ON m1.codAlumno=m2.codAlumno) WHERE M1.codAlumno is null"];
$nombre_tabla = ["PERSONAS QUE HICIERON TUTORIA 2021 PERO NO SE MATRICULARON", "NUEVOS ALUMNOS INGRESANTES"];
$opcion = $_POST['Tutoria'];
$name_table = $nombre_tabla[$_POST['Tutoria']];

$consulta_requerida = $consultas[$opcion];

$registros_solicitados = mysqli_query($con, $consulta_requerida);

$etiquetas_tabla = GenerarEtiquetaTabla($registros_solicitados, $name_table);

function EtiquetaAlumno($al){
  return "<td>"."|" ."<td>".$al['codAlumno']."|"."</td>".
    "<td>" .$al['nombre_apellido']."|". "</td>";
}

function GenerarEtiquetaTabla($registros, $titulo){
  $etiquetas = "<table>".
  "<thead>".
    "<tr style='--color-borde: black; --grosor:2px'>".
      "<th colspan='3'> TABLA DE " . $titulo . "</th>".
    "</tr>".
  "</thead>".
  "<tbody>";
  $contador = 1;
  while (($alumno = mysqli_fetch_assoc($registros)) != null){
    if ($contador % 2 == 0){
      $etiquetas .= "<tr style='--color-borde: black; --grosor:1.5px'>".
      "<td>" . $contador . "</td>";
      $etiquetas .= EtiquetaAlumno($alumno).
      "</tr>";
      ++$contador;
    }
    else{
      $etiquetas .= "<tr style='--color-borde: black; --grosor:1.5px'>".
      "<td>" . $contador . "</td>";
      $etiquetas .= EtiquetaAlumno($alumno).
      "</tr>";
      ++$contador;
    }
  }
  $etiquetas .= "</tbody></table>";
  return $etiquetas;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla</title>
  <link href="estilos-tabla.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php echo $etiquetas_tabla ?>
</body>
</html>
