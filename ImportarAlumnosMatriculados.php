<?php
    require('conexion.php');
    require('FuncionesIO.php');


    $tipo       = $_FILES['AlumnosMatriculados']['type'];
    $tamanio    = $_FILES['AlumnosMatriculados']['size'];
    $archivotmp = $_FILES['AlumnosMatriculados']['tmp_name'];

    $registros  = file($archivotmp);

    InsertarDatosArchivo($registros, '2022-1', count($registros), $con);

    if($registros){
        Header("Location: index.php");
    }
    else {
    }
?>