<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_usuario($usuario, $password) {
        $query = $this->db->query("SELECT 
                                        idusuario,
                                        usuario,
                                        nombre,
                                        apellido
                                    FROM
                                        usuarios
                                    WHERE
                                        usuario = '$usuario' AND
                                        password = '$password' AND
                                        estado = 'A'");
        return $query->row_array();
    }

    public function update($where, $idusuario) {
        $this->db->update('usuarios', $where, array('idusuario' => $idusuario));
        return $this->db->affected_rows();
    }
}

?>