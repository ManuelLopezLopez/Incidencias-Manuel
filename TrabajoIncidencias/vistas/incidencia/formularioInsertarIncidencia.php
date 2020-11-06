<?php
if (isset($_SESSION['Id'])) {

	 $usuariotipo =$_SESSION["Id"];
	 $user =$_SESSION["Tipo"];


}
			// Comprobamos si hay una sesión iniciada o no
				echo "<h1>Creacion de Incidencias</h1>";

				// Creamos el formulario con los campos de la incidencia
				echo "<form action = 'index.php' method = 'get'>
						IdIncidencia:<input type='text' name='idIncidencia'><br>
						Fecha:<input type='date' name='fecha'><br>
						Lugar:<input type='text' name='lugar'><br>
						Descripcion:<input type='text' name='descripcion'><br>
						Observaciones:<input type='text' name='observaciones'><br>
						Equipo:<input type='text' name='equipo'><br>
						Estado:<input type='text' name='estado'><br>
						<input type='hidden' name='idUsuarios' value='$usuariotipo'><br>";


				// Finalizamos el formulario
				echo "  <input type='hidden' name='action' value='insertarIncidencia'>
						<input type='submit'>
					</form>";
				echo "<p><a href='index.php'>Volver</a></p>";
