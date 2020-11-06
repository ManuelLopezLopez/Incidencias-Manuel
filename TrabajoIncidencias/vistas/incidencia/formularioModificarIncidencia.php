<?php
// Pasamos las variables preparadas en el controlador ($data[]) a variables normales
// para escribirlas con más facilidad
$incidencia = $data['incidencia'];



echo "<h1>Modificación de incidencias</h1>";


// Creamos el formulario con los campos de la incidencia
// y lo rellenamos con los datos que hemos recuperado de la BD
echo "<form action = 'index.php' method = 'get'>
            <input type='hidden' name='IdIncidencia' value='$incidencia->IdIncidencia'>
            Fecha:<input type='date' name='Fecha' value='$incidencia->Fecha'><br>
            Lugar:<input type='text' name='Lugar' value='$incidencia->Lugar'><br>
            Descripcion:<input type='text' name='Descripcion' value='$incidencia->Descripcion'><br>
            Observaciones:<input type='text' name='Observaciones' value='$incidencia->Observaciones'><br>
            Equipo:<input type='text' name='Equipo' value='$incidencia->Equipo'><br>
            Estado:<input type='text' name='Estado' value='$incidencia->Estado'><br>
            <input type='hidden' name='idUsuarios' value='$incidencia->idUsuarios'><br>";







// Finalizamos el formulario
echo "  <input type='hidden' name='action' value='modificarIncidencia'>
            <input type='submit'>
          </form>";
echo "<p><a href='index.php'>Volver</a></p>";
