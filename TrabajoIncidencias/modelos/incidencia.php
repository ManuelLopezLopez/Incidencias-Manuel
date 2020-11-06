<?php

/**
 * Clase incidencia. Es el modelo de la incidencia
 */
class incidencia
{
    private $db;
	/**
	 * Constructor. Crea la conexión con la base de datos
     * y la guarda en una variable de la clase
	 */
    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "practicaincidencias");
    }

	/**
	 * Busca una incidencia con IdIncidencia = $idIncidencia en la base de datos.
     * @param IdIncidencia El id de la incidencia que se quiere buscar.
     * @return check objeto con la incidencia de la BD, o null si no lo encuentra.
	 */
    public function get($IdIncidencia)
    {
        if ($result = $this->db->query("SELECT * FROM incidencias
                                            WHERE incidencias.IdIncidencia = '$IdIncidencia'")) {
            $result = $result->fetch_object();
        } else {
            $result = null;
        }
        return $result;
    }
    public function getAll()
    {
      $arrayResult = array();

        if ($result = $this->db->query("SELECT * FROM incidencias")) {
          while ($fila = $result ->fetch_object()){
            $arrayResult[] = $fila;
          }

        } else {
            $arrayResult = null;
        }
        return $arrayResult;
    }


    /**
     * Inserta una incidencia  en la BD
     * @param IdIncidencia El id de la incidencia
     * @param Fecha La fecha de la incidencia
     * @param Lugar El lugar de la incidencia
     * @param Descripcion Una descripcion sobre lo que ocurre.
     * @param Observaciones Alguna observacion en particular
     * @param Equipo El equipo en el que ocurre la incidencia
     * @param Estado Como se encuentra la incidencia.
     * @param idUsuarios El id del usuario que realiza la incidencia

     * @return 1 si la inserción tiene éxito, 0 en otro caso
     */
    public function insert($IdIncidencia,$Fecha, $Lugar, $Descripcion, $Observaciones, $Equipo, $Estado,$idUsuarios)
    {
        $this->db->query("INSERT INTO incidencias (IdIncidencia,Fecha,Lugar,Descripcion,Observaciones,Equipo,Estado,idUsuarios)
                        VALUES ('$IdIncidencia','$Fecha', '$Lugar', '$Descripcion', '$Observaciones','$Equipo','$Estado','$idUsuarios')");
        return $this->db->affected_rows;
    }

    /**
     * Actualiza una incidencia de la BD
     * @param IdIncidencia El id de la incidencia que se va a actualizar
     * @param Fecha La fecha de la incidencia
     * @param Lugar El lugar donde ocurre
     * @param Descripcion La descripcion de la incidencia
     * @param Observaciones Observaciones
     * @param Equipo El equipo en cuestion
     * @param Estado El estado en le que se encuentra
     * @return 1 si la actualización tiene éxito, 0 en otro caso
     */
    public function update($IdIncidencia,$Fecha, $Lugar, $Descripcion, $Observaciones, $Equipo, $Estado,$idUsuarios)
    {
        $this->db->query("UPDATE incidencias SET IdIncidencia = '$IdIncidencia',Fecha = '$Fecha',Lugar = '$Lugar',Descripcion = '$Descripcion',Observaciones = '$Observaciones',Equipo = '$Equipo',Estado = '$Estado',idUsuarios = '$idUsuarios' WHERE IdIncidencia = '$IdIncidencia'");
        return $this->db->affected_rows;

    }


    /**
     * Elimina una incidencia  de la BD
     * @param IdIncidencia El id de la incidencia que se va a cerrar
     * @return 1 si el borrado tiene éxito, 0 en caso contrario
     */
    public function delete($IdIncidencia)
    {
        $this->db->query("DELETE FROM incidencias WHERE IdIncidencia = '$IdIncidencia'");
        return $this->db->affected_rows;
    }



}
