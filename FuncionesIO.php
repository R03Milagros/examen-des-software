<?php
function Completar80Porciento($registroAlumnosCsv, $semestreObjetivo, $cantidad, $conDB){
  $contador = 0;
  $i = 0;
  while ($contador < $cantidad){
    $datos_alumno = explode(',', $registroAlumnosCsv[$i]);
    $codAl = $datos_alumno[0];
    // el alumno tiene que existir en matriculados 2022
    if (ExisteMatricula($codAl, $semestreObjetivo, 'matricula', $conDB)){
      // agrega alumno a la matricula 2021
      $insertar_matricula = "INSERT INTO matricula(
        codAlumno,
        semestre
      ) VALUES (
        '$codAl',
        '2021-2'
      )";
      if (!mysqli_query($conDB, $insertar_matricula)){
        echo "<h1>Ocurrio un error, al completar 80%</h1>";
      }
      ++$contador;
    }
    ++$i;
  }
}

function InsertarDatosArchivo($registroAlumnosCsv, $semestreRelacionado, $cantidad, $conDB){

  for ($i = 0; $i < $cantidad; ++$i){
    // verificar que no exista en la base de datos
    $datos_alumno = explode(',', $registroAlumnosCsv[$i]);
    $codAl = $datos_alumno[0];
    $nombreAl = $datos_alumno[1];
    if (!ExisteAlumno($datos_alumno[0], 'alumno', $conDB)){
      // agregar a alumnos y matricula
      $insertar_alumno = "INSERT INTO alumno(
        codAlumno,
        nombre_apellido
      ) VALUES (
        '$codAl',
        '$nombreAl'
      )";
      $insertar_matricula = "INSERT INTO matricula(
        codAlumno,
        semestre
      ) VALUES (
        '$codAl',
        '$semestreRelacionado'
      )";
      if (!mysqli_query($conDB, $insertar_alumno)){
        echo "<h1>No se puede agregar alumno</h1>";
      }
      if (!mysqli_query($conDB, $insertar_matricula)){
        echo "<h1>No se puede agregar matricula</h1>";
      }
    }
    else{ // el alumno ya exista en la base de datos
      // si existe, agregar solo a matricula
      if (!ExisteMatricula($codAl, $semestreRelacionado, 'matricula', $conDB)){
        $insertar_matricula = "INSERT INTO matricula(codAlumno, semestre) VALUES ('$codAl', '$semestreRelacionado')";
        if (!mysqli_query($conDB, $insertar_matricula)){
          echo "<h1>No se pudo agregar matricula</h1>";
        }
      }
    }
  }
}

function ExisteMatricula($codAlumno, $semestre, $tabla, $conDB){
  $consulta_existe = "SELECT * FROM $tabla WHERE codAlumno = '$codAlumno' AND semestre = '$semestre'";
  $resultado = mysqli_query($conDB, $consulta_existe);
  return (mysqli_num_rows($resultado) > 0) ? true : false;
}

function ExisteAlumno($codAlumno, $tabla, $conDB){
  $consulta_existe = "SELECT * FROM $tabla WHERE codAlumno='$codAlumno'";
  $resultado = mysqli_query($conDB, $consulta_existe);
  return (mysqli_num_rows($resultado) > 0) ? true : false;
}
?>