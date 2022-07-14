<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="caracter" content="">
	<title>Pagina principal</title>
	<link rel="stylesheet" type="text/css" href="estilo-index.css">
	<script>
		function confirmarRegistro()
		{
			return confirm("\u00BFEst\u00E1 seguro que desea registrar datos?");
		}
	</script>
</head>
<body>
	<header>
		<h1><center>TUTORÍAS</center></h1>
	</header>
	<div class="contenido">
		<div class="columna">
				<h2>Alumnos Antiguos</h2>
				<form action="ImportarAlumnosAntiguos.php" method="POST" enctype="multipart/form-data"/>
					<div class="file-input text-center">
						<input  type="file" name="AlumnosAntiguos" id="file-input" class="file-input__input" required="" />
	          			<input type="submit" name="subir" class="btn-enviar" value="Cargar Alumnos Antiguos" onclick="return confirmarRegistro()"/>
	          		</div>
	          	</form>
	        </div>

        <div class="columna">
				<h2>Alumnos Matriculados</h2>
				<form action="ImportarAlumnosMatriculados.php" method="POST" enctype="multipart/form-data"/>
					<div class="file-input text-center">
						<input  type="file" name="AlumnosMatriculados" id="file-input" class="file-input__input" required="" />
	          <input type="submit" name="subir" class="btn-enviar" value="Cargar Alumnos Matriculados 2022-I" onclick="return confirmarRegistro()"/>
	        </div>
	      </form>
	      </div>
	</div>

	<form class="radio" method="post" action="muestraResultados.php">
		<h2></h2>
		<div>
			<input type="radio" name="Tutoria" value="0">
			<label for="AlumnosNoTutorados">Mostrar alumnos que no serán tutorados en 2022-I</label>
		</div><br>
		<div>
			<input type="radio" name="Tutoria" value="1">
			<label for="AlumnosTutoria">Mostrar nuevos alumnos para tutoría</label>
		</div>
		<div><br>
			<input type="submit" name="subir" class="btn-buscar" value="Buscar"/>
	    </div>
	</form>

	<div><?php $resultado; ?></div>
</body>
</html>