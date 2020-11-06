<?php
	echo "<h1>Gestion incidencias</h1>";
	// Mostramos info del usuario logueado (si hay alguno)
	if (isset($_SESSION['Id'])) {
            $usuario = $_SESSION['Id'];
            $tipo = $_SESSION['tipo'];


        }
	// Mostramos mensaje de error o de información (si hay alguno)
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}

	// Enlace a "Iniciar sesión" o "Cerrar sesión"
	if (isset($_SESSION["Id"])) {
		echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesión</a></p>";
	}
	else {
		echo "<p><a href='index.php?action=mostrarFormularioLogin'>Iniciar sesión</a></p>";
	}
	// Ahora, la tabla con los datos de las incidencias
		echo "<table border ='1'>";
		echo "<tr>";
		echo "<td>" . "Incidencia". "</td>";
		echo "<td>" . "Fecha". "</td>";
		echo "<td>" . "Lugar". "</td>";
		echo "<td>" . "Descripcion". "</td>";
		echo "<td>" . "Observaciones". "</td>";
		echo "<td>" . "Equipo". "</td>";
		echo "<td>" . "Estado". "</td>";
	foreach($data['listaIncidencias'] as $incidencia) {
		if($tipo == 'admin'){


					echo "<tr>";
					echo "<td>" . $incidencia->IdIncidencia . "</td>";
					echo "<td>" . $incidencia->Fecha . "</td>";
					echo "<td>" . $incidencia->Lugar . "</td>";
					echo "<td>" . $incidencia->Descripcion . "</td>";
					echo "<td>" . $incidencia->Observaciones . "</td>";
					echo "<td>" . $incidencia->Equipo . "</td>";
					echo "<td>" . $incidencia->Estado . "</td>";
					// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
						if (isset($_SESSION["Id"])) {
							echo "<td><a href='index.php?action=formularioModificarIncidencia&IdIncidencia=" . $incidencia->IdIncidencia . "'>Modificar</a></td>";
							echo "<td><a href='index.php?action=borrarIncidencia&IdIncidencia=" . $incidencia->IdIncidencia . "'>Borrar</a></td>";
						}

			}else{
					if($usuario == $incidencia->idUsuarios){
						echo "<tr>";
						echo "<td>" . $incidencia->IdIncidencia . "</td>";
						echo "<td>" . $incidencia->Fecha . "</td>";
						echo "<td>" . $incidencia->Lugar . "</td>";
						echo "<td>" . $incidencia->Descripcion . "</td>";
						echo "<td>" . $incidencia->Observaciones . "</td>";
					echo "<td>" . $incidencia->Equipo . "</td>";
					echo "<td>" . $incidencia->Estado . "</td>";
					// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
					if (isset($_SESSION["Id"])) {
						echo "<td><a href='index.php?action=formularioModificarIncidencia&IdIncidencia=" . $incidencia->IdIncidencia . "'>Modificar</a></td>";
				}
			}
}
			echo "</tr>";
	}
	echo "</table>";


	// El botón "Nueva incidencia" solo se muestra si hay una sesión iniciada
	if (isset($_SESSION["Id"])) {
		echo "<p><a href='index.php?action=formularioInsertarIncidencia'>Nuevo</a></p>";
	}
	echo $usuario;
