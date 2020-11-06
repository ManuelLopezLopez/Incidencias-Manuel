<?php
  class usuarios {
      private $db;

      /**
       * Constructor. Establece la conexión con la BD y la guarda
       * en una variable de la clase
       */
      public function __construct() {
          $this->db = new mysqli("localhost", "root", "", "practicaincidencias");
      }


      /**
       * Busca un usuario por nombre de usuario y contraseña y email
       * @param Username El nombre del usuario
       * @param Contraseña La contraseña del usuario
       * @param Email el email del usuario
       * @return True si existe un usuario con ese nombre y contraseña, false en caso contrario
       */
      public function buscarUsuario($Username,$Contraseña,$Email) {

          if ($result = $this->db->query("SELECT Id, Username, Contraseña, Email , tipo   FROM usuarios WHERE username = '$Username' AND Contraseña = '$Contraseña'AND Email ='$Email'")) {
              if ($result->num_rows == 1) {
                  $usuarios = $result->fetch_object();
                  // Iniciamos la sesión
                  $_SESSION["Id"] = $usuarios->Id;
                  $_SESSION["Username"] = $usuarios->Username;
                  $_SESSION["Email"] = $usuarios->Email;
                  $_SESSION["tipo"] = $usuarios->tipo;
                  $_SESSION["Contraseña"] = $usuarios->Contraseña;

                  return true;
              } else {
                  return false;
              }
          } else {
              return false;
          }

      }

      public function get($id) {
      }

      public function getAll() {
      }

      public function insert() {
      }

      public function update() {
      }

      public function delete() {
      }


  }
