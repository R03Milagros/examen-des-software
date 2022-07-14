<?php
    require('conexion.php');
    require('FuncionesIO.php');

    // alumnos del tutorado, hasta el 3er docente
    $tipo       = $_FILES['AlumnosAntiguos']['type'];
    $tamanio    = $_FILES['AlumnosAntiguos']['size'];
    $archivotmp = $_FILES['AlumnosAntiguos']['tmp_name'];

    $registros  = file($archivotmp);

    InsertarDatosArchivo($registros, '2021-2', count($registros), $con);

    // Completar al 80%
    // leemos tutoria-adional
    // n
    $nombre_archivo = 'tutorados-adicional.csv';
    $registros_adicionales = file($nombre_archivo);

    $n = 3;
    Completar80Porciento($registros_adicionales, '2022-1', $n, $con);

    if($registros_adicionales){
        Header("Location: index.php");
    }
    else {
    }
?>