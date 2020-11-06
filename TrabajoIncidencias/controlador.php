<?php
include_once("vista.php");
include_once("modelos/usuarios.php");
include_once("modelos/incidencia.php");


class Controlador
{

	private $vista, $usuarios, $incidencia;

	/**
	 * Constructor. Crea las variables de los modelos y la vista
	 */
	public function __construct()
	{
		$this->vista = new vista();
		$this->usuarios = new usuarios();
		$this->incidencia = new incidencia();

	}

	/**
	 * Muestra el formulario de login
	 */
	public function mostrarFormularioLogin()
	{
		$this->vista->mostrar("usuarios/formularioLogin");
	}

	/**
	 * Procesa el formulario de login e inicia la sesión
	 */
	public function procesarLogin()
	{
		$usuarios = $_REQUEST["Username"];
		$Contraseña = $_REQUEST["Contraseña"];
		$Email =$_REQUEST["Email"];


		$result = $this->usuarios->buscarUsuario($usuarios, $Contraseña,$Email);

		if ($result) {
			$data['msjInfo'] = "Nombre de usuario o contraseña correctos";
				$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar("incidencia/listaIncidencias", $data);
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Nombre de usuario o contraseña incorrectos";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}

	/**
	 * Cierra la sesión
	 */
	public function cerrarSesion()
	{
		session_destroy();
		$data['msjInfo'] = "Sesión cerrada correctamente";
		$this->vista->mostrar("usuarios/formularioLogin", $data);
	}

	/**
	 * Muestra una lista con todos las Incidencias
	 */
	public function mostrarListaIncidencias()
	{
		$data['listaIncidencias'] = $this->incidencia->get($IdIncidencia);
		$this->vista->mostrar("incidencia/listaIncidencias", $data);
	}
	/**
	 * Muestra el formulario de alta de libros
	 */
	public function formularioInsertarIncidencia()
	{
		if (isset($_SESSION["Id"])) {

			$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar('incidencia/formularioInsertarIncidencia', $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}


	/**
	 * Insertar una incidencia en la base de datos
	 */
	public function insertarIncidencia()
	{

		if (isset($_SESSION["Id"])) {
			// Vamos a procesar el formulario de alta de incidencias
			// Primero, recuperamos todos los datos del formulario
			$IdIncidencia = $_REQUEST["idIncidencia"];
			$Fecha = $_REQUEST["fecha"];
			$Lugar = $_REQUEST["lugar"];
			$Descripcion = $_REQUEST["descripcion"];
			$Observaciones = $_REQUEST["observaciones"];
			$Equipo = $_REQUEST["equipo"];
			$Estado = $_REQUEST["estado"];
			$idUsuarios = $_REQUEST["idUsuarios"];




			// Ahora insertamos la incidencia en la BD
			$result = $this->incidencia->insert($IdIncidencia, $Fecha, $Lugar, $Descripcion, $Observaciones,$Equipo,$Estado,$idUsuarios);



			// Terminamos mostrando la lista de incidencias de este usuarios actualizada
			$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar("incidencia/listaIncidencias", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}

	/**
	 * Elimina una incidencia de la base de datos
	 */
	public function borrarIncidencia()
	{
		if (isset($_SESSION["Id"])) {
			// Recuperamos el id de la incidencia
			$IdIncidencia = $_REQUEST["IdIncidencia"];
			// Eliminamos la incidencia de la BD
			$result = $this->incidencia->delete($IdIncidencia);
			if ($result == 0) {
				$data['msjError'] = "Ha ocurrido un error al la incidencia. Por favor, inténtelo de nuevo";
			} else {
				$data['msjInfo'] = "Incidencia borrada con éxito";
			}
			// Mostramos la lista de incidencias actualizada
			$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar("incidencia/listaIncidencias", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}

	/**
	 * Muestra el formulario de modificación de la incidencia
	 */
	public function formularioModificarIncidencia()
	{
		if (isset($_SESSION["Id"])) {
			// Recuperamos la incidencia con id = $IdIncidencia y lo preparamos para pasárselo a la vista
			$IdIncidencia = $_REQUEST["IdIncidencia"];
			$data['incidencia'] = $this->incidencia->get($IdIncidencia);

			// Renderizamos la vista con el formulario de modificación de incidencias
			$this->vista->mostrar('incidencia/formularioModificarIncidencia', $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}

	/**
	 * Modifica una incidencia en la base de datos
	 */
	public function modificarIncidencia()
	{
		if (isset($_SESSION["Id"])) {

			// Vamos a procesar el formulario de modificación de incidencias
			// Primero, recuperamos todos los datos del formulario
			$IdIncidencia = $_REQUEST["IdIncidencia"];
			$Fecha = $_REQUEST["Fecha"];
			$Lugar = $_REQUEST["Lugar"];
			$Descripcion = $_REQUEST["Descripcion"];
			$Observaciones = $_REQUEST["Observaciones"];
			$Equipo = $_REQUEST["Equipo"];
			$Estado = $_REQUEST["Estado"];
			$idUsuarios = $_REQUEST["idUsuarios"];


			// Lanzamos el UPDATE contra la base de datos.
			$result = $this->incidencia->update($IdIncidencia, $Fecha, $Lugar, $Descripcion, $Observaciones,$Equipo,$Estado,$idUsuarios);



			$data['listaIncidencias'] = $this->incidencia->getAll();
			$this->vista->mostrar("incidencia/listaIncidencias", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->mostrar("usuarios/formularioLogin", $data);
		}
	}



}
